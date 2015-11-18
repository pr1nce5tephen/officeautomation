<?php
  include('../../config/connection.php');
  include('../../config/sy.php');
  require('../../auth.php');
  confirm_logged_in();
  check_level();
  $_SESSION['t']=0;
//Requested Data
  $course=$_REQUEST['parent_cat'];
  $yrlvl=$_REQUEST['sub_cat'];
  $section=$_REQUEST['section'];
  $sem=$_REQUEST['sem'];
//End of Requested Data

//query subjects
$subject=mysql_query("SELECT * FROM subject WHERE subject_course='$course' AND subject_yrlvl='$yrlvl' AND subject_semester='$sem'");
if(mysql_num_rows($subject) > 0){
while($getsubject=mysql_fetch_array($subject)){
$subid=$getsubject['subject_id'];
//end of subjects query

//query subject_time
$stime=mysql_query("SELECT * FROM subject_time WHERE subject_id = '$subid'");
$getstime=mysql_fetch_array($stime);
$pday=$getstime['per_day'];
//end of subject_time query

//query time
$time=mysql_query("SELECT * FROM a_time");
$gettime=mysql_fetch_array($time);
$r=$gettime['equiv'];

  $t=0;
  for($x=1;$x>0;$x++){
    if($t==$pday){
      $out=$row['out']; 
      //echo $out." ".$row['type']."<br/>";
      break;
    }else{
      $t=$t+$r;
      $_SESSION['t']++; 
      $p=$_SESSION['t'];
      $result=mysql_query("SELECT * FROM a_time WHERE t_id = '$p'");
      $row=mysql_fetch_assoc($result);
      if ($x==1){
        $in=$row['in'];
        //echo $in."-";
      } 
    }
 }
 //end of time query

//query school year
  $sy=mysql_query("SELECT * FROM sy WHERE sy_stat='active'");
  $getsy=mysql_fetch_array($sy);
//end of school year query

//query room
$room=mysql_query("SELECT * FROM rooms WHERE room_specification='$getsubject[subject_specification]'");
while($getroom=mysql_fetch_array($room)){
//end of room query

//query room size
$rsize=mysql_query("SELECT * FROM room_sizes WHERE room_id='$getroom[room_id]'");
$getrsize=mysql_fetch_array($rsize);
//end of room size query

//query days
$days=mysql_query("SELECT * FROM days WHERE no_day='$getstime[no_day_week]'");
$getdays=mysql_fetch_array($days);
//end of days query


     for($v=1; $v<=$section; $v++){ 
  $qq=mysql_query("SELECT * FROM ascheds WHERE `subject_id`='$subid' AND `course_id`='$course' AND `section_id`='$v' OR ('$in' BETWEEN `in` AND `out` OR '$out' BETWEEN `in` AND `out` OR `in`='$in' AND `out`='$out') AND `type`='$row[type]' AND `room_id`='$getroom[room_id]' AND `sy_id`='$getsy[sy_id]' AND `sem`='$sem' ");
  
  if(mysql_num_rows($qq) > 0){
    $getqq=mysql_fetch_array($qq);

    $count=0;
    if($getqq['monday'] != "" AND $getdays['monday'] != ""){
      $count++;
    }else if($getqq['tuesday'] != "" AND $getdays['tuesday'] != ""){
      $count++;
    }else if($getqq['wednesday'] != "" AND $getdays['wednesday'] != ""){
      $count++;
    }else if($getqq['thursday'] != "" AND $getdays['thursday'] != ""){
      $count++;
    }else if($getqq['friday'] != "" AND $getdays['friday'] != ""){
      $count++;
    }

    if($count != 0 ){

    }else{
       mysql_query("INSERT INTO ascheds(`sched_id`,`subject_id`,`course_id`,`yrlvl`,`in`,`out`,`type`,`section_id`,`room_id`,`size`,`pop`,`sy_id`,`sem`,`status`) VALUES('','$subid','$course','$yrlvl','$in','$out','$row[type]','$v','$getroom[room_id]','$getrsize[room_size]','0','$getsy[sy_id]','$sem','not full')");    
        $schedid=mysql_insert_id();
        mysql_query("UPDATE ascheds SET monday='$getdays[monday]', tuesday='$getdays[tuesday]', wednesday='$getdays[wednesday]', thursday='$getdays[thursday]', friday='$getdays[friday]' WHERE sched_id='$schedid' ");
    }
  }else{
  mysql_query("INSERT INTO ascheds(`sched_id`,`subject_id`,`course_id`,`yrlvl`,`in`,`out`,`type`,`section_id`,`room_id`,`size`,`pop`,`sy_id`,`sem`,`status`) VALUES('','$subid','$course','$yrlvl','$in','$out','$row[type]','$v','$getroom[room_id]','$getrsize[room_size]','0','$getsy[sy_id]','$sem','not full')");    
  $schedid=mysql_insert_id();

mysql_query("UPDATE ascheds SET monday='$getdays[monday]', tuesday='$getdays[tuesday]', wednesday='$getdays[wednesday]', thursday='$getdays[thursday]', friday='$getdays[friday]' WHERE sched_id='$schedid' ");
      }
     }
    }
  } 
 }
 else{
 //echo"<meta http-equiv='refresh' content='0; url=classmenu.php'><script>alert('failed to add schedules no subjects')</script>";
 }
//count from subject
$a=mysql_query("SELECT count(*) FROM subject WHERE `subject_semester`='$sem' AND `subject_course`='$course' AND `subject_yrlvl`='$yrlvl' ");
$b=mysql_fetch_array($a);
$cs = $b['0'];
$ms = $cs * $section ;
 echo $ms."<br/>";

//count from scheds
$c=mysql_query("SELECT count(*) FROM bscheds WHERE `sem`='$sem' AND `course_id`='$course' AND `yrlvl`='$yrlvl' ");
$d=mysql_fetch_array($c);

$ms2 = $cs2 * $section;
 //echo $ms2;
/*
echo $sem;
echo $course;
echo $yrlvl;*/
if($ms2 == '0'){
 $ms3 = $ms2 + $cs;
 echo $ms4 = $ms3 * $section;
  if($ms != $ms4)
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

   $s=mysql_query("SELECT * FROM ascheds WHERE course_id='$course' AND yrlvl='$yrlvl' AND sem='$sem'");
   while($t=mysql_fetch_array($s)){

  $trappings=mysql_query("SELECT * FROM bscheds WHERE `subject_id`='$t[subject_id]' AND `course_id`='$t[course_id]' AND `section_id`='$t[section_id]' OR ('$t[in]' BETWEEN `in` AND `out` OR '$t[out]' BETWEEN `in` AND `out` OR `in`='$t[in]' AND `out`='$t[out]') AND `type`='$t[type]' AND `room_id`='$t[room_id]' AND `sy_id`='$sy[sy_id]' AND `sem`='$sem' ");
  if(mysql_num_rows($trappings) > 0)
  {

  }
  else
    {
    $insert=mysql_query("INSERT INTO bscheds(`sched_id`,`subject_id`,`course_id`,`yrlvl`,`in`,`out`,`type`,`section_id`,`room_id`,`size`,`pop`,`sy_id`,`sem`,`status`)VALUES('','$t[subject_id]','$t[course_id]','$t[yrlvl]','$t[in]','$t[out]','$t[type]','$t[section_id]','$t[room_id]','$t[size]','$t[pop]','$t[sy_id]','$t[sem]','$t[status]')");
    $schedid=mysql_insert_id();
    mysql_query("UPDATE bscheds SET monday='$t[monday]', tuesday='$t[tuesday]', wednesday='$t[wednesday]', thursday='$t[thursday]', friday='$t[friday]' WHERE sched_id='$schedid' ");
  
    }
  }

  //$deleteexist=mysql_query("DELETE * FROM scheds WHERE EXISTS (SELECT * FROM schedules WHERE scheds.sched_id=schedules.sched_id)");
 echo"<meta http-equiv='refresh' content='0; url=classmenu.php'><script>alert('Schedules has been set successfully!')</script>";

    }
 } 
 else{
 /*}else{
 echo"<meta http-equiv='refresh' content='0; url=classmenu.php'><script>alert('Generating Schedule Failed!')</script>";
 }*/

?>
  <center/><fieldset style="width:25%;color:red;border-color:white;">
        This course has a subject that has not been scheduled because of the schedules availability<br/>
        Do you still want to add the schedule?<br/><br/>
        <h3><a href="confirmation2.php?course=<?php echo $course ?>&&yrlvl=<?php echo $yrlvl?>&&sem=<?php echo $sem ?>">Yes</a>  <a href="classmenu.php">No</a></h3></fieldset>
<?php } ?>