	<?php
 error_reporting(0);
	 include('../../config/connection.php');
	 require('../../auth.php');
	 include('../../config/sy.php');
 	confirm_logged_in();
 	check_level();
	 ?>
	<!DOCTYPE html>
		<html lang="en">
		<head> 
			<meta charset="utf-8" />
			<title> Western Leyte College </title>
			<meta name="keywords" content="" />
			<meta name="description" content="" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<script src="../../filterJavascript/filter.js" type="text/javascript" charset="utf-8"></script>
			<script src="../../filterJavascript/js/application.js" type="text/javascript" charset="utf-8"></script> 
			<link href="../../style.css" rel="stylesheet" type="text/css" />
			
		</head>
		
		<body>
			
      <?//menu?>


       <?php include('../../menu/nav2.php');?>

			<br/>
				 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 <label for="filter">Search:</label> <input type="text" name="filter" value="" id="filter" />
	
			</center>
				<header>
					<br/>
					<center>
					<table class='menu_tab2' rules="all" width="90%"  border="1">
							<tr>
								<th> Room Code </th>
								<th> Room Description </th>
								<th> Room Specification </th>
								<th> Room Capacity </th>
								<th> Status </th>
								<th colspan="2"> Action </th>
							</tr>
					
	<?php
$result=mysql_query("SELECT * FROM rooms,specification,room_sizes WHERE rooms.room_specification=specification.specification_id AND rooms.room_id=room_sizes.room_id ORDER BY room_code ASC ");
while($rows=mysql_fetch_array($result))	{
	$stat=$rows['room_stat'];
	$msg = $stat == 'Available' ? 'Available': 'Not Available';

		$room_id=$rows['room_id'];
		echo'<tr align="center">';
		echo'<td>'.$rows['room_code'].'</td>';
		echo'<td>'.$rows['room_description'].'</td>';
		echo'<td>'.$rows['specification'].'</td>';
		echo'<td>'.$rows['room_size'].'</td>';

		if($msg == 'Available'){
				echo"<form action='process.php' method='post'>
						<input type='hidden' name='room_id' value='$room_id' />
						<input type='hidden' name='stat' value='Not Available' />
						<td><input type='submit' name='room_stat' value='$msg' /></td>
					 </form>";
		}else{
				echo"<form action='process.php' method='post'>
						<input type='hidden' name='room_id' value='$room_id' />
						<input type='hidden' name='stat' value='Available' />
						<td><input type='submit' name='room_stat' value='$msg' /></td>
						</form>";
		}?>

		<td><a href="updateroom.php?room_id=<?php echo $room_id?>"><img src="../images/b_edit.png"></img></a></td>
		<td><a href="deleteroom.php?room_id=<?php echo $room_id?>" onclick="return confirm('are you sure you want to delete this data?')"><img src="../images/b_drop.png"></img></a></td>
		</tr>
	
	<?php }++$i;?>

</center>
	</table>
	</header>

		
		
			
	  
	
	  <div align='center'class='menu_nav3'>
						
							
								<a style="text-decoration:none;" href='addroom.php'/><input type="button" value="ADD"/></a>
						
								
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