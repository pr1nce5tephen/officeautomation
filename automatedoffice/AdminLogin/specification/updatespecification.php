<?php
error_reporting(0);
 include('../../config/connection.php');
 require('../../auth.php');
 	confirm_logged_in();
check_level();
$specification_id=$_REQUEST['specification_id'];
$upade=$_POST['btnsave'];
	
$result=mysql_query("select * from specification where specification_id='" .$specification_id. "'");
while($oldvalue=mysql_fetch_array($result))
{
	$oldspecification=$oldvalue['specification'];

	
						
}
if ($upade)
{
$newspecification=$_POST['specification'];

	
mysql_query("update specification set specification='" .$newspecification. "' where specification_id='" .$specification_id. "'");
echo"<meta http-equiv = 'refresh' content='0; url=specificationmain.php' />
											<script type='text/javascript'>\n
											alert('Record Updated');\n
											</script>";

				/****/
			}
		else
			{
				echo"<meta-http='refresh' content='0; url=specificationmain.php' />
				<script>alert(An Error Occured!);
				</script>";
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
			<script language="javascript" src="../restriction.js" type="text/javascript"></script>
		</head>
		
		<body>
			
      <!--menu-->


      <?php include('../../menu/nav2.php');?>

<br/>
			
				
			
					<center>

<form action="" method="post">
<table class='menu_tab2' rules="all" width="20%"  border="1">
	<th colspan="2"><label id = "label">Update Specification</label></th>
	<tr>
		<td>Specification:</td>
		<td><input type="text" name="specification" size="30px" onkeyup="checkInput(this)" value="<?php echo $oldspecification?>" /></td>
	</tr>
	

	
	<tr>
		<td>&nbsp;</td><td><input class='button' type="submit" name="btnsave" value="save"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class='button' type="reset" name="reset" value="reset"/></td>
		
	</tr>
	
	
</table>
</form>
					</center>


	  
	
	  <div align='center'class='menu_nav3'>
						
								<a style="text-decoration:none;" href='specificationmain.php'/><input class='button' type="button" value="Back"/></a>
								
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