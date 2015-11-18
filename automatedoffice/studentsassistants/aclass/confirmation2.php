<?php 
//if returns yes in sched.php this page will be executed
 include('../../config/connection.php');
 include('../../config/sy.php');
 require('../../auth.php');
 confirm_logged_in();
	check_level();
$course = $_REQUEST['course'];
$yrlvl = $_REQUEST['yrlvl'];
$sem = $_REQUEST['sem'];

$s=mysql_query("SELECT * FROM ascheds WHERE course_id='$course' AND yrlvl='$yrlvl' AND sem='$sem'");
while($t=mysql_fetch_array($s)){

$trappings=mysql_query("SELECT * FROM bscheds WHERE `subject_id`='$t[subject_id]' AND `course_id`='$t[course_id]' AND `section_id`='$t[section_id]' OR ('$t[in]' BETWEEN `in` AND `out` OR '$t[out]' BETWEEN `in` AND `out` OR `in`='$t[in]' AND `out`='$t[out]') AND `type`='$t[type]' AND `room_id`='$t[room_id]' AND `sy_id`='$sy[sy_id]' AND `sem`='$sem' ");
if(mysql_num_rows($trappings) > 0){


}else{
$insert=mysql_query("INSERT INTO bscheds(`sched_id`,`subject_id`,`course_id`,`yrlvl`,`in`,`out`,`type`,`section_id`,`room_id`,`size`,`pop`,`sy_id`,`sem`,`status`)VALUES('','$t[subject_id]','$t[course_id]','$t[yrlvl]','$t[in]','$t[out]','$t[type]','$t[section_id]','$t[room_id]','$t[size]','$t[pop]','$t[sy_id]','$t[sem]','$t[status]')");
$schedid=mysql_insert_id();
mysql_query("UPDATE bscheds SET monday='$t[monday]', tuesday='$t[tuesday]', wednesday='$t[wednesday]', thursday='$t[thursday]', friday='$t[friday]' WHERE sched_id='$schedid' ");}
}

//$deleteexist=mysql_query("DELETE FROM scheds WHERE EXISTS (SELECT * FROM schedules WHERE scheds.sched_id=schedules.sched_id)");
echo"<meta http-equiv='refresh' content='0; url=classmenu.php'><script>alert('Schedules has been set successfully!')</script>";

?>