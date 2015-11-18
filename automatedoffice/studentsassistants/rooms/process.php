<?php
 error_reporting(0);
	 include('../../config/connection.php');
	 require('../../auth.php');
	 include('../../config/sy.php');
 	confirm_logged_in();
check_level();
 	$room_id=$_REQUEST['room_id'];
 	$stat=$_REQUEST['stat'];

 	mysql_query("UPDATE rooms SET room_stat='$stat' WHERE room_id='$room_id' ");
 	mysql_query("DELETE FROM scheds WHERE room='$room_id' ");
 				//echo"<meta http-equiv='refresh' content='0; url=roommain.php'>";
 	header("location:roommain.php");
?>