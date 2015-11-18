<?php
  include('../../config/connection.php');
  include('../../config/sy.php');
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
      <script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {   
  $("#parent_cat").change(function() {
    //$(this).after('<div id="loader"><img src="img/loading.gif" alt="loading subcategory" /></div>');
    $.get('loadsubcat2.php?parent_cat=' + $(this).val(), function(data) {
      $("#sub_cat").html(data);
      $('#loader').slideUp(200, function() {
        $(this).remove();
      });
    }); 
    });
});
</script>		
		</head>
		<body>
			
      <!--menu-->
       <?php include('../../menu/nav2.php');?>

<br/>
 <center>
<fieldset style="width:60%; border-color:green; ">
	<pre>Generate Schedules:</pre>

<table cellspacing="15px">
	<form action="confirmation.php" method="post">
		<tr>
        <td><label for="category">Course:</label></td>
          <td>
            <select name="parent_cat" id="parent_cat" required>
        <option value="">---Select Course---</option>
        <?php $q = mysql_query("SELECT * FROM course WHERE course_stat ='Offered' ORDER BY course_id asc");
        while($r = mysql_fetch_array($q)){
        $name = $r['course_code']; 
        ?>
        <option value="<?php echo $r['course_id'];?>"><?php echo $name ?></option>
        <?php }?>
        </select></td>
    </tr><tr>
    <td><label>Year Level:</label></td>
    <td><select name="sub_cat" id="sub_cat" required></select></td>
	</tr>
  <tr>
			<td>Number of Sections:</td><td>
      <input type="" name="section" size="2" maxlength="1" placeholder='1-9' pattern='^([1-9]){1,}$' required/>
      </td>
  </tr><tr>
			<td>Semester:</td><td>
        <select name="sem" required>
          <option value="">-semester-</option>
          <option value="1">1st</option>
          <option value="2">2nd</option>
          <option value="summer">summer</option>
        </select>
      </td><br/>
	 </tr><tr>
			<td><input class="button" type="submit" name="add" value="Generate"/></td>
		</tr>
</table>
</form>
</center>
</fieldset><br/><br/>
<hr style="border-width:15px;">
<center>

  
<!--Filter Records-->
<br/></center>
<center>
<form action="" method="post">
  
  <select name="course">
    <option value="">--Course--</option>
    <?php 
      $course=mysql_query("SELECT * FROM course");
      while($getcourse=mysql_fetch_array($course)){
    ?>
      <option value="<?php echo $getcourse['course_id']?>"><?php echo $getcourse['course_code']?></option>
    <?php } ?>
  </select>
  
  <select name="yrlvl">
    <option value="">--Year Level--</option>
    <?php 
      $yrlvl=mysql_query("SELECT DISTINCT yrlvl FROM ascheds");
      while($getyrlvl=mysql_fetch_array($yrlvl)){
    ?>
      <option value="<?php echo $getyrlvl['yrlvl']?>"><?php echo $getyrlvl['yrlvl']?></option>
    <?php } ?>
  </select>
  
  <select name="sem">
    <option value="">--Semester--</option>
    <?php 
      $sem=mysql_query("SELECT DISTINCT sem FROM ascheds ORDER BY sem ASC");
      while($getsem=mysql_fetch_array($sem)){
    ?>
      <option value="<?php echo $getsem['sem']?>"><?php echo $getsem['sem']?></option>
    <?php } ?>
  </select>
  
  <select name="sy">
    <option value="">--School Year--</option>
    <?php 
      $sy=mysql_query("SELECT * FROM sy WHERE sy_stat='active' ORDER BY sy_id ASC");
      while($getsy=mysql_fetch_array($sy)){
    ?>
      <option value="<?php echo $getsy['sy_id']?>"><?php echo $getsy['school_yr'].'-'.$getsy['school_yr2']?></option>
    <?php } ?>
  </select>

  <input class="button" type="submit" name="find" value="Search" />
</form>

	<br>
<table class='menu_tab2' rules="all" width="100%"  border="1">
  <tr align='center'></tr>
    <tr align='center'><th colspan='13'><h2><center>Class List</h2></th></tr>
    <tr><th>Subject</th> 
    <th>Course</th><th>Units</th><th>Year Level</th><th>Section</th> 
    <th>Time and Days</th>
    <th>Room</th> 
    <th>Population</th>
    <th>School Year</th> 
    <th>Semester</th> 
    <th>Instructor</th>
    <th>Status</th>
    <th>Remove Schedule</th>        
<?php 
$course=$_POST['course'];
$yrlvl=$_POST['yrlvl'];
$sem=$_POST['sem'];
$sy=$_POST['sy'];
//$find=$_POST['find'];

if(isset($_REQUEST['find']))
{
  if(empty($course) == true && empty($yrlvl) == true && empty($sem) == true && empty($sy) == true)
  {
    echo"<script>alert('course, yearlevel, semester and school year is empty')</script>";
    echo'<tr align="center"><td colspan="13">No Records Found</td></tr>';
  }
  else if(!empty($course) == true && empty($yrlvl) == true && empty($sem) == true && empty($sy) == true)
  {
     echo"<script>alert('yearlevel, semester and school year is empty')</script>"; 
     echo'<tr align="center"><td colspan="13">No Records Found</td></tr>';
  }
  else if(!empty($course) == true && !empty($yrlvl) == true && empty($sem) == true && empty($sy) == true)
  {
     echo"<script>alert('semester and school year is empty')</script>"; 
     echo'<tr align="center"><td colspan="13">No Records Found</td></tr>';
  }
   else if(!empty($course) == true && !empty($yrlvl) == true && !empty($sem) == true && empty($sy) == true)
  {
     echo"<script>alert('school year is empty')</script>"; 
     echo'<tr align="center"><td colspan="13">No Records Found</td></tr>';
  }
    else if(empty($course) == true && empty($yrlvl) == true && empty($sem) == true && !empty($sy) == true)
  {
     echo"<script>alert('course, yearlevel and semester is empty')</script>";
     echo'<tr align="center"><td colspan="1313">No Records Found</td></tr>'; 
  }
    else if(empty($course) == true && empty($yrlvl) == true && !empty($sem) == true && !empty($sy) == true)
  {
     echo"<script>alert('course and yearlevel is empty')</script>"; 
     echo'<tr align="center"><td colspan="12">No Records Found</td></tr>';
  }
    else if(empty($course) == true && !empty($yrlvl) == true && !empty($sem) == true && !empty($sy) == true)
  {
     echo"<script>alert('course is empty')</script>"; 
     echo'<tr align="center"><td colspan="1313">No Records Found</td></tr>';
  }
    else if(empty($course) == true && !empty($yrlvl) == true && !empty($sem) == true && empty($sy) == true)
  {
     echo"<script>alert('course and school year is empty')</script>"; 
     echo'<tr align="center"><td colspan="1313">No Records Found</td></tr>';
  }
    else if(empty($course) == true && !empty($yrlvl) == true && empty($sem) == true && empty($sy) == true)
  {
     echo"<script>alert('course, semester and school year is empty')</script>"; 
     echo'<tr align="center"><td colspan="1313">No Records Found</td></tr>';
  }
    else if(empty($course) == true && empty($yrlvl) == true && !empty($sem) == true && empty($sy) == true)
  {
     echo"<script>alert('course, yearlevel and school year is empty')</script>"; 
     echo'<tr align="center"><td colspan="1313">No Records Found</td></tr>';
  }
    else if(empty($course) == true && !empty($yrlvl) == true && empty($sem) == true && !empty($sy) == true)
  {
     echo"<script>alert('course and semester is empty')</script>"; 
     echo'<tr align="center"><td colspan="1313">No Records Found</td></tr>';
  }
    else if(!empty($course) == true && empty($yrlvl) == true && empty($sem) == true && !empty($sy) == true)
  {
     echo"<script>alert('yrlvl and semester is empty')</script>"; 
     echo'<tr align="center"><td colspan="1313">No Records Found</td></tr>';
  }
    else if(!empty($course) == true && empty($yrlvl) == true && !empty($sem) == true && empty($sy) == true)
  {
     echo"<script>alert('yrlvl and school year is empty')</script>"; 
     echo'<tr align="center"><td colspan="1313">No Records Found</td></tr>';
  }
    else if(!empty($course) == true && !empty($yrlvl) == true && !empty($sem) == true && !empty($sy) == true)
  {
$result = mysql_query("SELECT * FROM bscheds,rooms,subject,course,sy,faculty WHERE bscheds.room_id=rooms.room_id AND bscheds.subject_id=subject.subject_id AND bscheds.course_id=course.course_id AND bscheds.sy_id=sy.sy_id AND bscheds.fcode=faculty.fcode AND sy.sy_stat='active' AND bscheds.course_id='$course' AND bscheds.yrlvl='$yrlvl' AND bscheds.sem='$sem' AND bscheds.sy_id='$sy' ORDER BY bscheds.section_id ASC");
if(mysql_num_rows($result) > 0){
while($getresult=mysql_fetch_array($result)){
  $total_units=$getresult['subject_units'] + $getresult['subject_units_lec'];
?>
<tr align="center">
  <td><?php echo $getresult['subject_code']?></td>
  <td><?php echo $getresult['course_code']?></td>
  <td><?php echo $total_units?></td>
  <td><?php echo $getresult['yrlvl']?></td>
  <td><?php echo $getresult['section_id']?></td>
  <td><a style="text-decoration:none;" href="classtimeedit.php?sched_id=<?php echo $getresult['sched_id']?>&&rid=<?php echo $getresult['room_id']?>&&in=<?php echo $getresult['in']?>&&out=<?php echo $getresult['out']?>&&type=<?php echo $getresult['type']?>"><?php echo $getresult['in'].'-'.$getresult['out'].''.$getresult['type'].' '.$getresult['monday'].' '.$getresult['tuesday'].' '.$getresult['wednesday'].' '.$getresult['thursday'].' '.$getresult['friday']?></a></td>
  <td><a style="text-decoration:none;" href="classroomedit.php?sched_id=<?php echo $getresult['sched_id']?>&&rid=<?php echo $getresult['room_id']?>&&in=<?php echo $getresult['in']?>&&out=<?php echo $getresult['out']?>&&sid=<?php echo $getresult['subject_id']?>"><?php echo $getresult['room_code'].'/'.$getresult['room_description']?></a></td>
  <td><?php echo $getresult['pop'].'/'.$getresult['size']?></td>
  <td><?php echo $getresult['school_yr'].'-'.$getresult['school_yr2']?></td>
  <?php if($getresult['sem'] == 1){ ?>
  <td><?php echo $getresult['sem'].''.st ?></td>
  <?php }else if($getresult['sem'] == 2){ ?>
  <td><?php echo $getresult['sem'].''.nd ?></td>
  <?php }else{ ?>
  <td><?php echo $getresult['sem']?></td>
  <?php } ?>
  <td><a style="text-decoration:none;" href="#"><?php echo $getresult['lname'].', '.$getresult['fname'].' '.$getresult['mi'].'.'?></a></td>
  <td><?php echo $getresult['status']?></td>
  <td><a href="removeclass.php?cid=<?php echo $getresult['sched_id']?>" onclick="return confirm('are you sure you want to remove this class')">Remove Class</a></td>
</tr>
<!--Update status-->
<?php 
  mysql_query("UPDATE bscheds SET status='full' WHERE pop = '$getresult[size]' ");
  } } } }else{   
?>
<tr align="center"><td colspan="13">No Records Found</td></tr>
		<?php }
    $ch=mysql_query("SELECT * FROM bscheds WHERE `size`!=`pop` ");
    while($getch=mysql_fetch_array($ch)){
      //echo $getch['sched_id'];
    mysql_query("UPDATE bscheds SET status='not full' WHERE sched_id = '$getch[sched_id]' ");
    }
    //mysql_query("DELETE FROM scheds WHERE NOT EXISTS(SELECT * FROM schedules WHERE scheds.sched_id=schedules.sched_id)");
     ?>   
<!--END of Update status!-->


</table><br/>
<hr style="border-width:15px;">
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

