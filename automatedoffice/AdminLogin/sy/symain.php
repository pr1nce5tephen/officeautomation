<?php
include('../../config/connection.php');
include('../../config/sy.php');
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
					<table class='menu_tab2' rules="all" width="30%"  border="1" align="center">
						<tr><th colspan="2"><h2>School Year</h2></th></tr>
	<tr><th>School Year</th>	<th colspan="2">Option</th></tr>
<?php 
$query=mysql_query("SELECT * FROM sy");
if(mysql_num_rows($query) > 0){
while($getquery=mysql_fetch_array($query)){
	$stat=$getquery['sy_stat'];
	$msg=$stat== 'active' ? 'active' : 'inactive';

 ?>


	<tr align="center">
		<td><?php echo $getquery['school_yr'].'-'.$getquery['school_yr2']; ?></td>
		<?php if($msg == 'active'){ ?>
		<form action="syprocess.php" method="post">
			<input type="hidden" name="id" value="<?php echo $getquery['sy_id'] ?>" />
			<input type="hidden" name="value" value="inactive" />
			<td><input class='button' type="submit" name="sy_stat" value="<?php echo $stat ?>" /></td>
		</form>
		<?php }else{ ?>
		<form action="syprocess.php" method="post">
			<input type="hidden" name="id" value="<?php echo $getquery['sy_id']; ?>" />
			<input type="hidden" name="value" value="active" />
			<td><input class='button' type="submit" name="sy_stat" value="<?php echo $stat ?>"/></td>
		</form>
		<?php } ?>
		<!--<td><a href="setsy.php?id=<?php //echo $getquery['sy_id'] ?>">Edit</td>-->
		
	</tr>


<?php } }else{ ?>

<td align="center" colspan="4">No records</td>

<?php } ?>
</table>

</header>
	


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