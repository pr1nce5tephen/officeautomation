<?php
include('../../config/connection.php');
	 require('../../auth.php');
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
			<script language="javascript" src="../subjects/confirmDel.js" type="text/javascript"></script>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="../../style.css" rel="stylesheet" type="text/css" />	
			<script language="javascript" src="../../restriction.js" type="text/javascript"></script>
			
		</head>

		<body>
			
			<?//menu?>


			  <?php include('../../menu/nav.php');?>
			 
<header>
					<br/><center/>
					<table class='menu_tab2' rules="all" width="90%"  border="1" align="center">
						<tr><th colspan="9"><h2>Time List</h2></th></tr>
	<tr><th>Time Start</th>	<th>Time End</th><th>Days</th><th colspan="2">Option</th></tr>
<?php 
$query=mysql_query("SELECT * FROM time ORDER BY time_id ASC");
//$getque=mysql_fetch_array($query);
if(mysql_num_rows($query) > 0){	
while($getquery=mysql_fetch_array($query)){
	if($getquery['type'] == 'am'){
 ?>
	<tr align="center">
		<td><?php echo $getquery['time_in']; ?>am</td>
		<td><?php echo $getquery['time_out']; ?>am</td>
		<td><?php echo $getquery['monday'].' '.$getquery['tuesday'].' '.$getquery['wednesday'].' '.$getquery['thursday'].' '.$getquery['friday'].' '.$getquery['saturday'].' '.$getquery['sunday']; ?></td>
		<td><a href="edittime.php?id=<?php echo $getquery['time_id'] ?>">Edit</td>
		<td><a href="deletetime.php?id=<?php echo $getquery['time_id'] ?>" onclick="return confirm('are you sure you want to delete this record')">Delete</td>
	</tr>
<?php }else{ ?>
<tr align="center">
		<td><?php echo $getquery['time_in']; ?>pm</td>
		<td><?php echo $getquery['time_out']; ?>pm</td>
		<td><?php echo $getquery['monday'].' '.$getquery['tuesday'].' '.$getquery['wednesday'].' '.$getquery['thursday'].' '.$getquery['friday'].' '.$getquery['saturday'].' '.$getquery['sunday']; ?></td>
		<td><a href="edittime.php?id=<?php echo $getquery['time_id'] ?>">Edit</td>
		<td><a href="deletetime.php?id=<?php echo $getquery['time_id'] ?>" onclick="return confirm('are you sure you want to delete this record')">Delete</td>
	</tr>
<?php } ?>

<?php  } }else{ ?>

<td align="center" colspan="4">No records</td>

<?php } ?>
</table>

</header>
	
<div align='center'class='menu_nav3'>
						
							
								<a style="text-decoration:none;" href='timeadd.php'/><input type="button" value="Add New Time"/></a>
						
								
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