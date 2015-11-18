<?php
require_once('auth.php');
require_once('initialize.php');

if(isset($_SESSION['userid']) or isset($_SESSION['control_number']) or isset($_SESSION['instid'])) {
	echo" <meta http-equiv = 'refresh' content = '0; url = admin.php' />";
}

if(isset($_POST['login'])){


	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}

	$username 		= clean($_POST['username']);
	$password	 	= clean($_POST['password']);


if($conn){
		$user_query = "SELECT * FROM users WHERE userName = '$username' AND userPass = '$password' LIMIT 1" or die (mysql_error());
		$result_set = mysql_query($user_query);		
			
			if (mysql_num_rows($result_set) == 1) {
				
				$found_user = mysql_fetch_assoc($result_set);
				$_SESSION['userid'] = $found_user['userID'];
				$_SESSION['stat'] = $found_user['userStat'];
				$username = $found_user['userName'];

				if($found_user['userLevel']=='1'){
					echo "<script language='javascript'>
						alert('Log in as administrator!.');
						</script>";
							echo"<meta http-equiv = 'refresh' content = '0; url = AdminLogin/users/usermain.php' />";
				 }

				 else if($found_user['userLevel']=='2'){
						echo "<script language='javascript'>
						alert('Log in as Instructor!.');
						</script>";
							echo"<meta http-equiv = 'refresh' content = '0; url = facultyLogin/instructor_home.php' />";
				 
				 }else{
				
					if($_SESSION['stat'] == "1" ){
						$d = $found_user['userID'];
						echo "<script language='javascript'>
						alert('Login as Student Assistant!.');
						</script>";
							echo"<meta http-equiv = 'refresh' content = '0; url = AdminLogin/course/coursemain.php' />";
					}else if ($_SESSION['stat'] != "1" ){
						$d = $found_user['userID'];
						echo "<script language='javascript'>
						alert('Account Disable, please contact system administrator.');
						</script>";
						echo"<meta http-equiv = 'refresh' content = '0; url = index.php' />";
					}
				}
			
			}
		
				else {
				echo "<script language='javascript'>
						alert('Username and Password you entered is not registered.');
						</script>";
				
				echo"<meta http-equiv = 'refresh' content = '0; url = index.php' />";
			}
				
				
			}

		 

		
	
	/*if($conn){
		$int_query = "SELECT * FROM faculty WHERE InstID = '$username' AND pin = '$password' LIMIT 1" or die (mysql_error());
		$result_set = mysql_query($int_query);		
			
			if (mysql_num_rows($result_set) == 1) {
				
				$found_user = mysql_fetch_assoc($result_set);
				$_SESSION['instid'] = $found_user['fcode'];
				$_SESSION['intstat'] = $found_user['status'];
				$username = $found_user['fcode'];
				
					if($_SESSION['intstat'] == "active" ){
						$d = $found_user['fcode'];
							echo"<meta http-equiv = 'refresh' content = '0; url = facultyLogin/instructor_home.php' />";
					echo "<script language='javascript'>
						alert('Login as Instructor!');
						</script>";
					}else if ($_SESSION['intstat'] == "inactive" ) {
		
						echo "<script language='javascript'>
						alert('Account Disable, Please contact system administrator!');
						</script>";
						echo"<meta http-equiv = 'refresh' content = '0; url = index.php' />";
					}
			}

	}*/
	
	
	}

?>