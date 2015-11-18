<?php
	require_once('../../auth.php');
	require_once('../../initialize.php');
	include('../../config/sy.php');
	confirm_logged_in();
	check_level();
?>

 <?php include('../../menu/nav2.php');?>
<br/>
<form action="" method="post">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="category" required>
		<option value = "" selected>Search by</option>
		<option value="control_number">Control Number</option>
		<option value="lname">Lastname</option>
	</select>
	<input type="text" name="input" required/>
	<input type="submit" name="find" value="search" />
</form>

<center/>
<table class="menu_tab2" rules="all" width="85%">
 <tr>
	<th>Control Number</th>
	<th>Name</th>
	<th>Course</th>
	<th>Year Level</th>
	<th>Option</th>

 </tr>

 <?php
 if(isset($_POST['find'])){
 	$category=$_POST['category'];
 	$input=$_POST['input'];

 	if(empty($category) === true && $input === "all" || empty($category) === true && $input === "All" || empty($category) === true && $input === "ALL" ){
 	$query=mysql_query("SELECT * FROM student,course WHERE student.course=course.course_id");
 	if(mysql_num_rows($query) > 0){
 	while($getquery=mysql_fetch_array($query)){
 	  ?>
 	  <tr align="center">
 	  	<td><?php echo $getquery['control_number'] ?></td>
 	  	<td><?php echo $getquery['lname'].', '.$getquery['fname'].' '.$getquery['mi'].'.' ?></td>
 	  	<td><?php echo $getquery['course_desc'] ?></td>
 	  	<td><?php echo $getquery['yrlvl']  ?></td>
 	  	<td><a style="text-decoration:none;" href="grades.php?id=<?php echo $getquery['control_number'] ?>">View Grades</td>
 	  </tr>

<?php 
	} 
}else{
	echo"<script>alert('No Record Found')</script>";
	}
}
else if(empty($category) === true && empty($input) === true){
	echo"<meta http-equiv='refresh' content='0; url=gradeinquiry.php'><script>alert('Invalid! search inputs are empty!')</script>";

?>

<?php 
}else if(!empty($category) === true && !empty($input) === true){
	$query=mysql_query("SELECT * FROM student,course WHERE  student.course=course.course_id AND (`".$category."` LIKE '%".$input."%')");
	if(mysql_num_rows($query) > 0){
		while($getquery=mysql_fetch_array($query)){

 ?>
 <tr align="center">
 	  	<td><?php echo $getquery['control_number'] ?></td>
 	  	<td><?php echo $getquery['lname'].', '.$getquery['fname'].' '.$getquery['mi'].'.' ?></td>
 	  	<td><?php echo $getquery['course_desc'] ?></td>
 	  	<td><?php echo $getquery['yrlvl']  ?></td>
 	  	<td><a style="text-decoration:none;" href="grades.php?id=<?php echo $getquery['control_number'] ?>">View Grades</td>
 	  </tr>
<?php  } 
}
else
	{
		echo"<meta http-equiv='refresh' content='0; url=gradeinquiry.php'><script>alert('No Record Found')</script>";
	} 
} 
?>

<?php  
}
else
{
	$query=mysql_query("SELECT * FROM student,course WHERE student.course=course.course_id");
	while($getquery=mysql_fetch_array($query)){
 ?>
<tr align="center">
 	  	<td><?php echo $getquery['control_number'] ?></td>
 	  	<td><?php echo $getquery['lname'].', '.$getquery['fname'].' '.$getquery['mi'].'.' ?></td>
 	  	<td><?php echo $getquery['course_desc'] ?></td>
 	  	<td><?php echo $getquery['yrlvl']  ?></td>
 	  	<td><a style="text-decoration:none;" href="grades.php?id=<?php echo $getquery['control_number'] ?>&&course=<?php echo $getquery['course']?>">View Grades</td>
 	  </tr>
<?php 
	} 
}  
?>
</table>
<footer>
			<div class="section">
				<p>
				</p>
			</div>	
		</footer>	
	</div>
		<p style="text-align: center; padding: 0px;"></p>
</body>
</html>