<?php
 include('../../config/connection.php');
	 require('../../auth.php');
	 include('../../config/sy.php');
 	confirm_logged_in();
//require_once('ae/function.php');


if(isset($_REQUEST['delist'])) {
		
		$enlistment_id = $_REQUEST['enlistment_id'];
		$classno = $_REQUEST['classno'];
		$control_number	= $_REQUEST['control_number'];
		$sem		= $_REQUEST['sem'];
		$SY			= $_REQUEST['SY'];
		//$control_number	= $_REQUEST['control_number'];
		
			mysql_query("DELETE FROM enroll WHERE enlistment_id= '$enlistment_id'") or die(mysql_error());				
			$get_class = mysql_query("SELECT * FROM class WHERE classno = '$classno'");
			echo "<meta http-equiv='refresh' content='0; url=enlistment.php?control_number=$control_number&sem=$sem&SY=$SY'><script>alert('Subject Dropped')</script>";
			$class_info = mysql_fetch_assoc($get_class);
			
			$pop = $class_info['Pop'] - 1;
			
			mysql_query("UPDATE class SET Pop = '$pop' WHERE classno = '$classno'");	
			//size_and_population($classno);
	}

	if(isset($_REQUEST['enlist'])) {
		
		$classno	= $_REQUEST['classno'];
		$control_number	= $_REQUEST['control_number'];
		$sem		= $_REQUEST['sem'];
		$SY			= $_REQUEST['SY'];
		$disable 	= 2;
		
		$load = mysql_query("SELECT * FROM enroll WHERE classno = '$classno' AND control_number = '$control_number' ") or die(mysql_error());
		$available = mysql_query("SELECT * FROM class WHERE classno= '$classno' AND status='$disable'") or die(mysql_error());
		
		if($data = mysql_fetch_assoc($load)) {
				echo "<script language='javascript'>
			alert('You are already enrolled in this subject!');
			</script>";
		}

		else if($avail = mysql_fetch_assoc($available)) {
				echo "<script language='javascript'>
			alert('You cannot enrolled in this subject its already full or Disable!');
			</script>";
		} 
		
		else {

			mysql_query("INSERT INTO enroll(classno, control_number, sem, SY) VALUES('$classno', '$control_number', '$sem', '$SY')") or die(mysql_error());	
			echo "<meta http-equiv='refresh' content='0; url=enlistment.php?control_number=$control_number&sem=$sem&SY=$SY'><script>alert('Subject Added')</script>";
			
			$get_class = mysql_query("SELECT * FROM class WHERE classno = '$classno'");
			
			$class_info = mysql_fetch_assoc($get_class);
			
			$pop = $class_info['Pop'] + 1;
			
			mysql_query("UPDATE class SET Pop = '$pop' WHERE classno = '$classno'");

		}
		//size_and_population($classno);
	}
?>