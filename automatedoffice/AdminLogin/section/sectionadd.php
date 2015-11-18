<?php
error_reporting(0);
include('../../config/connection.php');
require('../../auth.php');
include('../../config/sy.php');
confirm_logged_in();
check_level(); 
		 $submit=$_POST['btnsave'];
		 $parent_cat=$_POST['parent_cat'];
		 $sub_cat=$_POST['sub_cat'];
		 $sem=$_POST['sem'];
		 $section=$_POST['section'];
		
		 
		 
	if ($submit)
	{
		if($parent_cat && $sub_cat && $sem && $section)
			{
				mysql_query("insert into section values('','" .$parent_cat. "','" .$sub_cat. "','" .$sem. "', '" .$section. "')");
				echo"<meta http-equiv = 'refresh' content='0; url=sectionmain.php' />
											<script type='text/javascript'>\n
											alert('Record Added');\n
											</script>";
			}
		else
			{
				echo"<meta-http='refresh' content='0; url=sectionmain.php' />
				<script>alert('An Error Occured!');
				</script>";
			}
			
	}
	 
	?>

	<!DOCTYPE html>
    <html lang="en">
  
      <meta charset="utf-8" />
      
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <script language="javascript" src="../subjects/confirmDel.js" type="text/javascript"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="../../style.css" rel="stylesheet" type="text/css" />
      <script language="javascript" src="../../restriction.js" type="text/javascript"></script>
      <script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    
	$("#parent_cat").change(function() {
		//$(this).after('<div id="loader"><img src="img/loading.gif" alt="loading subcategory" /></div>');
		$.get('loadsubcat.php?parent_cat=' + $(this).val(), function(data) {
			$("#sub_cat").html(data);
			$('#loader').slideUp(200, function() {
				$(this).remove();
			});
		});	
    });

});
</script>
      
   
    
    <body>
      
      <!--menu-->


       <?php include('../../menu/nav2.php');?>

<br/>
<center>
<form action="" method="post">
<table class='menu_tab2' rules="all" width="20%"  border="1">
	<th colspan="2"><label id = "label">Add Section</label></th>

	<tr>
	
		<td>Course:	</td>
			<td><select name="parent_cat" id="parent_cat">
				<option>--------------------------------Select Course--------------------------------</option>
				<?php $q = mysql_query("SELECT * FROM course order by course_id");
				while($r = mysql_fetch_array($q)){
				$name = $r['course_code'].'|'.$r['course_desc'];; 
				?>
				<option value="<?php echo $r['course_id'];?>"><?php echo $name ?></option>
				<?php }?>
				</select>
		
			
	</tr>
	
	<tr>
		<td><label>Year Level</label></td>
		<td><select name="sub_cat" id="sub_cat"></select></td>
	</tr>

	<tr>
		<td>Semester</td>
		<td><select name="sem">
				<option>---Select Semester---</option>
				<option value="summer">Summer</option>
				<option value="1">1</option>
				<option value="2">2</option>
			</select>
		</td>
	</tr>

	
	<tr>
		<td>Section</td>
		<td><input type="text" name="section" onkeyup="checkInput2(this)" maxlength="2" /></td>
	</tr>


	<tr>
		<td>&nbsp;</td><td><input type="submit" name="btnsave" value="save"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="reset"/></td>
		
	</tr>
	
	
	
</table>
</form>
</center>


		
		
			
	  
	<div align='center'class='menu_nav3'>
						<br/>
							
								<a style="text-decoration:none;" href='sectionmain.php'/><input type="button" value="Back	"/></a>
						
								
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