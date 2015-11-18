<?php
 error_reporting(0);
	  include('../../config/connection.php');
	 require('../../auth.php');
	 include('../../config/sy.php');
 	confirm_logged_in();
 	check_level();
$instsubj_id=$_REQUEST['instsubj_id'];
$instructor_id=$_REQUEST['fcode'];
/*$in=$_REQUEST['in'];
$out=$_REQUEST['out'];
$days=$_REQUEST['days'];*/
mysql_query("DELETE FROM instructor_subject WHERE instsubj_id='" .$instsubj_id."'");
echo"<meta http-equiv = 'refresh' content='0; url=instructorsubjectadd.php?fcode=$instructor_id' />
											<script type='text/javascript'>\n
											alert('Record Removed');\n
											</script>";
?>