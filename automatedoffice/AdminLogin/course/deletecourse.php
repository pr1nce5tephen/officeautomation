<?php
error_reporting(0);
include('../../config/connection.php');
require('../../auth.php');
include('../../config/sy.php');
confirm_logged_in();
check_level();
$course_id=$_REQUEST['course_id'];
$querycourse=mysql_query("SELECT * FROM course WHERE `course_id`='$course_id' ");
$get=mysql_fetch_array($querycourse);
if($get['course_stat'] === 'Offered'){
	echo"<meta http-equiv = 'refresh' content='0; url = coursemain.php'>
	<script>alert('cannot delete course is still Offered')</script>";
}else{
mysql_query("delete from course where course_id='" .$course_id."'");
mysql_query("delete from course_yrlvl where course_id='" .$course_id. "'");
mysql_query("DELETE FROM subject WHERE subject_course='" .$course_id. "' ");
echo"<meta http-equiv = 'refresh' content='0; url = coursemain.php'>
				<script type='text/javascript'>alert('Record Deleted!')</script>";
}
?>
