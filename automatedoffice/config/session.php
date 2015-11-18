<?php
	session_start();
	
	function confirm_logged_in() {
		if(!isset($_SESSION['SESS_MEMBER_ID'])) {
			header('location:index.php');
		}
	}
	
	function confirm_login() {
		if(isset($_SESSION['SESS_MEMBER_ID'])) {
		$userid = $_SESSION['SESS_MEMBER_ID'];
		$ulvl = $_SESSION['SESS_userlvl'];
			if ($ulvl === 'admin') {
				header('location:adminhomepage.php');
			} else if ($ulvl === 'alumni') {
				header('location:graduate.php');
			}
		}
	}
	
	function confirm_userlevel() {
		if(isset($_SESSION['SESS_userlvl'])) {
		$level = $_SESSION['SESS_userlvl'];
			if($level != 'admin'){
				header('location:index.php');
			}elseif($level != 'alumni'){
				header('location:index.php');
			}
		}
	}
?>