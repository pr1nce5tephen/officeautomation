<?php
error_reporting(0);
 include('../../config/connection.php');
	 require('../../auth.php');
	 include('../../config/sy.php');
 	confirm_logged_in();
check_level();
 	$id=$_REQUEST['room_id'];
 	$a=mysql_query("SELECT * FROM rooms,specification,room_sizes WHERE rooms.room_specification=specification.specification_id AND rooms.room_id=room_sizes.room_id AND rooms.room_id='$id' ");
 	$b=mysql_fetch_array($a);

 	$c=mysql_query("SELECT * FROM room_sizes WHERE room_id='$id'");
 	$d=mysql_fetch_array($c);

 	if(isset($_POST['btnsave']))
 	{
 		if($b['room_code'] == $_POST['room_code'] AND $b['room_description'] == $_POST['room_description'] AND $b['room_specification'] == $_POST['room_specification'] AND $d['room_size'] == $_POST['room_size'])
 		{
 			echo"<meta http-equiv='refresh' content='0; url=roommain.php'><script>alert('Record Saved!')</script>";
 		}else{
 		mysql_query("UPDATE rooms SET room_code='$_POST[room_code]', room_description='$_POST[room_description]', room_specification='$_POST[room_specification]' WHERE room_id='$id'");
 		mysql_query("UPDATE room_sizes SET room_size='$_POST[room_size]' WHERE room_id='$id' ");
 		echo"<meta http-equiv='refresh' content='0; url=roommain.php'><script>alert('Record Updated!')</script>";
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


       <?php include('../../menu/nav2.php');?>

<header>
					<br/>

<center>
<form action="" method="post">
<table class='menu_tab2' rules="all" width="30%"  border="1">
	<th colspan="2"><label id = "label">Add Room</label></th>
	<tr>
		<td>Room Code:</td>
		<td><input type="text" name="room_code" onkeyup="checkInput(this)" value="<?php echo $b['room_code']?>" placeholder="input room code"/></td>
	</tr>
	
	<tr>
		<td>Room Description</td>
		<td><textarea name="room_description" onkeyup="checkInput(this)" placeholder="input room description"><?php echo $b['room_description']?></textarea></td>
	</tr>

	<tr>
		<td>Room Size</td>
		<td><input type="text" name="room_size" onkeyup="checkInput2(this)" value="<?php echo $b['room_size']?>" placeholder="input room size" /></td>

	</tr>

	<tr>
	
		<td>Type:	</td>
			<td><select name="room_specification">
				<option value="<?php echo $b['specification_id']?>"><?php echo $b['specification'] ?></option>
				<?php $q = mysql_query("SELECT * FROM specification order by specification_id");
				while($r = mysql_fetch_array($q)){
				$name = $r['specification']; 
				?>
				<option value="<?php echo $r['specification_id'];?>"><?php echo $name ?></option>
				<?php }?>
				</select></td>
		
			
	</tr>
<tr></tr>
	<tr>
		<td>&nbsp;</td><td><input class='button' type="submit" name="btnsave" value="save"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class='button' type="reset" name="reset" value="reset"/></td>
		
	</tr>
	
	
	
</table>
</form>
</center>

	</header>
	
<div align='center'class='menu_nav3'>
						
							
								<a style="text-decoration:none;" href='roommain.php'/><input class='button' type="button" value="Back"/></a>
						
								
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