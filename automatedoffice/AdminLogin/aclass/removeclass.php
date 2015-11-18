<?php
include('../../config/connection.php');
include('../../config/sy.php');
require('../../auth.php');

	confirm_logged_in();
	check_level();
	$schedid=$_REQUEST['cid'];

$delcon=mysql_query("SELECT * FROM bscheds WHERE sched_id='$schedid' ");
$getdelcon=mysql_fetch_array($delcon);

if($getdelcon['pop'] != '0'){
echo "<meta http-equiv='refresh' content='0; url=classmenu.php'><script>alert('cannot remove!')</script>";
}else{

	mysql_query("DELETE FROM ascheds WHERE `sched_id`='$schedid' ");
	mysql_query("DELETE FROM bscheds WHERE `sched_id`='$schedid' ");
 	echo "<meta http-equiv='refresh' content='0; url=classmenu.php'><script>alert('Class Removed!')</script>";

}
?>