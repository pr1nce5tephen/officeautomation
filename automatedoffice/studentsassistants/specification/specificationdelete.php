<?php
error_reporting(0);
include('../../config/connection.php');
$specification_id=$_REQUEST['specification_id'];
mysql_query("delete from specification where specification_id='" .$specification_id."'");
mysql_query("delete from rooms where room_specification='" .$specification_id."'");
echo"<meta http-equiv = 'refresh' content='0; url=specificationmain.php' />
											<script type='text/javascript'>\n
											alert('Record Deleted');\n
											</script>";
?>