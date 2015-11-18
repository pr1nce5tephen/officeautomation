<?php
session_start();
	function confirm_logged_in() {
		if (!isset($_SESSION['user_id'])) {
			header('location:index.php');
		}
	}
	function current_login(){
		if(isset($_SESSION['user_id'])){
			header('location:logout.php');
		}
	}
?>