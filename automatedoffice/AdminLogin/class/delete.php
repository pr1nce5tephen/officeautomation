<?php
	session_start();
	mysql_connect('localhost','root',''); 
	mysql_select_db('automated');

	$num1 = $_REQUEST["delete"];
	$query=mysql_query("DELETE FROM `class` WHERE `classno` = '$num1'");
	echo "<script>alert('Successfully Delete!');</script>";
	echo"<meta http-equiv = 'refresh' content = '1; url = classmain.php'/>";

?>
