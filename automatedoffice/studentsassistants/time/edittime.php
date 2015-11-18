<?php
include('../../config/connection.php');
require('../../auth.php');

confirm_logged_in();
check_level();
if(isset($_REQUEST['id'])){
$id=$_REQUEST['id'];
$time=mysql_query("SELECT * FROM time WHERE `time_id`='$id' ");
$gettime=mysql_fetch_array($time);
}

if(isset($_POST['save'])){
if($_POST['timein'] == $_POST['timein1'] AND $_POST['timeout'] == $_POST['timeout1'])
{
echo"<meta http-equiv='refresh' content='0; url=timemain.php'><script>alert('Saved!')</script>";	
}else{
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
	mysql_query("UPDATE time SET `time_in`='$_POST[timein]', `time_out`='$_POST[timeout]',`type`='$_POST[type]', `monday`='$_POST[m]', `tuesday`='$_POST[t]', `wednesday`='$_POST[w]', `thursday`='$_POST[th]', `friday`='$_POST[f]', `saturday`='$_POST[s]', `sunday`='$_POST[su]' WHERE `time_id`='$gettime[time_id]' ");
	//echo"<meta http-equiv='refresh' content='0; url=timemain.php'><script>alert('Record Updated!')</script>";	
	include('ctime.php');
		echo"<meta http-equiv='refresh' content='0; url=timemain.php'><script>alert('Record Added!')</script>";	

	}
	}
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
			<script language="javascript" src="../../restriction.js" type="text/javascript"></script>
			
		</head>

		<body>
			
			<?//menu?>


			  <?php include('../../menu/nav.php');?>
			 
<header>
					<br/>
		<script>
			function checkInput(ob){
				var invalidChars = /[^":"a-zA-Z0-9]/gi
				if(invalidChars.test(ob.value)){
					ob.value=ob.value.replace(invalidChars,"");
				}
			}
		</script>

<form action="" method="post">
	<center/>

<table class='menu_tab2' rules="all" width="15%"  border="1">
		<tr><th>Set Time</th></tr>
		<tr><td>Time Start:</td><td><input type="text" name="timein" value="<?php echo $gettime['time_in'] ?>" placeholder="HH/Mins. am,nn or pm" onkeyup="checkInput(this)" pattern='^(?=.*\d)(?=.*[:00]).{4,5}$' /> </td></tr>
		<tr><td>Time End:</td><td><input type="text" name="timeout" value="<?php echo $gettime['time_out'] ?>" placeholder="HH/Mins. am,nn or pm" onkeyup="checkInput(this)" pattern='^(?=.*\d)(?=.*[:00]).{4,5}$' /></td></tr>
		<tr><td>Time Start:</td><td><input type="hidden" name="timein1" value="<?php echo $gettime['time_in'] ?>" placeholder="HH/Mins. am,nn or pm" onkeyup="checkInput(this)" pattern='^(?=.*\d)(?=.*[:00]).{4,5}$' /> </td></tr>
		<tr><td>Time End:</td><td><input type="hidden" name="timeout1" value="<?php echo $gettime['time_out'] ?>" placeholder="HH/Mins. am,nn or pm" onkeyup="checkInput(this)" pattern='^(?=.*\d)(?=.*[:00]).{4,5}$' /></td></tr>
		
		<tr><th>Set Type</th></tr>
		<?php 
		if($gettime['type'] == 'am'){
		?>
		<tr><td>am</td><td align="center"><input type="radio" name="type" value="am" checked /></td></tr>
		<tr><td>pm</td><td align="center"><input type="radio" name="type" value="pm" /></td></tr>
		<?php }
		else
			{ ?>
		<tr><td>am</td><td align="center"><input type="radio" name="type" value="am"/></td></tr>
		<tr><td>pm</td><td align="center"><input type="radio" name="type" value="pm" checked /></td></tr>
		<?php } ?>
		<tr><th>Set Days:</th></tr>
		<?php if($gettime['monday'] == null) { ?>
		<tr><td>Monday</td><td align="center"><input type="checkbox" name="m" value="Monday" /></td>
			<? }else{ echo'<tr><td>Monday</td><td align="center"><input type="checkbox" name="m" value="Monday" checked /></td>';} ?>
			<?php if($gettime['tuesday'] == null) { ?>
		<tr><td>Tuesday</td><td align="center"><input type="checkbox" name="t" value="Tuesday" /></td>
			<? }else{ echo'<tr><td>Tuesday</td><td align="center"><input type="checkbox" name="t" value="Tuesday" checked /></td>'; } ?>
			<?php if($gettime['wednesday'] == null){?>
		<tr><td>Wednesday</td><td align="center"><input type="checkbox" name="w" value="Wednesday" /></td>
			<?php }else{echo'<tr><td>Wednesday</td><td align="center"><input type="checkbox" name="w" value="Wednesday" checked /></td>'; } ?>
		<?php if($gettime['thursday'] == null){?>
		<tr><td>Thursday</td><td align="center"><input type="checkbox" name="th" value="Thursday" /></td>
		<?php }else{echo'<tr><td>Thursday</td><td align="center"><input type="checkbox" name="th" value="Thursday" checked /></td>';}?>
		<?php if($gettime['friday'] == null){?>
		<tr><td>Friday</td><td align="center"><input type="checkbox" name="f" value="Friday" /></td>
		<?php }else{echo'<tr><td>Friday</td><td align="center"><input type="checkbox" name="f" value="Friday" checked /></td>';}?>
		<?php if($gettime['saturday'] == null){?>
		<tr><td>Saturday</td><td align="center"><input type="checkbox" name="s" value="Saturday" /></td>	
		<?php }else{echo'<tr><td>Saturday</td><td align="center"><input type="checkbox" name="s" value="Saturday" checked /></td>	';} ?>
		<?php if($gettime['sunday'] == null){?>
		<tr><td>Sunday</td>	<td align="center"><input type="checkbox" name="su" value="Sunday" /></td>
		<?php }else{echo'<tr><td>Sunday</td>	<td align="center"><input type="checkbox" name="su" value="Sunday" checked /></td>';}?>
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