	<?php
	 error_reporting(0);
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
			
		</head>
		
		<body>
			
      <!--menu-->


       <?php include('../../menu/nav2.php');?>

<br/>
<center>
<form action="specificationmain.php" method="POST">
					<input name="search" PlaceHolder="Search" />
					<input type="submit" name="button" value="Search" /> 
				</form><br/>
<table class='menu_tab2' rules="all" width="90%"  border="1">
		 <thead>
							<tr>
								<th> ID </th>
								<th> SPECIFICATION </th>
								
								<th colspan="2"> Action </th>
							</tr>
		 </thead>
		 <tbody>
	<?php
$search=$_POST['search'];
if($_POST['button']){
$result=mysql_query("SELECT * FROM specification WHERE specification_id OR specification = '$search' ORDER BY specification_id");	
}else{
$result=mysql_query("SELECT * FROM specification");
}
while($rows = mysql_fetch_assoc($result)){		
?>
<tr align="center">
<td><?php echo $rows['specification_id']?></td>
<td><?php echo $rows['specification']?></td>
<td><a href="updatespecification.php?specification_id=<?php echo $rows['specification_id']?>"><img class='button' src="../images/b_edit.png"></img></a></td>
<td><a href="specificationdelete.php?specification_id=<?php echo $rows['specification_id']?>" onclick="return confirm('are you sure you want delete this record!')"><img class='button' src="../images/b_drop.png"></img></a></td>
</tr>
<?php
}
?>
	 </tbody>
</table>
<div align='center'class='menu_nav3'>
<br/>
<a style="text-decoration:none;" href='specificationadd.php'/><input class='button' type="button" value="ADD"/></a>
</div>
</center>
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