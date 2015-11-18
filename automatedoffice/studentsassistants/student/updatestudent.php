<?php
error_reporting(0);
include('../../config/connection.php');
 require('../../auth.php');
 	confirm_logged_in();
 	check_level();
if(isset($_REQUEST['student_id'])){
	$student_id=$_REQUEST['student_id'];
 	$query=mysql_query("SELECT * FROM student JOIN course WHERE student.course=course.course_id AND student_id = '$student_id' ");
 	$getquery=mysql_fetch_array($query);
}

if(isset($_POST['btnsave'])){

	mysql_query("UPDATE student SET `control_number`='$_POST[control_number]', `lname`='$_POST[lname]', `fname`='$_POST[fname]', `mi`='$_POST[mi]', `address`='$_POST[address]', `contact_number`='$_POST[contact_number]', `gender`='$_POST[gender]', `course`='$_POST[parent_cat]', `yrlvl`='$_POST[sub_cat]', `birthdate`='$_POST[birthdate]', `status`='$_POST[status]', `name`='$_POST[notify]', `address2`='$_POST[notify2]', `contact`='$_POST[notify3]' WHERE `student_id` = '$student_id' ");
echo"<meta http-equiv='refresh' content='0; url=studentmain.php'><script>alert('student data Updated!')</script>";
}

?>

	<!DOCTYPE html>
		<html lang="en">
		<head> 
			<meta charset="utf-8" />
			<title> Western Leyte College </title>
			<meta name="keywords" content="" />
			<meta name="description" content="" />
			<script language="javascript" src="../subjects/confirmDel.js" type="text/javascript"></script>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="../../style.css" rel="stylesheet" type="text/css" />
			<script src="../../restriction.js"></script>
			<script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    
	$("#parent_cat").change(function() {
		//$(this).after('<div id="loader"><img src="img/loading.gif" alt="loading subcategory" /></div>');
		$.get('loadsubcat.php?parent_cat=' + $(this).val(), function(data) {
			$("#sub_cat").html(data);
			$('#loader').slideUp(200, function() {
				$(this).remove();
			});
		});	
    });

});
</script>
		</head>
		
		<body>
			
      <!--menu-->


      <?php include('../../menu/nav2.php');?>

				
				<header>
					<br/>

<center>
	<form action="" method="post">
<table class='menu_tab2' rules="all" width="40%"  border="1">

	<input type="hidden" name="student_id" value="<?php echo $getquery['student_id']; ?>"/>
	<th colspan="2"><label id = "label">Student Profile</label></th>
	
	<tr>
		<td>Control Number:</td>
		<td><input type="hidden" name="control_number" size="30px" onkeyup="checkInput2(this)"  value="<?php echo $getquery['control_number']; ?>" />
			<label><?php echo $getquery['control_number']; ?></label></td>
	</tr>

	<tr>
		<td>Lastname:</td>
		<td><input type="text" name="lname" size="30px" onkeyup="checkInputa(this)"  value="<?php echo $getquery['lname']; ?>" /></td>
	</tr>
	
	<tr>
		<td>Firstname:</td>
		<td><input type="text" name="fname" size="30px" onkeyup="checkInputa(this)"  value="<?php echo $getquery['fname']; ?>" /></td>
		
	</tr>
	
	<tr>
		<td>Middle Initial</td>
		<td><input type="text" name="mi" maxlength="1" pattern='^(?=.*[A-Z]).{1,1}$' placeholder='Must be in Capital letter' onkeyup="checkInputa(this)" value="<?php echo $getquery['mi']; ?>" required/></td>
	</tr>
	
	<tr>
		<td>Address</td>
		<td><textarea name="address" rows="3" cols="21" onkeyup="checkInput(this)"  ><?php echo $getquery['address']; ?></textarea></td>
	</tr>
	
	<tr>
		<td>Cellphone Number</td>
		<td><input type="text" name="contact_number" size="30px" onkeyup="checkInput2(this)" pattern='^(?=.*[09]).{11,11}$' value="<?php echo $getquery['contact_number']; ?>" /></td>
	</tr>
	
	<tr>
	
		<td>Gender</td>
				<td><select name="gender" value="<?php echo $getquery['gender']; ?>">
					<option>Male</option>
					<option>Female</option>
					</select></td>
	</tr>
	
	

	<tr>
				<td><label for="category">Course</label></td>
   				<td>

   					<select name="parent_cat" id="parent_cat">
				<option value="<?php echo $getquery['course_id']; ?>"><?php echo $getquery['course_code']; ?></option>
				<?php $q = mysql_query("SELECT * FROM course ORDER BY course_id asc");
				while($r = mysql_fetch_array($q)){
				$name = $r['course_code']; 
				?>
				<option value="<?php echo $r['course_id'];?>"><?php echo $name ?></option>
				<?php }?>
				</select>
    
   </tr>
  <tr>
    <td><label>Year Level</label></td>
    <td><select name="sub_cat" id="sub_cat"><option><?php echo $getquery['yrlvl']; ?></option></select></td>
 </tr>	
		

	<tr><td>Birthdate (MM-DD-YYYY)</td><td><input type="date" name="birthdate" placeholder="birthdate" value="<?php echo $getquery['birthdate']; ?>" maxlength="80" required/></td></tr>

	<tr>
		<td>Status</td>
		<td>
			<select name="status" value="<?php echo $getquery['status']; ?>">
				<option name="newStudent">New Student</option>
				<option name="oldStudent">Old Student</option>
				<option name="transferee">Transferee</option>
				<option name="notActive">Not Active</option>
			</select>
		</td>
	</tr>

	<th colspan="2"><label id = "label">Incase of Emergency, Notify</label></th>
					<tr>
						<td>Name:</td>
						<td><input type="text" name="notify" value="<?php echo $getquery['name']; ?>"onkeyup="checkInputa(this)" required/></td>
					</tr>

					<tr>
						<td>Address:</td>
						<td><textarea name="notify2" rows="3" cols="21" onkeyup="checkInput(this)" required placeholder="Address" required/><?php echo $getquery['address2']; ?></textarea></td>
					</tr>


					<tr>
						<td>Contact Number:</td>
						<td><input type="text" name="notify3" value="<?php echo $getquery['contact']; ?>" onkeyup="checkInput2(this)" pattern='^(?=.*[09]).{11,11}$' required/></td>
					</tr>
	

	
	<tr>
		<tr></tr><tr></tr>
		<tr><td colspan="2" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "submit" name = "btnsave" value = "update">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="reset"/></td></tr>
	</tr>
	
	
	
</table>
</form>
</center>



		</header>
		
		<div class="banner"></div>
			<center>
			</center>
	  
	
	  <div align='center'class='menu_nav3'>
						
								<a style="text-decoration:none;" href='studentmain.php'/><input type="button" value="Back"/></a>
								
			</div>
	  
	  
		<aside class="sidebar">
			
		</aside>
		<center>
		
		</center>	
		<p><h2>&nbsp;</h2> 
		</p>
		
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