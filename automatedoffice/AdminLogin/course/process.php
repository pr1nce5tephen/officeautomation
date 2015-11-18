<?php //update the course status if it is offered or Not offered
error_reporting(0);
	 include('../../config/connection.php');
	 require('../../auth.php');
	 include('../../config/sy.php');
 	confirm_logged_in();
 	check_level();
if(isset($_REQUEST["course_stat"])) {
$id = $_REQUEST["course_id"];
$status = $_REQUEST["status"];

mysql_query("UPDATE course SET course_stat = '$status' WHERE course_id = '$id' ")or die(mysql_error());
echo "<meta http-equiv = 'refresh' content='0; url=coursemain.php' />";
}
?>