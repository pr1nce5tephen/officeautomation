	<?php
 error_reporting(0);
include('../../config/connection.php');
 require('../../auth.php');
 	confirm_logged_in();
 	check_level();
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

      <br/>
      <center/>

<form action="subjectmain.php" method="POST">

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
						<!--this select to get semester-->
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
						<!--this select to get year level-->
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
						<input class='button' type = "submit" name = "find" value = "Search"> <a style="text-decoration:none;" href='subjectadd.php'/><input class='button' type="button" value="Add a Subject"/></a>
						</form>

						<br>
						<table class='menu_tab2' rules="all" width="95%"  border="1">
							<thead>
								<tr>
									<th rowspan="2">Subject Code</th>	
									<th rowspan="2">Subject Description</th>
									<th colspan="3">Subject Units</th>
									<th rowspan="2">Course</th>
									<th rowspan="2">Year Level</th>
									<th rowspan="2">Semester</th>
									<th rowspan="2"> Type</th>
									<th rowspan="2"> Prerequisite(s)</th>
									<!--<th rowspan="2"> Corequisite(s)</th>-->
									<th rowspan="2">Action</th>
								</tr>
							<tr><th> Lecture</th>
								<th>Laboratory </th>
								<th>Total Units</th>
							</tr>
								
							</thead>
								<?php
								if(isset($_REQUEST['find'])){
									$course = $_REQUEST['course'];
									$sem = $_REQUEST['sem'];
									$sy = $_REQUEST['sy'];
									/*check if nag Select ka ug course sem ug yrlvl*/
									if (empty ($course) === true && empty($sem) === true && empty($sy) === true){
										echo "<script>alert('select Course Semester and year level');window.location.href='subjectmain.php';</script>";
									}else if (empty ($course) === true){
										echo "<script>alert('select course');window.location.href='subjectmain.php';</script>";
									}else if (empty ($sem) === true){
										echo "<script>alert('select semester');window.location.href='subjectmain.php';</script>";
									}else if (empty ($sy) === true){
										echo "<script>alert('select school year');window.location.href='subjectmain.php';</script>";
									}
									
									$query = mysql_query("SELECT * FROM subject,specification,course WHERE subject.subject_specification=specification.specification_id AND subject.subject_course=course.course_id AND subject.subject_course='$course' AND subject.subject_semester='$sem' AND subject.subject_yrlvl='$sy' ORDER by subject_semester ASC");
									if(mysql_num_rows($query)>0){ 
									//$querysubject = mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.prerequisite=subject.subject_id");
								
									while($data = mysql_fetch_array($query)) {	
										$querysubject = mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.prerequisite=subject.subject_id AND prerequisites.subject_id='$data[subject_id]' ");
										$getquerysubjectpre=mysql_fetch_array($querysubject);

										$querysubject = mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.corequisite=subject.subject_id AND prerequisites.subject_id='$data[subject_id]' ");	
										$getquerysubjectco=mysql_fetch_array($querysubject);

									$total_units=$data["subject_units_lec"] + $data["subject_units"];
								?>
								
							<tbody>
								<tr align='center'>
									<td><?php echo $data["subject_code"] ;?></td>
									<td><?php echo $data["subject_desc"] ;?></td>
									<td><?php echo $data["subject_units_lec"] ;?></td>
									<td><?php echo $data["subject_units"] ;?></td>
									<td><?php echo $total_units; ?></td>
									<td><?php echo $data["course_code"] ;?></td>
									<td><?php echo $data["subject_yrlvl"] ;?></td>
									<td><?php echo $data["subject_semester"] ;?></td>
									<td><?php echo $data["specification"] ;?></td>
								<?php if($getquerysubjectpre["subject_code"] != 'none' AND empty($getquerysubjectco['corequisite']) == true ){ ?>
									<td><?php echo $getquerysubjectpre["subject_code"]; }else if($getquerysubjectpre["subject_code"] != 'none' AND empty($getquerysubjectco['corequisite']) != true ){?></td>
									<!--<td><?php //if(empty($getquerysubjectco['corequisite']) != true ){echo "Corequisite-".$getquerysubjectco["subject_code"]; }?></td>-->
									<td><?php echo "Co-req: ".$getquerysubjectco["subject_code"]; }?></td>
		 							<td><a style='text-decoration:none;' href = 'updatesubject.php?subject_id=<?php echo $data['subject_id']?>'>Edit</td>
									
								</tr>
							</tbody>
							
								<?php
										}
									}
									else{
										echo "<script>alert('no record');window.location.href='subjectmain.php';</script>";
									}?>
									<?php
								}else{
								$query = mysql_query("SELECT * FROM subject,specification,course WHERE subject.subject_specification=specification.specification_id AND subject.subject_course=course.course_id  ORDER by subject_semester ASC");
								while($data = mysql_fetch_array($query)) {
									$querysubject = mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.prerequisite=subject.subject_id AND prerequisites.subject_id='$data[subject_id]' ");	
									$getquerysubjectpre=mysql_fetch_array($querysubject);

									$querysubject = mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.corequisite=subject.subject_id AND prerequisites.subject_id='$data[subject_id]' ");	
									$getquerysubjectco=mysql_fetch_array($querysubject);

									$total_units=$data["subject_units_lec"] + $data["subject_units"];
								?>
								<tbody>
								<tr align='center'>
									<td><?php echo $data["subject_code"] ;?></td>
									<td><?php echo $data["subject_desc"] ;?></td>
									<td><?php echo $data["subject_units_lec"] ;?></td>
									<td><?php echo $data["subject_units"] ;?></td>
									<td><?php echo $total_units ;?></td>
									<td><?php echo $data["course_code"] ;?></td>
									<td><?php echo $data["subject_yrlvl"] ;?></td>
									<td><?php echo $data["subject_semester"] ;?></td>
									<td><?php echo $data["specification"] ;?></td>
									<?php if($getquerysubjectpre["subject_code"] != 'none' AND empty($getquerysubjectco['corequisite']) == true ){ ?>
									<td><?php echo $getquerysubjectpre["subject_code"]; }else if($getquerysubjectpre["subject_code"] != 'none' AND empty($getquerysubjectco['corequisite']) != true ){?></td>
									<!--<td><?php //if(empty($getquerysubjectco['corequisite']) != true ){echo "Corequisite-".$getquerysubjectco["subject_code"]; }?></td>-->
									<td><?php echo "Co-req: ".$getquerysubjectco["subject_code"]; }?></td>
		 							<td><a style='text-decoration:none;' href = 'updatesubject.php?subject_id=<?php echo $data['subject_id']?>'>Edit</td>
									
								</tr>
							</tbody>

							<?php } } ?>
						</table>

					</center>
<br/><br/>

</center>

	</header>

		
		
			
	  
	
	  <div align='center'class='menu_nav3'>
						
							
								
						
								
			</div>
	  
	  
			
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