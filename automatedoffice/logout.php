<?php
session_start();
require_once('initialize.php');	

session_destroy();

header('location:index.php');
exit();
?>
