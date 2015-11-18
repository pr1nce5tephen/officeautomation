<?php
error_reporting(0);
include('../../config/connection.php');
	 require('../../auth.php');
 	confirm_logged_in();
 	check_level();

$course_id=$_REQUEST['course_id'];
//$upade=$_POST['btnsave'];
	
$result=mysql_query("select * from course where course_id='" .$course_id. "'");
$oldvalue=mysql_fetch_array($result);

	$course_code=$oldvalue['course_code'];
	$course_desc=$oldvalue['course_desc'];
	$years=$oldvalue['years'];
	$months=$oldvalue['months'];						


if(isset($_POST['btnsave']))
{
	//$course_id=$_REQUEST['course_id'];
	 $course_code=$_POST['course_code'];
		 $course_desc=$_POST['course_desc'];
		 $years=$_POST['years'];
		 $months=$_POST['months'];
		 $course_stat='Offered';
		 $course=$_POST['course'];
if($months == null && $years != null){
	
mysql_query("UPDATE course SET course_code='$course_code', course_desc='$course_desc', years='$years', months='$months' WHERE course_id='$course_id' ");

mysql_query("DELETE FROM course_yrlvl WHERE course_id='$course_id' ");
for($a=1; $a<=$years; $a++)
	{
		mysql_query("INSERT INTO course_yrlvl(`course_yrlvl_id`,`course_id`,`yrlvl`)VALUES('','$course_id','$a') ");
	}
}
else if($years == null && $months != null)
{
mysql_query("UPDATE course SET course_code='$course_code', course_desc='$course_desc', years='$years', months='$months' WHERE course_id='$course_id' ");
mysql_query("DELETE FROM course_yrlvl WHERE course_id='$course_id' ");
mysql_query("INSERT INTO course_yrlvl(`course_yrlvl_id`,`course_id`,`yrlvl`)VALUES('','$course_id','1') ");
}
else if($years != null AND $months != null ){
mysql_query("UPDATE course SET course_code='$course_code', course_desc='$course_desc', years='$years', months='$months' WHERE course_id='$course_id' ");
	mysql_query("DELETE FROM course_yrlvl WHERE course_id='$course_id' ");
	$yrs=$years+1;	
	for($a=1; $a<=$yrs; $a++){
	
	mysql_query("INSERT INTO course_yrlvl(`course_yrlvl_id`,`course_id`,`yrlvl`)VALUES('','$course_id','$a') ");	 	
		}
}

else
{
	echo"<script type='text/javascript'>alert('Please Select Number of years')</script>";	
}
}

?>
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
		<td><input type="text" name="course_code" value="<?php echo $course_code?>" onkeyup="checkInput(this)" required/></td>
	</tr>
	
	<tr>
		<td>Course Description</td>
		<td><textarea name="course_desc" onkeyup="checkInput(this)" required/><?php echo $course_desc?></textarea></td>
	</tr>

	<!--<tr>
		<td>Course Type:</td>
		<td>Tesda Short Course:<input type="radio" name="course" value="vocational" />Bachelor/Associate:<input type="radio" name="course" value="college" /></td>
	</tr>-->

	<tr>
		<td>Course No. of Years:</td>
		<td><select name="years">
			<option value="<?php echo $years ?>"><?php echo $years ?></option>
			<option value=""> </option>			
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>	
			<option value="4">4</option>
			<option value="5">5</option>
		</select> Year(s)
		<select name="months">
			<option value="<?php echo $months ?>"><?php echo $months ?></option>
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
		<td>&nbsp;</td><td><input type="submit" name="btnsave" value="save"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="reset"/></td>
		
	</tr>
	
	
	
</table>
</form>
</center>

	</header>
	
<div align='center'class='menu_nav3'>
						
							
								<a style="text-decoration:none;" href='coursemain.php'/><input type="button" value="Back"/></a>
						
								
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