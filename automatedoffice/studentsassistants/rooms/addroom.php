<?php
	 error_reporting(0);
	  include('../../config/connection.php');
	 require('../../auth.php');
	 include('../../config/sy.php');
 	confirm_logged_in();
	 check_level();
		 $submit=$_POST['btnsave'];
		 
		 
		 
		 
	if(isset($_POST['btnsave'])){
$room_code=$_POST['room_code'];
$room_description=$_POST['room_description'];
$room_specification=$_POST['room_specification'];
$room_size=$_POST['room_size'];

 $query = mysql_query("SELECT * FROM rooms WHERE room_code='$room_code' AND room_description='$room_description'");
if(mysql_num_rows($query) > 0){
   echo "<meta http-equiv='refresh' content='0; url=addroom.php'><script>alert('Data Exist!')</script>";
}else{
			
				mysql_query("insert into rooms values('','" .$room_code. "','" .$room_description. "','" .$room_specification. "','Available')");
				$room_id=mysql_insert_id();
				mysql_query("INSERT INTO room_sizes(`id`,`room_id`,`room_size`)VALUES('','$room_id','$_POST[room_size]') ");
				echo"<script type='text/javascript'>alert('Record Added')</script>";
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
		<td><input type="text" name="room_code" onkeyup="checkInput(this)" placeholder="input room code"/></td>
	</tr>
	
	<tr>
		<td>Room Description</td>
		<td><textarea name="room_description" onkeyup="checkInput(this)" placeholder="input room description"></textarea></td>
	</tr>

	<tr>
		<td>Room Size</td>
		<td><input type="text" name="room_size" onkeyup="checkInput2(this)" placeholder="input room size" /></td>

	</tr>

	<tr>
	
		<td>Type:	</td>
			<td><select name="room_specification">
				<option>&nbsp;</option>
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
		<td>&nbsp;</td><td><input type="submit" name="btnsave" value="save"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="reset"/></td>
		
	</tr>
	
	
	
</table>
</form>
</center>

	</header>
	
<div align='center'class='menu_nav3'>
						
							
								<a style="text-decoration:none;" href='roommain.php'/><input type="button" value="Back"/></a>
						
								
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