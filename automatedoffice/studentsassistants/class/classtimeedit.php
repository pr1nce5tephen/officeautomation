<?php
  include('../../config/connection.php');
 include('../../config/sy.php');
   require('../../auth.php');
  confirm_logged_in();
	check_level();
  $tid=$_REQUEST['tid'];
  $sched_id=$_REQUEST['sched_id'];
  $rid=$_REQUEST['rid'];

  if(isset($_REQUEST['tid']))
  {	
	$time=mysql_query("SELECT * FROM time WHERE time_id='$tid'");
	$gettime=mysql_fetch_array($time);
  }

  if(isset($_POST['save']))
  {
  	$time=$_POST['time'];
  	$type=$_POST['type'];

  	/*$check=mysql_query("SELECT * FROM schedules WHERE time_id='$time' AND room_id='$rid'");
  	if(mysql_num_rows($check) > 0)
  		{
  			echo"time not available";
  		}else{*/
  	mysql_query("UPDATE schedules SET time_id='$time' WHERE sched_id='$sched_id'");
  	echo"<meta http-equiv='refresh' content='0; url=classmenu.php'><script>alert('class time has been updated')</script>";
   	// 	}

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
	<table class='menu_tab2' rules="all" width="20%"  border="1">
		<tr><th colspan="2">Edit Class Time</th></tr>

		<tr><td>Time:</td><td>
		<select name="time">
			<option value="<?php echo $gettime['time_id']?>"><?php echo $gettime['time_in'].'-'.$gettime['time_out'].''.$gettime['type'].' '.$gettime['monday'].' '.$gettime['tuesday'].' '.$gettime['wednesday'].' '.$gettime['thursday'].' '.$gettime['friday'].' '.$gettime['saturday'].' '.$gettime['sunday']?></option>
			<?php

				$t=mysql_query("SELECT * FROM time WHERE NOT EXISTS(SELECT * FROM schedules WHERE time.time_id=schedules.time_id) AND time_id != '$tid'");
				if(mysql_num_rows($t) > 0){
				while($gett=mysql_fetch_array($t)){


					
			?>
				<option value="<?php echo $gett['time_id']?>"><?php echo $gett['time_in'].'-'.$gett['time_out'].''.$gett['type'].' '.$gett['monday'].' '.$gett['tuesday'].' '.$gett['wednesday'].' '.$gett['thursday'].' '.$gett['friday'].' '.$gett['saturday'].' '.$gett['sunday']?></option>
			<?php } } ?>
		</select></td></tr><!--
		<tr><th>Set Days:</th></tr>
		<?php if($gettime['monday'] == null) { ?>
		<tr><td>Monday</td><td align="center"><input type="checkbox" name="m" value="Monday" disabled /></td>
			<? }else{ echo'<tr><td>Monday</td><td align="center"><input type="checkbox" name="m" value="Monday" checked  disabled/></td>';} ?>
			<?php if($gettime['tuesday'] == null) { ?>
		<tr><td>Tuesday</td><td align="center"><input type="checkbox" name="t" value="Tuesday"  disabled/></td>
			<? }else{ echo'<tr><td>Tuesday</td><td align="center"><input type="checkbox" name="t" value="Tuesday" checked  disabled/></td>'; } ?>
			<?php if($gettime['wednesday'] == null){?>
		<tr><td>Wednesday</td><td align="center"><input type="checkbox" name="w" value="Wednesday" disabled/></td>
			<?php }else{echo'<tr><td>Wednesday</td><td align="center"><input type="checkbox" name="w" value="Wednesday" checked disabled/></td>'; } ?>
		<?php if($gettime['thursday'] == null){?>
		<tr><td>Thursday</td><td align="center"><input type="checkbox" name="th" value="Thursday" disabled/></td>
		<?php }else{echo'<tr><td>Thursday</td><td align="center"><input type="checkbox" name="th" value="Thursday" checked disabled/></td>';}?>
		<?php if($gettime['friday'] == null){?>
		<tr><td>Friday</td><td align="center"><input type="checkbox" name="f" value="Friday" disabled/></td>
		<?php }else{echo'<tr><td>Friday</td><td align="center"><input type="checkbox" name="f" value="Friday" checked disabled/></td>';}?>
		<?php if($gettime['saturday'] == null){?>
		<tr><td>Saturday</td><td align="center"><input type="checkbox" name="s" value="Saturday" disabled/></td>	
		<?php }else{echo'<tr><td>Saturday</td><td align="center"><input type="checkbox" name="s" value="Saturday" checked disabled/></td>	';} ?>
		<?php if($gettime['sunday'] == null){?>
		<tr><td>Sunday</td>	<td align="center"><input type="checkbox" name="su" value="Sunday" disabled/></td>
		<?php }else{echo'<tr><td>Sunday</td>	<td align="center"><input type="checkbox" name="su" value="Sunday" checked disabled/></td>';}?>
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