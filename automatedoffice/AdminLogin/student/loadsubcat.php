<?php 
	 error_reporting(0);
	 include('../../config/connection.php');
 require('../../auth.php');


 	confirm_logged_in();

$parent_cat = $_GET['parent_cat'];

$query = mysql_query("SELECT * FROM course_yrlvl WHERE course_id = {$parent_cat} ORDER BY yrlvl asc");
while($row = mysql_fetch_array($query)) {
	echo "<option value='$row[yrlvl]'>$row[yrlvl]</option>";
}
?>
