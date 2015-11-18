<?php
error_reporting(0);
include('../../config/connection.php');
include('../../config/sy.php');
$room_id=$_REQUEST['room_id'];
mysql_query("delete from rooms where room_id='" .$room_id."'");
mysql_query("delete from room_sizes where room_id='" .$room_id."'");
echo"<meta http-equiv = 'refresh' content='0; url = roommain.php'>
				<script type='text/javascript'>alert('Record Deleted!')</script>";
?>