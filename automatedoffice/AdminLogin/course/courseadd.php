<?php
	 error_reporting(0);
	 include('../../config/connection.php');
	 require('../../auth.php');
	 include('../../config/sy.php');
 	confirm_logged_in();
 	check_level();
	
	if(isset($_POST['btnsave'])) {
	$course_code=$_POST['course_code'];
	$course_desc=$_POST['course_desc'];

	$trap=mysql_query("SELECT * FROM course WHERE course_code='$course_code' OR course_desc='$course_desc' ");
	if(mysql_num_rows($trap) > 0){
		echo"<meta http-equiv = 'refresh' content='0; url = courseadd.php'>
				<script type='text/javascript'>alert('Cannot add data is already exist')</script>";
	}else{
		
		 $course_code=$_POST['course_code'];
		 $course_desc=$_POST['course_desc'];
		 $years=$_POST['years'];
		 $months=$_POST['months'];
		 $course_stat='Offered';
		 $course=$_POST['course'];
if($months == null && $years != null)
{
mysql_query("INSERT INTO course(`course_id`,`course_code`,`course_desc`,`years`,`months`,`course_stat`)VALUES('','$course_code','$course_desc','$years','','$course_stat') ");
$course_id=mysql_insert_id();
	for($a=1; $a<=$years; $a++)
	{
		mysql_query("INSERT INTO course_yrlvl(`course_yrlvl_id`,`course_id`,`yrlvl`)VALUES('','$course_id','$a') ");
		echo"<meta http-equiv='refresh' content='0; url=coursemain.php'><script>alert('1 Record Added!')</script>";
	}
}
else if($years == null && $months != null)
{
mysql_query("INSERT INTO course(`course_id`,`course_code`,`course_desc`,`years`,`months`,`course_stat`)VALUES('','$course_code','$course_desc','','$months','$course_stat') ");
$course_id=mysql_insert_id();
mysql_query("INSERT INTO course_yrlvl(`course_yrlvl_id`,`course_id`,`yrlvl`)VALUES('','$course_id','1') ");
echo"<meta http-equiv='refresh' content='0; url=coursemain.php'><script>alert('1 Record Added!')</script>";
}
else if($years != null AND $months != null ){
mysql_query("INSERT INTO course(`course_id`,`course_code`,`course_desc`,`years`,`months`,`course_stat`)VALUES('','$course_code','$course_desc','$years','$months','$course_stat') ");
echo"<meta http-equiv='refresh' content='0; url=coursemain.php'><script>alert('1 Record Added!')</script>";
$course_id=mysql_insert_id();
	$yrs=$years+1;	
	for($a=1; $a<=$yrs; $a++){
	mysql_query("INSERT INTO course_yrlvl(`course_yrlvl_id`,`course_id`,`yrlvl`)VALUES('','$course_id','$a') ");
		}
	echo"<meta http-equiv='refresh' content='0; url=coursemain.php'><script>alert('1 Record Added!')</script>";
}

else
{
	echo"<script type='text/javascript'>alert('Please Select Number of years')</script>";	
}
	
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


			  <?php include('../../menu/nav.php');?>
			 
<header>
					<br/>
					

<center>
<form action="" method="post">
<table class='menu_tab2' rules="all" width="35%"  border="1">
	<th colspan="2"><label id = "label">Add Course</label></th>
	<tr>
		<td>Course Code:</td>
		<td><input type="text" name="course_code" value="<?php echo $_POST['course_code']?>" onkeyup="checkInput(this)" required/></td>
	</tr>
	
	<tr>
		<td>Course Description</td>
		<td><textarea name="course_desc" onkeyup="checkInput(this)" required/><?php echo $_POST['course_desc']?></textarea></td>
	</tr>

	<!--<tr>
		<td>Course Type:</td>
		<td>Tesda Short Course:<input type="radio" name="course" value="vocational" />Bachelor/Associate:<input type="radio" name="course" value="college" /></td>
	</tr>-->

	<tr>
		<td>Course No. of Years:</td>
		<td><select name="years">
			<option value=""> </option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>	
			<option value="4">4</option>
			<option value="5">5</option>
		</select> Year(s)
		<select name="months">
			<option value=""> </option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>	
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>	
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
		</select> Month(s)
		</td>
	</tr>

	<tr>
		<td>&nbsp;</td><td><input class='button' type="submit" name="btnsave" value="save"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class='button' type="reset" name="reset" value="reset"/></td>
		
	</tr>
	
	
	
</table>
</form>
</center>

	</header>
	
<div align='center'class='menu_nav3'>
						
							
								<a style="text-decoration:none;" href='coursemain.php'/><input class='button' type="button" value="Back"/></a>
						
								
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