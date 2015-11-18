<?php
error_reporting(0);
 include('../../config/connection.php');
	 require('../../auth.php');
 	confirm_logged_in();
check_level();
$fcode=$_REQUEST['fcode'];

	
if(isset($_REQUEST["fcode"])) {
	$id = $_REQUEST["fcode"];
	$query = mysql_query("SELECT * FROM faculty,specification WHERE faculty.teaching_type=specification.specification_id AND fcode = '$id' LIMIT 1") or die(mysql_error());
	$data = mysql_fetch_assoc($query);
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
			
		</head>
		
		
		<body>
			
      <?//menu?>


       <?php include('../../menu/nav2.php');?>

<header>
					<br/>

<center>
<form action="instructorAccounts.php" method="post">
	<input type="hidden" name="fcode" value="<?php echo $data ['fcode'] ?>">
<table class='menu_tab2' rules="all" width="30%"  border="1">
	<th colspan="2"><label id = "label">Update Faculty</label></th>
	

	<tr>
		<td>Lastname:</td>
		<td><input type="text" name="lname" value="<?php echo $data ['lname'] ?>" size="30px" onkeyup="checkInputa(this)" required/></td>
	</tr>
	
	<tr>
		<td>Firstname:</td>
		<td><input type="text" name="fname" value="<?php echo $data ['fname'] ?>"  size="30px" onkeyup="checkInputa(this)" required/></td>
		
	</tr>
	
	<tr>
		<td>Middle Initial</td>
		<td><input type="text" name="mi" value="<?php echo $data ['fname'] ?>"  size="30px" maxlength="1" pattern='^(?=.*[A-Z]).{3,}$' placeholder='Must be in Capital letter' onkeyup="checkInputa(this)" required/></td>
	</tr>
	
	<tr>
		<td>Address</td>
		<td><textarea name="address" onkeyup="checkInput(this)" required><?php echo $data ['address'] ?></textarea></td>
	</tr>
	
	<tr>
		<tr>
		<td>Gender</td>
		<td>
			<select name="gender">
				<option><?php echo $data ['gender'] ?></option>
				<option name="male">Male</option>
				<option name="female">Female</option>
			</select>
		</td>
	</tr>
	</tr>
	
	<tr>
		<td>Cellphone Number:</td>
				<td><input name="contactno" onkeyup2="checkInput(this)"   value="<?php echo $data ['contactno'] ?>" pattern='^(?=.*\d)(?=.*[09]).{11,11}$'></td>
	</tr>
	

	<tr>
		<td>Position</td>
		<td><input type="text" name="position" value="<?php echo $data ['position'] ?>"  size="30px" onkeyup="checkInputa(this)"  /></td>

	</tr>

	<tr>
		<td>Status</td>
		<td><input name="status"  value="<?php echo $data ['status'] ?>" readonly/></td>

	</tr>

	<tr>
	
		<td>Type:	</td>
			<td><select name="teaching_type">
				<option value='<?php echo $data ['specification_id']?>'><?php echo $data ['specification']?></option>
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
		<tr><td colspan="2" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class='button' type = "submit" name = "update" value = "update">&nbsp;&nbsp;&nbsp;&nbsp;<input class='button' type="reset" name="reset" value="reset"/></td></tr>
	</tr>
	
	
	
</table>
</form>
</center>

	</header>

		
		
			
	  
	
	  <div align='center'class='menu_nav3'>
						
							
								<a style="text-decoration:none;" href='instructormain.php'/><input class='button' type="button" value="Back"/></a>
						
								
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