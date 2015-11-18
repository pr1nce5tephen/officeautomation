<?php
error_reporting(0);
include('../config/connection.php');
$subject_id=$_REQUEST['subject_id'];
mysql_query("delete from subject where subject_id='" .$subject_id."'");
mysql_query("delete from subject_time where subject_id='" .$subject_id."'");
echo"<meta http-equiv = 'refresh' content='0; url=subjectmain.php' />
											<script type='text/javascript'>\n
											alert('Record Deleted');\n
											</script>";
?>