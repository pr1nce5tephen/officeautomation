<?php
	 error_reporting(0);
	  include('../../config/connection.php');
	 require('../../auth.php');
	 include('../../config/sy.php');
 	confirm_logged_in();
 	check_level();
 	function random_user( $length = 8 ) {
								$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
								$user = substr( str_shuffle( $chars ), 0, $length );
								return $user;
							}
	function random_password( $length = 4 ) {
								$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
								$password = substr( str_shuffle( $chars ), 0, $length );
								return $password;
							}
	 
		 $submit=$_POST['btnsave'];
		$InstID= random_user(8);
		$pin= random_password(8);
		$lname=$_POST['lname'];
		$fname=$_POST['fname'];
		$mi=$_POST['mi'];
		$address=$_POST['address'];
		$gender=$_POST['gender'];	
		$contactno=$_POST['contactno'];
		$rate=$_POST['rate'];
		$position=$_POST['position'];
		$status=$_POST['status'];
		$teaching_type=$_POST['teaching_type'];
	if ($submit)
	{
		if($InstID && $pin && $lname && $fname && $mi && $address && $gender && $contactno && $rate && $position && $status && $teaching_type)
			{
				mysql_query("insert into faculty values('','" .$InstID. "','" .$pin. "','" .$lname. "','" .$fname. "','" .$mi. "','" .$address. "','" .$gender. "','" .$contactno. "','" .$rate. "','" .$position. "','" .$status. "','" .$teaching_type. "')");
				echo"<meta http-equiv = 'refresh' content='0; url=instructormain.php' />
											<script type='text/javascript'>\n
											alert('Record Added');\n
											</script>";
			}
		else
			{
				echo"error";
			}
			
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
			<script language="javascript" src="../restriction.js" type="text/javascript"></script>
			
		</head>
		
		
		<body>
			
      <?//menu?>


       <?php include('../../menu/nav2.php');?>

<header>
					<br/>

<center>
<form action="" method="post">
<table class='menu_tab2' rules="all" width="30%"  border="1">
	<th colspan="2"><label id = "label">Add Instructor</label></th>

	
	<tr>
		<td>Lastname:</td>
		<td><input type="text" name="lname" size="30px" onkeyup="checkInputa(this)" /></td>
	</tr>
	
	<tr>
		<td>Firstname:</td>
		<td><input type="text" name="fname" size="30px" onkeyup="checkInputa(this)"  /></td>
		
	</tr>
	
	<tr>
		<td>Middle Initial</td>
		<td><input type="text" name="mi" size="30px" onkeyup="checkInputdot(this)" /></td>
	</tr>
	
	<tr>
		<td>Address</td>
		<td><textarea name="address" onkeyup="checkInput(this)" ></textarea></td>
	</tr>
	
	<tr>
		<tr>
		<td>Gender</td>
		<td>
			<select name="gender">
				<option>&nbsp;</option>
				<option name="male">Male</option>
				<option name="female">Female</option>
			</select>
		</td>
	</tr>
	</tr>
	
	<tr>
		<td>Contact Number:</td>
				<td><input type="text" name="contactno" onkeyup="checkInput2(this)"></td>
	</tr>
	
	<tr>
		<td>Rate</td>
		<td><input type="text" name="rate" onkeyup="checkInputdot(this)"></td>
	</tr>

	<tr>
		<td>Position</td>
		<td><input type="text" name="position" size="30px" onkeyup="checkInputa(this)" /></td>

	</tr>

<tr>
		<td>Status</td>
		<td><input type="text" name="status" value="active" />
				</td>

	</tr>

	<tr>
	
		<td>Type:	</td>
			<td><select name="teaching_type">
				<option>&nbsp;</option>
												<?php $q = mysql_query("SELECT * FROM specification order by specification_id");
												while($r = mysql_fetch_array($q)){
												$name = $r['specification']; 
												?>
												<option value="<?php echo $r['specification_id'];?>"><?php echo $name ?></option>
												<?php }?>
												</select>
		
			
	</tr>

	

	
	<tr>
		<tr></tr><tr></tr>
		<tr><td colspan="2" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "submit" name = "btnsave" value = "add">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="reset"/></td></tr>
	</tr>
	
	
	
</table>
</form>
</center>

	</header>

		
		
			
	  
	
	  <div align='center'class='menu_nav3'>
						
							
								<a style="text-decoration:none;" href='instructormain.php'/><input type="button" value="Back"/></a>
						
								
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