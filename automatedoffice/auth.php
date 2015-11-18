<?php
session_start();

	function confirm_logged_in()
	{
		if (empty($_SESSION['userid']))
			if (empty($_SESSION['studid']))
				if (empty($_SESSION['instid']))
		{
			echo"<meta http-equiv = 'refresh' content = '0; url = ../index.php' />";
		}
	}

function check_level(){
		$a=mysql_query("SELECT * FROM users WHERE userID='$_SESSION[userid]'");
		$b=mysql_fetch_array($a);

		if($b['userLevel'] != '1'){
			echo" <meta http-equiv = 'refresh' content = '0; url = ../../index.php' /><script>alert('The Page your accessing is strictly for Admin!')</script>";
		}
	}
?>
