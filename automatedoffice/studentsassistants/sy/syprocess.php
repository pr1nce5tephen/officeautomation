<?php
include('../../config/connection.php');
include('../../config/sy.php');
	 require('../../auth.php');
 	confirm_logged_in();
check_level();
 	$id=$_REQUEST['id'];
 	$value=$_REQUEST['value'];

 	mysql_query("UPDATE sy SET sy_stat='$value' WHERE sy_id='$id' ");
 	header('location:symain.php');

?>