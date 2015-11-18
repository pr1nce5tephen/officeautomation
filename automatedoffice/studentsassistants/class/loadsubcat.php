<?php 
	 error_reporting(0);
	 include('../../config/connection.php');
 require('../../auth.php');


 	confirm_logged_in();

$parent_cat = $_GET['parent_cat'];

$query = mysql_query("SELECT * FROM room_sizes WHERE room_id = {$parent_cat} ORDER BY room_id asc");
while($row = mysql_fetch_array($query)) {
	echo "<option value='$row[room_size]'>$row[room_size]</option>";
}
?>
