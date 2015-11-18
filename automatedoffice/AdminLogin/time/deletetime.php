<?php
include('../../config/connection.php');
	 require('../../auth.php');
 	confirm_logged_in();
$id=$_REQUEST['id'];
$query=mysql_query("SELECT * FROM time WHERE time_id='$id' ");
$getquery=mysql_fetch_array($query);
mysql_query("DELETE FROM time WHERE time_id='$id' ");
//mysql_query("DELETE FROM class WHERE `in`='$getquery[time_in]' AND `out`='$getquery[time_out]' ");
mysql_query("DELETE FROM scheds WHERE `time_id`='$getquery[time_id]' ");
mysql_query("DELETE FROM ctime WHERE time_id='$getquery[time_id]'");
echo"<meta http-equiv='refresh' content='0; url=timemain.php'><script>alert('Record Deleted')</script>";
?>