<?php 
 include('../../config/connection.php');
 include('../../config/sy.php');
 require('../../auth.php');
 confirm_logged_in();
  check_level();
$da=date(Y) + 1;
$date=date(Y);
    $course=$_REQUEST['parent_cat'];
    $yrlvl=$_REQUEST['sub_cat'];
    $section=$_REQUEST['section'];
    $sem=$_REQUEST['sem'];
    //$section2=$_REQUEST['section2'];
    //$sum=$section + $section2;
    
//$notin=mysql_query("SELECT * FROM subject WHERE NOT EXISTS (SELECT * FROM schedules WHERE subject.subject_id = schedules.subject_id) AND subject.subject_course='$course' AND subject.subject_yrlvl='$yrlvl' AND subject.subject_semester='$sem'");

    $yr=mysql_query("SELECT * FROM sy WHERE school_yr='$date' AND school_yr2='$da' ");
    $syr=mysql_fetch_array($yr);
    $sy_id=$syr['sy_id'];

   /* $check=mysql_query("SELECT * FROM schedules WHERE course_id='$course' AND yrlvl='$yrlvl' AND sem='$sem' ");
    $getcheck=mysql_fetch_array($check);
    $checksection=$getcheck['section_id'];*/

    $countsection=mysql_query("SELECT count(DISTINCT schedules.section_id) FROM schedules WHERE  course_id='$course' AND yrlvl='$yrlvl' AND sem='$sem' AND sy_id='$sy_id' ");
    $getcountsection=mysql_fetch_array($countsection);
    $csection=$getcountsection[0];

    $sumsection=$csection + $section;

   $subject=mysql_query("SELECT * FROM subject WHERE subject_course='$course' AND subject_yrlvl='$yrlvl' AND subject_semester='$sem' ");
   if(mysql_num_rows($subject) > 0){
   while($s=mysql_fetch_array($subject)){

      $time=mysql_query("SELECT * FROM ctime WHERE units='$s[subject_units]'");
    while($t=mysql_fetch_array($time)){
      
    $room=mysql_query("SELECT * FROM rooms WHERE room_specification='$s[subject_specification]'");
    if(mysql_num_rows($room) > 0){
    while($r=mysql_fetch_array($room)){

  $roomsizes=mysql_query("SELECT * FROM room_sizes WHERE room_id='$r[room_id]' ");
    $rs=mysql_fetch_array($roomsizes);


    $schoolyr=mysql_query("SELECT * FROM sy WHERE sy_stat='active'");
    while($sy=mysql_fetch_assoc($schoolyr)){

for($sec=1; $sec<=$sumsection; $sec++){

$trappings=mysql_query("SELECT * FROM scheds WHERE `subject_id`='$s[subject_id]' AND `course_id`='$s[subject_course]' AND `section_id`='$sec' OR `time_id`='$t[time_id]' AND `room_id`='$r[room_id]' AND `sy_id`='$sy[sy_id]' AND `sem`='$sem' ");
if(mysql_num_rows($trappings) > 0)
  {
    
  }
  else
  {
    $insert=mysql_query("INSERT INTO scheds(`sched_id`,`subject_id`,`course_id`,`yrlvl`,`time_id`,`section_id`,`room_id`,`size`,`pop`,`sy_id`,`sem`,`status`)VALUES('','$s[subject_id]','$course','$s[subject_yrlvl]','$t[time_id]','$sec','$r[room_id]','$rs[room_size]','0','$sy[sy_id]','$sem','not full')");
       //echo"<meta http-equiv='refresh' content='5; url=classmenu.php'>";
  }
     }
    }
   }
   }
   }
   }
 }
 if(!$insert){
echo"<meta http-equiv='refresh' content='0; url=classmenu.php'><script>alert('Failed to add schedules!, no available schedules to set')</script>";
}else{
//echo"<meta http-equiv='refresh' content='0; url=classmenu.php'><script>alert('Schedules has been set successfully!')</script>";

//count from subject
$a=mysql_query("SELECT count(*) FROM subject WHERE subject_semester='$sem' AND subject_course='$course' AND subject_yrlvl='$yrlvl' ");
$b=mysql_fetch_array($a);
$cs = $b['0'];
$ms = $cs * $section;

//count from scheds
$c=mysql_query("SELECT count(*) FROM scheds WHERE sem='$sem' AND course_id='$course' AND yrlvl='$yrlvl' ");
$d=mysql_fetch_array($c);
$cs2 = $d['0'];
$ms2 = $cs2 * $section;

  if($ms != $ms2)
  {
  ?>
  <center/><fieldset style="width:25%;color:red;"><pre>Message</pre>
        This course has a subject that has not been scheduled because of the schedules availability<br/>
        Do you still want to add the schedule?<br/>
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


  }
}
/*
echo"<fieldset style='width:15%;border-color:red;'><pre>subjects with no available rooms</pre>";
 if(mysql_num_rows($notin) > 0){
 while($getnotin=mysql_fetch_array($notin)){
echo"$getnotin[subject_desc]<br/>";
 }
 //echo"<a href='classmenu.php'>Back</a>";
 }else{
  echo"<meta http-equiv='refresh' content='0; url=classmenu.php'>";
 }
 //if(){}
 echo"</fieldset>";*/
?><!--
<table border='1'>

</table>
<a href='classmenu.php'>Back</a>-->

