	<?php
	 error_reporting(0);
	 include('../../config/connection.php');
 require('../../auth.php');
 	confirm_logged_in();
 	check_level();
	 	function random( $length = 8 ) {
								$chars = "0123456789";
								$random = substr( str_shuffle( $chars ), 0, $length );
								return $random;
							}	
	
		 if(isset($_POST['btnsave'])){
$query=mysql_query("SELECT * FROM student WHERE lname='$_POST[lname]' AND fname='$_POST[fname]' AND mi='$_POST[mi]' ");

if($_POST['gender'] === '---Gender---' OR $_POST['parent_cat'] === '---Select Course---' OR $_POST['status'] === '------Status------'){
	echo"<script>alert('Please Fill out all fields!')</script>";
}

		else if (mysql_num_rows($query) > 0) {
		 		echo"<script>alert('Please Fill out all fields!')</script>";
		 	}
		 	else{
		 	$random = random(8);
		 	/*$a=mysql_query("SELECT * FROM course WHERE `course_id` LIKE '$_POST[parent_cat]' ");
		 	$b=mysql_fetch_array($a);
		 	$id=$b['course_id'];*/
		 	mysql_query("INSERT INTO student(`student_id`,`control_number`,`lname`,`fname`,`mi`,`address`,`contact_number`,`gender`,`course`,`yrlvl`,`birthdate`,`status`,`name`,`address2`,`contact`) VALUES('','$random','$_POST[lname]','$_POST[fname]','$_POST[mi].','$_POST[address]','$_POST[contact_number]','$_POST[gender]','$_POST[parent_cat]','$_POST[sub_cat]','$_POST[birthdate]','Active','$_POST[notify]','$_POST[notify2]','$_POST[notify3]') ");
		 echo"<meta http-equiv='refresh' content='0; url=studentmain.php'><script>alert('Added!')</script>";
		 	}
		 }
	
	 
	?>

	<!DOCTYPE html>
		<html lang="en">
		
			<meta charset="utf-8" />
			
			<meta name="keywords" content="" />
			<meta name="description" content="" />
			<script language="javascript" src="../subjects/confirmDel.js" type="text/javascript"></script>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="../../style.css" rel="stylesheet" type="text/css" />
			<script language="javascript" src="../../restriction.js" type="text/javascript"></script>
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
		
		<body>
			
    <!--menu-->


       <?php include('../../menu/nav2.php');?>

				<br/>
				<center>
				
			</center>
			<br/>
				<header>

					
					<center>
			<form action="studentadd.php" method="post">
				
		<table class='menu_tab2' rules="all" width="35%"  border="1">
			<th colspan="2"><label id = "label">Add Student</label></th>


			<tr>
				<td>Lastname:</td>
				<td><input type="text" name="lname" onkeyup="checkInputa(this)"  required placeholder="Lastname" /></td>
			</tr>

			
			<tr>
				<td>Firstname:</td>
				<td><input type="text" name="fname" placeholder="Firstname" onkeyup="checkInputa(this)"    required/></td>
			</tr>
			
			<tr>
				<td>Middle Initial <br/>(must be in capital Letters)</td>
				<td><input type="text" name="mi" maxlength="1" size="1" pattern='^(?=.*[A-Z]).{1,1}$' onkeyup="checkInputa(this)" required/>. Must be in Capital letter</td>
			</tr>
			
			<tr>
				<td>Address</td>
				<td><textarea name="address" rows="3" cols="21" onkeyup="checkInputa(this)" required placeholder="Address" required/></textarea></td>
			</tr>
			
			<tr>
				<td>Cellphone Number</td>
				<td><input type="text" name="contact_number" placeholder="Cellphone Number" onkeyup="checkInput2(this)" pattern='^(?=.*[09]).{11,11}$' required/></td>
			</tr>
			
			<tr>
				<td>Gender</td>
				<td><select name="gender">
					<option>---Gender---</option>
					<option>Male</option>
					<option>Female</option>
					</select></td>
			</tr>
			<tr>
				<td><label for="category">Course</label></td>
   				<td>

   					<select name="parent_cat" id="parent_cat">
				<option>---Select Course---</option>
				<?php $q = mysql_query("SELECT * FROM course WHERE course_stat ='Offered' ORDER BY course_id asc");
				while($r = mysql_fetch_array($q)){
				$name = $r['course_code']; 
				?>
				<option value="<?php echo $r['course_id'];?>"><?php echo $name ?></option>
				<?php }?>
				</select>
    
   </tr>
  <tr>
    <td><label>Year Level</label></td>
    <td><select name="sub_cat" id="sub_cat"></select></td>
 </tr>	
			<tr><td>Birthdate (YYYY-MM-DD)</td><td><input type="date" name="birthdate" placeholder="birthdate" maxlength="80" required/></td></tr>
			
		
				<th colspan="2"><label id = "label">Incase of Emergency, Notify</label></th>
					<tr>
						<td>Name:</td>
						<td><input type="text" name="notify" onkeyup="checkInputa(this)" required/></td>
					</tr>

					<tr>
						<td>Address:</td>
						<td><textarea name="notify2" rows="3" cols="21" onkeyup="checkInput(this)" required placeholder="Address" required/></textarea></td>
					</tr>

					<tr>
						<td>Cellphone Number:</td>
						<td><input type="text" name="notify3" onkeyup="checkInput2(this)" pattern='^(?=.*[09]).{11,11}$' required/></td>
					</tr>

				<tr></tr><tr></tr>
			<tr><td colspan="2" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "submit" name = "btnsave" value = "Add">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="reset"/></td></tr>
			</tr>

		</table>
		</form>	
		</center>
		</header>
		 <div align='center'class='menu_nav3'>				
		 <a style="text-decoration:none;" href='studentmain.php'/><input type="button" value="Back"/></a>
		</div>
	  
	  
			
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