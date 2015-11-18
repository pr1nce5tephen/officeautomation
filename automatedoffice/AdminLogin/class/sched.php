<?php 
 include('../../config/connection.php');
 include('../../config/sy.php');
 require('../../auth.php');
 	confirm_logged_in();
  check_level();
	$course=$_REQUEST['parent_cat'];
  $yrlvl=$_REQUEST['sub_cat'];
  $section=$_REQUEST['section'];
  $sem=$_REQUEST['sem'];


   $subject=mysql_query("SELECT * FROM subject WHERE subject_course='$course' AND subject_yrlvl='$yrlvl' AND subject_semester='$sem' ");
   if(mysql_num_rows($subject) > 0){
   while($s=mysql_fetch_array($subject)){

    $time=mysql_query("SELECT * FROM ctime WHERE units='$s[subject_units]'");
    $t=mysql_fetch_array($time);

   	$schoolyr=mysql_query("SELECT * FROM sy WHERE sy_stat='active'");
   $sy=mysql_fetch_assoc($schoolyr);

  $room=mysql_query("SELECT * FROM rooms WHERE room_specification='$s[subject_specification]'");
    $r=mysql_fetch_array($room);

     $roomsizes=mysql_query("SELECT * FROM room_sizes WHERE room_id='$r[room_id]' ");
    $rs=mysql_fetch_array($roomsizes);

for($sec=1; $sec<=$section; $sec++){

$trappings=mysql_query("SELECT * FROM scheds WHERE `subject_id`='$s[subject_id]' AND `course_id`='$s[subject_course]' AND `section_id`='$sec' AND `time_id`='$t[time_id]' AND `room_id`='$r[room_id]' AND `sy_id`='$sy[sy_id]' AND `sem`='$sem' ");
if(mysql_num_rows($trappings) > 0)
	{
    
	}else{
   		$insert=mysql_query("INSERT INTO scheds(`sched_id`,`subject_id`,`course_id`,`yrlvl`,`time_id`,`section_id`,`room_id`,`size`,`pop`,`sy_id`,`sem`,`status`)VALUES('','$s[subject_id]','$course','$s[subject_yrlvl]','$t[time_id]','$sec','$r[room_id]','$rs[room_size]','0','$sy[sy_id]','$sem','not full')");
	     //echo"<meta http-equiv='refresh' content='5; url=classmenu.php'>";
    }
   	 }
   	}
   }
   
   


//count from subject
$a=mysql_query("SELECT count(*) FROM subject WHERE `subject_semester`='$sem' AND `subject_course`='$course' AND `subject_yrlvl`='$yrlvl' ");
$b=mysql_fetch_array($a);
$cs = $b['0'];
$ms = $cs * $section;
echo $ms."<br/>";

//count from scheds
$c=mysql_query("SELECT count(*) FROM scheds WHERE `sem`='$sem' AND `course_id`='$course' AND `yrlvl`='$yrlvl' ");
$d=mysql_fetch_array($c);
$cs2 = $d['0'];
$ms2 = $cs2 * $section;
echo $ms2;

  if($ms != $ms2)
  {
  ?>
<center/><fieldset style="width:25%;color:red;border-color:white;">
      This course has a subject that has not been scheduled because of the schedules availability<br/>
      Do you still want to add the schedule?<br/><br/>
      <h3><a href="confirmation2.php?course=<?php echo $course ?>&&yrlvl=<?php echo $yrlvl?>&&sem=<?php echo $sem ?>">Yes</a>  <a href="classmenu.php">No</a></h3></fieldset>

<?php
  }
  else
  {
    $s=mysql_query("SELECT * FROM scheds WHERE course_id='$course' AND yrlvl='$yrlvl' AND sem='$sem'");
while($t=mysql_fetch_array($s)){

$trappings=mysql_query("SELECT * FROM schedules WHERE `subject_id`='$t[subject_id]' AND `course_id`='$t[course_id]' AND `section_id`='$t[section_id]' OR `time_id`='$t[time_id]' AND `room_id`='$t[room_id]' AND `sy_id`='$sy[sy_id]' AND `sem`='$sem' ");
if(mysql_num_rows($trappings) > 0){


}else{
$insert=mysql_query("INSERT INTO schedules(`sched_id`,`subject_id`,`course_id`,`yrlvl`,`time_id`,`section_id`,`room_id`,`size`,`pop`,`sy_id`,`sem`,`status`)VALUES('','$t[subject_id]','$t[course_id]','$t[yrlvl]','$t[time_id]','$t[section_id]','$t[room_id]','$t[size]','$t[pop]','$t[sy_id]','$t[sem]','$t[status]')");
}
}
//$deleteexist=mysql_query("DELETE * FROM scheds WHERE EXISTS (SELECT * FROM schedules WHERE scheds.sched_id=schedules.sched_id)");
echo"<meta http-equiv='refresh' content='0; url=classmenu.php'><script>alert('Schedules has been set successfully!')</script>";

  }
  
 /*}else{
 echo"<meta http-equiv='refresh' content='0; url=classmenu.php'><script>alert('Generating Schedule Failed!')</script>";
 }*/
?>
