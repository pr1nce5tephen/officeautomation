<?php
include('../../config/connection.php');
	 require('../../auth.php');
	confirm_logged_in();
check_level();
if(isset($_POST['save'])){
$query=mysql_query("SELECT * FROM time WHERE (('$_POST[timein]' BETWEEN `time_in` AND `time_out` OR '$_POST[timeout]' BETWEEN `time_in` AND `time_out` OR `time_in`='$_POST[timein]' AND `time_out`='$_POST[timeout]' ) AND `type`='$_POST[type]')");
if($query){
	$result = mysql_fetch_assoc($query);
	$count=0;
	if($result['monday'] != "" AND $_POST['m'] != ""){
		$count++;
	}else if($result['tuesday'] != "" AND $_POST['t'] != ""){
		$count++;
	}else if($result['wednesday'] != "" AND $_POST['w'] != ""){
		$count++;
	}else if($result['thursday'] != "" AND $_POST['th'] != ""){
		$count++;
	}else if($result['friday'] != "" AND $_POST['f'] != ""){
		$count++;
	}else if($result['saturday'] != "" AND $_POST['s'] != ""){
		$count++;
	}else if($result['sunday'] != "" AND $_POST['su'] != ""){
		$count++;
	}			
	//echo mysql_result($query, 0, 'time_id');
	if($count != 0){
		echo"<script>alert('Time Conflict!')</script>";
	}else{
		mysql_query("INSERT INTO time(`time_id`,`time_in`,`time_out`,`type`,`monday`,`tuesday`,`wednesday`,`thursday`,`friday`,`saturday`,`sunday`) VALUES('','$_POST[timein]','$_POST[timeout]','$_POST[type]','$_POST[m]','$_POST[t]','$_POST[w]','$_POST[th]','$_POST[f]','$_POST[s]','$_POST[su]')");
	//echo"<meta http-equiv='refresh' content='0; url=timemain.php'><script>alert('Record Added!')</script>";	
	include('ctime.php');
		echo"<meta http-equiv='refresh' content='0; url=timemain.php'><script>alert('Record Added!')</script>";	

	}
}

/*$getquery=mysql_fetch_array($query);
$m=mysql_query("SELECT * FROM time WHERE `monday` = '$_POST[m]' AND `time_id`='$getquery[time_id]'");  
$t=mysql_query("SELECT * FROM time WHERE `tuesday` = '$_POST[t]' AND `time_id`='$getquery[time_id]'");
$w=mysql_query("SELECT * FROM time WHERE `wednesday` = '$_POST[w]' AND `time_id`='$getquery[time_id]'");    
$th=mysql_query("SELECT * FROM time WHERE `thursday` = '$_POST[th]' AND `time_id`='$getquery[time_id]'");  
$f=mysql_query("SELECT * FROM time WHERE `friday` = '$_POST[f]' AND `time_id`='$getquery[time_id]'");
$s=mysql_query("SELECT * FROM time WHERE `saturday` = '$_POST[s]' AND `time_id`='$getquery[time_id]'");
$su=mysql_query("SELECT * FROM time WHERE `sunday` = '$_POST[su]' AND `time_id`='$getquery[time_id]'");	

	//$m=mysql_query("SELECT * FROM time");
if(mysql_num_rows($query) > 0)
	{
			if(mysql_num_rows($m) > 0)
			{
				echo"<script>alert('Time Conflict!')</script>";
			}
			else if(mysql_num_rows($t) > 0)
			{
				echo"<script>alert('Time Conflict!')</script>";
			}
			else if(mysql_num_rows($w) > 0)
			{
				echo"<script>alert('Time Conflict!')</script>";
			}
			else if(mysql_num_rows($th) > 0)
			{
				echo"<script>alert('Time Conflict!')</script>";
			}
			else if(mysql_num_rows($f) > 0)
			{
				echo"<script>alert('Time Conflict!')</script>";
			}
			else if(mysql_num_rows($s) > 0)
			{
				echo"<script>alert('Time Conflict!')</script>";
			}
			else if(mysql_num_rows($su) > 0)
			{
				echo"<script>alert('Time Conflict!')</script>";
			}
			else
			{
				mysql_query("INSERT INTO time(`time_id`,`time_in`,`time_out`,`type`,`monday`,`tuesday`,`wednesday`,`thursday`,`friday`,`saturday`,`sunday`) VALUES('','$_POST[timein]','$_POST[timeout]','$_POST[type]','$_POST[m]','$_POST[t]','$_POST[w]','$_POST[th]','$_POST[f]','$_POST[s]','$_POST[su]')");
				echo"<meta http-equiv='refresh' content='0; url=timemain.php'><script>alert('Record Added!')</script>";	
				include('ctime.php');
			}	
	}
	else
	{ 
	mysql_query("INSERT INTO time(`time_id`,`time_in`,`time_out`,`type`,`monday`,`tuesday`,`wednesday`,`thursday`,`friday`,`saturday`,`sunday`) VALUES('','$_POST[timein]','$_POST[timeout]','$_POST[type]','$_POST[m]','$_POST[t]','$_POST[w]','$_POST[th]','$_POST[f]','$_POST[s]','$_POST[su]')");
	echo"<meta http-equiv='refresh' content='0; url=timemain.php'><script>alert('Record Added!')</script>";	
	include('ctime.php');
	}*/
	
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
			<script language="javascript" src="../../restriction.js" type="text/javascript"></script>
			
		</head>

		<body>
			
			<?//menu?>


			  <?php include('../../menu/nav.php');?>
			 
<header>
					<br/>
		<script>
			function checkInput(ob){
				var invalidChars = /[^":"0-9]/gi
				if(invalidChars.test(ob.value)){
					ob.value=ob.value.replace(invalidChars,"");
				}
			}
		</script>

<form action="" method="post">
	<center/>
	<table class='menu_tab2' rules="all" width="15%"  border="1">
		<tr><th>Set Time</th></tr>
		<tr><td>Time Start:</td><td><input type="text" name="timein" onkeyup="checkInput(this)" pattern='^(?=.*\d)(?=.*[:00]).{4,5}$' required /> </td></tr>
		<tr><td>Time End:</td><td><input type="text" name="timeout" onkeyup="checkInput(this)" pattern='^(?=.*\d)(?=.*[:00]).{4,5}$' required/></td></tr>
		<tr><th>Set Type</th></tr>
		<tr><td>am</td><td align="center"><input type="radio" name="type" value="am" /></td></tr>
		<tr><td>pm</td><td align="center"><input type="radio" name="type" value="pm" /></td></tr>
		<tr><th>Set Days:</th></tr>
		<tr><td>Monday</td><td align="center"><input type="checkbox" name="m" value="Monday" /></td>
		<tr><td>Tuesday</td><td align="center"><input type="checkbox" name="t" value="Tuesday" /></td>
		<tr><td>Wednesday</td><td align="center"><input type="checkbox" name="w" value="Wednesday" /></td>
		<tr><td>Thursday</td><td align="center"><input type="checkbox" name="th" value="Thursday" /></td>
		<tr><td>Friday</td><td align="center"><input type="checkbox" name="f" value="Friday" /></td>
		<tr><td>Saturday</td><td align="center"><input type="checkbox" name="s" value="Saturday" /></td>	
		<tr><td>Sunday</td>	<td align="center"><input type="checkbox" name="su" value="Sunday" /></td>

		</tr>

		   <tr align="center"><td> </td>	<td><input type="submit" name="save" value="Save" />  <input type="reset" name="reset" value="Cancel" /></td></tr>
	</table>
</form>


</header>
	
<div align='center'class='menu_nav3'>
						
							
								<a style="text-decoration:none;" href='timemain.php'/><input type="button" value="Back"/></a>
						
								
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