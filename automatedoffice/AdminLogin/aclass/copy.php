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
    
      break;
    }else{
      $t=$t+$r;
      $_SESSION['t']++; 
      $p=$_SESSION['t'];
      $result=mysql_query("SELECT * FROM a_time WHERE t_id = '$p'");
      $row=mysql_fetch_assoc($result);
      if ($x==1){
        $in=$row['in'];
       // echo $row['in']."-";
      }
    } 
    for($v=1; $v<=$section; $v++){
            mysql_query("INSERT INTO scheds(`sched_id`,`subject_id`,`course_id`,`yrlvl`,`in`,`out`,`section_id`,`size`,`pop`,`sy_id`,`sem`,`status`) VALUES('','$subid','$course','$in','$out','$v','','','','','')");
          }
  }
  echo "<br>";
//end of time query

//query days
$days=mysql_query("SELECT * FROM days");

//end of days query

}


?>