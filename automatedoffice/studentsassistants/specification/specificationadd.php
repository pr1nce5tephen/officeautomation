	<?php
	 error_reporting(0);
	 include('../../config/connection.php');
 require('../../auth.php');
 	confirm_logged_in();
	check_level(); 
		 $submit=$_POST['btnsave'];
		 $specification=$_POST['specification'];
		
		 
		 
	if ($submit)
	{
		if($specification)
			{
				mysql_query("insert into specification values('','" .$specification. "')");
				echo"<meta http-equiv = 'refresh' content='0; url=specificationmain.php' />
											<script type='text/javascript'>\n
											alert('Record Added');\n
											</script>";

				/****/
			}
		else
			{
				echo"<meta-http='refresh' content='0; url=specificationmain.php' />
				<script>alert(An Error Occured!);
				</script>";
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
      <script language="javascript" src="../restriction.js" type="text/javascript"></script>
      
    </head>
    
    <body>
      
      <!--menu-->


       <?php include('../../menu/nav2.php');?>

<br/>
<center>
<form action="" method="post">
<table class='menu_tab2' rules="all" width="20%"  border="1">
	<th colspan="2"><label id = "label">Add Specification</label></th>

	<tr>
		<td>Specification:</td>
		<td><input type="text" name="specification" onkeyup="checkInput(this)" /></td>
	</tr>
	
	

	
<tr></tr>
	<tr>
		<td>&nbsp;</td><td><input type="submit" name="btnsave" value="save"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="reset"/></td>
		
	</tr>
	
	
	
</table>
</form>
</center>


		
		
			
	  
	<div align='center'class='menu_nav3'>
						<br/>
							
								<a style="text-decoration:none;" href='specificationmain.php'/><input type="button" value="Back	"/></a>
						
								
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