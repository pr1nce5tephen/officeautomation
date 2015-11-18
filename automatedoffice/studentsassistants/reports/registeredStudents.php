<?php
	require_once('../../auth.php');
	require_once('../../initialize.php');
	include('../../config/sy.php');
	confirm_logged_in();
	
require_once('../../config/connection.php');

$query 	= mysql_query("SELECT * FROM student");
//$data 	= mysql_fetch_array($query);
$result = mysql_num_rows($query);
//echo $result;
//$StudentID=$query['StudID'];

$x=0;
while($data=mysql_fetch_array($query)){
	//echo"<br>". $data['StudID'];
	$sid[$x]=$data['student_id'];		
	$studCID[$x]=$data['course'];		
	$x++;
}
//echo "<br>". $sid[4];

echo "<center>
	<h2>List of Registered Students</h2>
	<table border='1;solid' rules='all' cellpadding='5px'>
	<tr height='50'>
		<th>No.</th>
		<th>Control No.</th>
		<th>Name</th>
		<th>Address</th>
		<th>Contact No.</th>
		<th>Course</th>
	</tr>";				
for($y=0;$y<$result;$y++){
	

	$crseID = mysql_query("SELECT * FROM course WHERE course_id='$studCID[$y]' ")or die (mysql_error());	
	$resCrseID=mysql_fetch_array($crseID);

	$studname = mysql_query("SELECT * FROM student WHERE student_id='$sid[$y]' ")or die (mysql_error());	
	$studRes=mysql_fetch_array($studname);	
	$fullname=$studRes['lname'].", ".$studRes['fname']." ".$studRes['mi'];
	$num=$y+1;		
	
	echo "<tr align='center'>";
		echo "<td>".$num.". </td>";			
		echo "<td>".$studRes['control_number']."</td>";
		echo "<td>".$fullname."</td>";
		echo "<td>".$studRes['address']."</td>";
		echo "<td>".$studRes['contact_number']."</td>";
		echo "<td>".$resCrseID['course_code']."</td>";
	echo "</tr>";	
}
echo"</table><center>";
?>