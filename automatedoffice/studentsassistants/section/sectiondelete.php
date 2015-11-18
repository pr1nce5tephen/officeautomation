<?php
error_reporting(0);
include('../../config/connection.php');
include('../../config/sy.php');
$section_id=$_REQUEST['section_id'];
mysql_query("delete from section where section_id='" .$section_id."'");
echo"<meta http-equiv = 'refresh' content='0; url=sectionmain.php' />
											<script type='text/javascript'>\n
											alert('Record Deleted');\n
											</script>";
?>