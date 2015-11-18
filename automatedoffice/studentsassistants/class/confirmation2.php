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

$s=mysql_query("SELECT * FROM scheds WHERE course_id='$course' AND yrlvl='$yrlvl' AND sem='$sem'");
while($t=mysql_fetch_array($s)){

$trappings=mysql_query("SELECT * FROM schedules WHERE `subject_id`='$t[subject_id]' AND `course_id`='$t[course_id]' AND `section_id`='$t[section_id]' OR `time_id`='$t[time_id]' AND `room_id`='$t[room_id]' AND `sy_id`='$sy[sy_id]' AND `sem`='$sem' ");
if(mysql_num_rows($trappings) > 0){

}else{
$insert=mysql_query("INSERT INTO schedules(`sched_id`,`subject_id`,`course_id`,`yrlvl`,`time_id`,`section_id`,`room_id`,`size`,`pop`,`sy_id`,`sem`,`status`)VALUES('','$t[subject_id]','$t[course_id]','$t[yrlvl]','$t[time_id]','$t[section_id]','$t[room_id]','$t[size]','$t[pop]','$t[sy_id]','$t[sem]','$t[status]')");
}
}

//$deleteexist=mysql_query("DELETE FROM scheds WHERE EXISTS (SELECT * FROM schedules WHERE scheds.sched_id=schedules.sched_id)");
echo"<meta http-equiv='refresh' content='0; url=classmenu.php'><script>alert('Schedules has been set successfully!')</script>";

?>