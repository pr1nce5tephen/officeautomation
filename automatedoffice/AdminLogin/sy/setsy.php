<?php
include('../../config/connection.php');
	 require('../../auth.php');
 	confirm_logged_in();
 	check_level();
 	if(isset($_REQUEST['id'])){
$id=$_REQUEST['id'];
$year=mysql_query("SELECT * FROM sy WHERE sy_id='$id' ");
$getyear=mysql_fetch_array($year);
}
if(isset($_POST['set'])){
	if($_POST['yr'] > $_POST['yr2']){
		echo"<script>alert('Invalid input!')</script>";
	}
	else if($_POST['yr'] == $_POST['yr2']){
		echo"<script>alert('Invalid input!')</script>";
	}
	else{
$query=mysql_query("UPDATE sy SET `school_yr`='$_POST[yr]',`school_yr2`='$_POST[yr2]' ");
echo"<meta http-equiv='refresh' content='0; url=symain.php'><script>alert('Record Updated!')</script>";
  } }	
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
			<script language="javascript" src="../../restriction.js" type="text/javascript"></script>
			
		</head>

		<body>
			
			<?//menu?>


			  <?php include('../../menu/nav.php');?>
			 


<script>
	function checkInput(ob){
		var invalidChars = /[^0-9]/gi
		if(invalidChars.test(ob.value)){
			ob.value = ob.value.replace(invalidChars,"");

		}
	}
</script>
<center/>
<br/>
<form action="" method="post">
	<table>
		<tr>
			<td>Date:<input type="text" maxlength="4" name="yr" onkeyup="checkInput(this)" value="<?php echo $getyear['school_yr'] ?>"/> - <input type="text" maxlength="4" name="yr2" onkeyup="checkInput(this)" value="<?php echo $getyear['school_yr2'] ?>"/></td>
		</tr>
		<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="set" value="set date"/></td> </tr>
	</table>
</form>
<a href="symain.php"><button>Back</button></a>

<p><h2>&nbsp;</h2> 
		</p>
		
		<footer>
			<div class="section">
				<p>
				</p>
			</div>

		</footer>	
	
		<p style="text-align: center; padding: 0px;"></p>
</body>

</html>