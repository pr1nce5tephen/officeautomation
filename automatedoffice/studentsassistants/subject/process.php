<?php
//require_once('../session.php');
 include('../../config/connection.php');
	 require('../../auth.php');
 	confirm_logged_in();



 //Update Subject
 if(isset($_REQUEST['update'])) {
	$id = $_REQUEST['subject_id'];
	$subject_code = $_REQUEST['subject_code'];
	$subject_desc = $_REQUEST['subject_desc'];
	$subject_units = $_REQUEST['subject_units'];
	$subject_yrlvl = $_REQUEST['sub_cat'];
	$subject_semester = $_REQUEST['subject_semester'];
	$subject_course = $_REQUEST['parent_cat'];
	$subject_specification = $_REQUEST['subject_specification'];
	

	
	mysql_query("UPDATE subject SET subject_code='$subject_code', subject_desc='$subject_desc', subject_units='$subject_units', subject_yrlvl='$subject_yrlvl', subject_semester='$subject_semester', subject_course='$subject_course', subject_specification='$subject_specification' WHERE subject_id='$id' ");
echo "<script>alert('Data Updated.')</script>
<meta http-equiv = 'refresh' content='0; url= subjectmain.php' />";
}
?>