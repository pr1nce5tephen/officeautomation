<?php
  include('../../config/connection.php');
 include('../../config/sy.php');
   require('../../auth.php');
  confirm_logged_in();
	check_level();

  $sched_id=$_REQUEST['sched_id'];
  $rid=$_REQUEST['rid'];

$sched=mysql_query("SELECT * FROM bscheds WHERE sched_id='$sched_id' ");
$getsched=mysql_fetch_assoc($sched);

  if(isset($_POST['save']))
  {
  	$start=$_POST['start'];
  	$end=$_POST['end'];
  	$type=$_POST['type'];

if($_POST['a'] == $start AND $_POST['b'] == $end){

  	echo"<meta http-equiv='refresh' content='0; url=classmenu.php'><script>alert('class time has been updated')</script>";	
}else{
  	$check=mysql_query("SELECT * FROM bscheds WHERE ('$start' BETWEEN `in` AND `out` OR '$end' BETWEEN `in` AND `out` OR `in`='$start' AND `out`='$end') AND room_id='$rid'");
  	if(mysql_num_rows($check) > 0)
  		{
  			$getcheck=mysql_fetch_array($check);
  				$count=0;
  					if($getcheck['monday'] != "" AND $_POST['m'] != ""){
  						$count++;
  					}else if($getcheck['tuesday'] != "" AND $_POST['t'] != ""){
  						$count++;
  					}else if($getcheck['wednedday'] != "" AND $_POST['w'] != ""){
  						$count++;
  					}else if($getcheck['thursday'] != "" AND $_POST['th'] != ""){
  						$count++;
  					}else if($getcheck['friday'] != "" AND $_POST['f'] != ""){
  						$count++;
  					}

  				if($count != 0){
  					echo"<script>alert('time not available')</script>";
  					}else{
					  	mysql_query("UPDATE bscheds SET `in`='$start', `out`='$end', `monday`='$_POST[m]', `tuesday`='$_POST[t]', `wednesday`='$_POST[w]', `thursday`='$_POST[th]', `friday`='$_POST[f]' WHERE sched_id='$sched_id'");
					  	echo"<meta http-equiv='refresh' content='0; url=classmenu.php'><script>alert('class time has been updated')</script>";
					}


  		}else{
  	mysql_query("UPDATE bscheds SET `in`='$start', `out`='$end', `monday`='$_POST[m]', `tuesday`='$_POST[t]', `wednesday`='$_POST[w]', `thursday`='$_POST[th]', `friday`='$_POST[f]' WHERE sched_id='$sched_id'");
  	echo"<meta http-equiv='refresh' content='0; url=classmenu.php'><script>alert('class time has been updated')</script>";
   		}
	}
  }
?><!DOCTYPE html>
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
	<table class='menu_tab2' rules="all"  border="1">
		<tr><th colspan="2">Edit Class Time</th></tr>
<input type="hidden" name="a" value="<?php echo $_REQUEST['in'] ?>">
<input type="hidden" name="b" value="<?php echo $_REQUEST['out'] ?>">
		<tr><td>Time:</td><td>
		<select name="start">
			<option value="<?php echo $gett['in']?>"><?php echo $_REQUEST['in'] ?><?php echo $_REQUEST['type'] ?></option>
			<?php
				$t=mysql_query("SELECT * FROM a_time WHERE NOT EXISTS(SELECT * FROM bscheds WHERE a_time.in=bscheds.in)");
				if(mysql_num_rows($t) > 0){
				while($gett=mysql_fetch_array($t)){
	
			?>
				<option value="<?php echo $gett['in']?>"><?php echo $gett['in'].' '.$gett['type']?></option>
			<?php } } ?>
		</select> To
		<select name="end">
		<option value="<?php echo $gett['out']?>"><?php echo $_REQUEST['out'] ?><?php echo $_REQUEST['type'] ?></option>	
			<?php

				$t=mysql_query("SELECT * FROM a_time WHERE NOT EXISTS(SELECT * FROM bscheds WHERE a_time.out=bscheds.out)");
				if(mysql_num_rows($t) > 0){
				while($gett=mysql_fetch_array($t)){
	
			?>
				<option value="<?php echo $gett['out']?>"><?php echo $gett['out'].' '.$gett['type']?></option>
			<?php } } ?>
		</select></td>
	</tr>
<tr><th>Days:</th></tr>
	<tr>
		<?php if(empty($getsched['monday']) != true ){ ?>
			<td>Monday</td><td align="center"><input type="checkbox" name="m" value="monday" checked></td>
		<?php }else{?>
			<td>Monday</td><td align="center"><input type="checkbox" name="m" value="monday"></td>
		<?php } ?>
	</tr>
	<tr>
		<?php if(empty($getsched['tuesday']) != true ){ ?>
			<td>Tuesday</td><td align="center"><input type="checkbox" name="t" value="tuesday" checked></td>
		<?php }else{?>
			<td>Tuesday</td><td align="center"><input type="checkbox" name="t" value="tuesday"></td>
		<?php } ?>
	</tr>
	<tr>
		<?php if(empty($getsched['wednesday']) != true ){ ?>
			<td>Wednesday</td><td align="center"><input type="checkbox" name="w" value="wednesday" checked></td>
		<?php }else{?>
			<td>Wednesday</td><td align="center"><input type="checkbox" name="w" value="wednesday" ></td>
		<?php } ?>
	</tr>
	<tr>
		<?php if(empty($getsched['thursday']) != true ){ ?>
			<td>Thursday</td><td align="center"><input type="checkbox" name="th" value="thursday" checked></td>
		<?php }else{?>
			<td>Thursday</td><td align="center"><input type="checkbox" name="th" value="thursday"></td>
		<?php } ?>
	</tr>
	<tr>
		<?php if(empty($getsched['friday']) != true ){ ?>
			<td>Friday</td><td align="center"><input type="checkbox" name="f" value="friday" checked></td>
		<?php }else{?>
			<td>Friday</td><td align="center"><input type="checkbox" name="f" value="friday" ></td>
		<?php } ?>
	</tr>
	<!--<tr>
		<td>Saturday</td><td align="center"><input type="checkbox" name="s" value="saturday"></td>
	</tr>-->
		   <tr align="center"><td> </td><td><input type="submit" name="save" value="Save" />  <input type="reset" name="reset" value="Cancel" /></td></tr>
	</table>
</form>


</header>
	
<div align='center'class='menu_nav3'>
						
							
								<a style="text-decoration:none;" href='classmenu.php'/><input type="button" value="Back"/></a>
						
								
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