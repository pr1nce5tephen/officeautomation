<?php 
error_reporting(0);
	 include('../../config/connection.php');
	 require('../../auth.php');
 	confirm_logged_in();
if(isset($_REQUEST['stat'])){
$student_id=$_REQUEST['student_id'];
$status=$_REQUEST['status'];
mysql_query("UPDATE student SET status='$status' WHERE student_id='$student_id' ");
echo "<meta http-equiv = 'refresh' content='0; url=studentmain.php' />";
}

?>