<?php
//require_once('../session.php');
 include('../../config/connection.php');
	 require('../../auth.php');
	 include('../../config/sy.php');
 	confirm_logged_in();
	check_level();
 //update the instructor status to Active or Inactive
if(isset($_REQUEST["instructor_stat"])) {
$status = $_REQUEST["status"];
$fcode = $_REQUEST["fcode"];


mysql_query("UPDATE faculty SET status = '$status' WHERE fcode = '$fcode' ")or die(mysql_error());

echo "<meta http-equiv = 'refresh' content='0; url=instructormain.php' />";
}


 //Update Profile of instructor
 if(isset($_REQUEST['update'])) {
	$id = $_REQUEST['fcode'];
	$lname = $_REQUEST['lname'];
	$fname = $_REQUEST['fname'];
	$mi = $_REQUEST['mi'];
	$address = $_REQUEST['address'];
	$gender = $_REQUEST['gender'];
	$contactno = $_REQUEST['contactno'];
	$position = $_REQUEST['position'];
	$status = $_REQUEST['status'];
	$teaching_type = $_REQUEST['teaching_type'];

	
	mysql_query("UPDATE faculty SET lname='$lname', fname='$fname', mi='$mi', address='$address', gender='$gender', contactno='$contactno', position='$position', status='$status', teaching_type='$teaching_type' WHERE fcode='$id' ");
echo "<script>alert('Data Updated.')</script>
<meta http-equiv = 'refresh' content='0; url= instructormain.php' />";
}
?>