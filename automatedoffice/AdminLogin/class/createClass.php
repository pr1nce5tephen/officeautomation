<?php
 include('../../config/connection.php');
 include('../../config/sy.php');
	 require('../../auth.php');
 	confirm_logged_in();

 	include ('paginate.php'); //include of paginate page
error_reporting(0);
$per_page = 18;         // number of results to show per page
$result = mysql_query("SELECT * FROM  schedules,rooms,subject,course,sy,section WHERE schedules.room_id=rooms.room_id AND schedules.subject_id=subject.subject_id AND schedules.course_id=course.course_id AND schedules.sy_id=sy.sy_id AND schedules.section_id=section.section_id ORDER BY schedules.sched_id ASC ");
$total_results = mysql_num_rows($result);
$total_pages = ceil($total_results / $per_page);//total pages were going to have

//-------------if page is setcheck------------------//
if (isset($_GET['page'])) {
    $show_page = $_GET['page'];             //it will tell the current page
    if ($show_page > 0 && $show_page <= $total_pages) {
        $start = ($show_page - 1) * $per_page;
        $end = $start + $per_page;
    } else {
        // error - show first set of results
        $start = 0;              
        $end = $per_page;
    }
} else {
    // if page isn't set, show first set of results
    $start = 0;
    $end = $per_page;
}
// display pagination
$page = intval($_GET['page']);

$tpages=$total_pages;
if ($page <= 0)
    $page = 1;
 	
?>
<!DOCTYPE html>
		<html lang="en">
		<head> 
			<meta charset="utf-8" />
			<title> Western Leyte College </title>
			<meta name="keywords" content="" />
			<meta name="description" content="" />
			<script language="javascript" src="../subjects/confirmDel.js" type="text/javascript"></script>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="../../style.css" rel="stylesheet" type="text/css" />
			
		</head>
		
		<body>
			
      <!--menu-->


       <?php include('../../menu/nav2.php');?>
<center/>
<br/>
<form action="createClass.php" method="POST">
	<!--kani para ni sa course-->
	<select name = "course">
						<option value = "" selected>Course</option>
							<?php
								$query = mysql_query("SELECT DISTINCT subject.subject_course, course.course_code FROM subject,course WHERE subject.subject_course=course.course_id order by subject_course") or die(mysql_error());
									if(mysql_num_rows($query)>0){ 
										while($data = mysql_fetch_array($query)) {
							?>
						<option value = "<?php echo $data['subject_course']?>"><?php echo $data['course_code']?></option>
							<?php
										}
									}
							?>
						</select>
	<!--Para sa semester-->
						<select name = "sem">
						<option value = "" selected>Semester</option>
							<?php
								$query = mysql_query("SELECT DISTINCT subject.subject_semester FROM subject order by subject_semester") or die(mysql_error());
									if(mysql_num_rows($query)>0){ 
										while($data = mysql_fetch_array($query)) {
							?>
						<option value = "<?php echo $data['subject_semester']?>"><?php echo $data['subject_semester']?></option>
							<?php
										}
									}
							?>
						</select>
	<!--para sa school year-->
						<select name = "sy">
						<option value = "" selected>Year Level</option>
							<?php
								$query = mysql_query("SELECT DISTINCT subject.subject_yrlvl FROM subject order by subject_yrlvl") or die(mysql_error());
									if(mysql_num_rows($query)>0){ 
										while($data = mysql_fetch_array($query)) {
							?>
						<option value = "<?php echo $data['subject_yrlvl']?>"><?php echo $data['subject_yrlvl']?></option>
							<?php
										}
									}
							?>
						</select>
						<input type = "submit" name = "find" value = "Search">
						</form>
						<br>
						<div style="width: 90%; height: 250px; overflow: auto;">
						<table class='menu_tab2' rules="all" width="100%"  border="1">
							<thead>
								<tr>
									<th rowspan="2">Subject Code</th>	
									<th rowspan="2">Subject Description</th>
									<th rowspan="2">Units</th>
									<th rowspan="2">Year Level</th>
									<th rowspan="2">Sem</th>
									<th>Create Schedule</th>
									
								</tr>
								
							</thead>
								<?php
								if(isset($_REQUEST['find'])){
									$find = $_REQUEST['find'];
									$course = $_REQUEST['course'];
									$sem = $_REQUEST['sem'];
									$sy = $_REQUEST['sy'];
									/*check if nag Select ka ug course sem ug yrlvl*/
									if (empty ($course) === true && empty($sem) === true && empty($sy) === true){
										echo "<script>alert('select Course, Semester and School year');window.location.href='createClass.php';</script>";
									}else if (empty ($course) === true){
										echo "<script>alert('select course');window.location.href='createClass.php';</script>";
									}else if (empty ($sem) === true){
										echo "<script>alert('select semester');window.location.href='createClass.php';</script>";
									}else if (empty ($sy) === true){
										echo "<script>alert('select school year');window.location.href='createClass.php';</script>";
									}
									
									$query = mysql_query("SELECT * FROM subject  WHERE subject.subject_course='$course' AND subject.subject_semester='$sem' AND subject.subject_yrlvl='$sy' ORDER by subject_semester");
									if(mysql_num_rows($query)>0){ 
									while($data = mysql_fetch_array($query)) {
								?>
							<tbody>
								<tr align='center'>
									<td><?php echo $data["subject_code"] ;?></td>
									<td><?php echo $data["subject_desc"] ;?></td>
									<td><?php echo $data["subject_units"] ;?></td>
									<td><?php echo $data["subject_yrlvl"] ;?></td>
									<td><?php echo $data["subject_semester"] ;?></td>
									<td>
										<a style="text-decoration:none;" href = 'generatedsched.php?set=<?php echo $data['subject_id'] ?>' title = 'Add class'>Generate</a>
									</td>
								</tr>
							</tbody>
								<?php
										}
									}
									else{
										echo "<script>alert('no record');window.location.href='createClass.php';</script>";
									}
								}
								else {
									$query=mysql_query("SELECT * FROM subject ORDER BY subject_yrlvl ASC  ");
									while($data=mysql_fetch_array($query)){
								?>

								<tr align='center'>
									<td><?php echo $data["subject_code"] ;?></td>
									<td><?php echo $data["subject_desc"] ;?></td>
									<td><?php echo $data["subject_units"] ;?></td>
									<td><?php echo $data["subject_yrlvl"] ;?></td>
									<td><?php echo $data["subject_semester"] ;?></td>
									<td>
										<a style="text-decoration:none;" href = 'generatedsched.php?set=<?php echo $data['subject_id'] ?>' title = 'Add class'>Generate</a>
									</td>
								</tr>
								<?php } } ?>
						</table>
					</center>
<br/><br/>

		   

                
<?php

                    $reload = $_SERVER['PHP_SELF'] . "?tpages=" . $tpages;
                    echo '<div><ul>';
                    if ($total_pages > 1) {
                        echo paginate($reload, $show_page, $total_pages);
                    }
                    echo "</ul></div>";
                    // display data in table
                    echo "<table class='menu_tab2' rules='all' width='100%'> <tr align='center'></tr>
                   <tr align='center'><th colspan='12'><h2><center>Class List</h2></th></tr>
                   <tr><th>Subject</th> 
                   <th>Course</th><th>Section</th> 
                   <th>Start</th><th>End</th> 
                   <th>Days</th><th>Room</th> 
                   <th>Size</th>
                   <th>School Year</th> 
                   <th>Semester</th> 
                   <th>Status</th>
                   <th>Action</th>";

                  
                    // loop through results of database query, displaying them in the table 
                    for ($i = $start; $i < $end; $i++) {
                        // make sure that PHP doesn't try to show results that don't exist
                        if ($i == $total_results) {
                            break;
                        }
                      
                        // echo out the contents of each row into a table
                        echo "<tr align='center' " . $cls . ">";
                        echo '<td>' . mysql_result($result, $i, 'subject_code') .'</td>';
                        echo '<td>' . mysql_result($result, $i, 'course_code') .'</td>';
                        echo '<td>' . mysql_result($result, $i, 'section_desc') . '</td>';
                        echo '<td>' . mysql_result($result, $i, 'start') . '</td>';
                        echo '<td>' . mysql_result($result, $i, 'end') . '</td>';
                        echo '<td>' . mysql_result($result, $i, 'monday') .' '. mysql_result($result, $i, 'tuesday') .' '. mysql_result($result, $i, 'wednesday').' '. mysql_result($result, $i, 'thursday').' '. mysql_result($result, $i, 'friday').' '. mysql_result($result, $i, 'saturday').' '. mysql_result($result, $i, 'sunday'). '</td>';
                        echo '<td>' . mysql_result($result, $i, 'room_code') .'|' . mysql_result($result, $i, 'room_description') .'</td>';
                        echo '<td>' . mysql_result($result, $i, 'Pop') .'/'. mysql_result($result, $i, 'size') . '</td>';
                        echo '<td>' . mysql_result($result, $i, 'school_yr') .'-' . mysql_result($result, $i, 'school_yr2') .  '</td>';
                        echo '<td>' . mysql_result($result, $i, 'sem') . '</td>';
                        echo '<td>' . mysql_result($result, $i, 'Status') . '</td>';
                        echo '<td>' .('<a href="#" >Edit</a>').'</td>';
                        echo "</tr>";
                    }       
                    // close table>
                echo "</table>";
            // pagination

            ?>


     <? /*<?php

$result=mysql_query("SELECT * FROM class,rooms,subject,section,course WHERE class.room=rooms.room_id AND class.scode=subject.subject_id AND class.section=section.section_id AND class.course=course.course_id ");
while($rows = mysql_fetch_array($result)){
		$subject_id=$rows['subject_id'];
		echo'<tr align="center">';
		echo'<td>'.$rows['subject_code']."|".$rows['subject_desc'].'</td>';
		echo'<td>'.$rows['course_code'].'</td>';
		echo'<td>'.$rows['section_desc'].'</td>';
		echo'<td>'.$rows['in'].'</td>';
		echo'<td>'.$rows['out'].'</td>';
		echo'<td>'.$rows['days'].'</td>';
		echo'<td>'.$rows['room_code']."|".$rows['room_description'].'</td>';
		echo'<td>'.$rows['Pop']."|".$rows['size'].'</td>';
		echo'<td>'.$rows['sy'].'</td>';
		echo'<td>'.$rows['sem'].'</td>';
		
		echo'<td>'.$rows['Status'].'</td>';
		
/*		echo'<td><a href="addsectionsubject.php?subject_id='.$subject_id.'"><strong>+</strong></td>';
		echo'<td><a href="viewsectionsubject.php?subject_id='.$subject_id.'"><strong>0_0</strong></td>';*/
		//echo'</tr>';


	
	/*$s=mysql_query("SELECT * FROM class");
	$r=mysql_fetch_array($s);
	if($r['Pop'] === $r['size']){
		mysql_query("UPDATE class SET Status='Full'");
	}else{
		mysql_query("UPDATE class SET Status='Not Full'");
	}
	*/
	?>

</table>
	</header>

		<p><h2>&nbsp;</h2> 
		</p>
		
		<footer>
			<div class="section">
				<p>
				</p>
			</div>
			
			
			
		</footer>	
	</div>
		<p style="text-align: center; padding: 0px;"></p>
</body>

</html>

