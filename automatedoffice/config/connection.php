<?php

$connect_error = "Sorry, we're experiencing connection problems.";

$mydb = mysql_connect("localhost","root","") or die($connect_error);
$conn = mysql_select_db("automated", $mydb)or die($connect_error);

?>