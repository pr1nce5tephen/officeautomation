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
<script language="JavaScript">
	<!--
		function message(element){
			alert("You clicked the " + element + " element")
		}
	//-->
</script>
		</head>
		
		<body>
			
      <!--menu-->

<?php include('../../menu/nav2.php');?>

				<br/> 
				


				<header>
					<br/>

<center>
<form action="" method="post">
<table class='menu_tab2' rules="all" width="30%"  border="1">
	<th colspan="2"><label id = "label">Add Subject</label></th>

	<tr>
		<td>Subject Code:</td>
		<td><input type="text" name="subject_code" onkeyup="checkInput(this)" required /></td>
	</tr>
	
	<tr>
		<td>Subject Description</td>
		<td><textarea name="subject_desc" onkeyup="checkInput(this)" required ></textarea></td>
	</tr>

	<tr>
		<td>Lec.</td>
		<td><input type="text" name="subject_units_lec" onkeyup="checkInput2(this)"/></td>
	</tr>

	<tr>
		<td>Lab.</td>
		<td><input type="text" name="subject_units" onkeyup="checkInput2(this)"/></td>
	</tr>

	<tr>
				<td><label for="category">Course</label></td>
   				<td>

   					<select name="parent_cat" id="parent_cat">
				<option value="">---Select Course---</option>
				<?php $q = mysql_query("SELECT * FROM course ORDER BY course_id asc");
				while($r = mysql_fetch_array($q)){
				$name = $r['course_code']; 
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
		<td><select name="subject_semester"><option value="">---Select Semester---</option>
					<option value="1">First Semester</option>
					<option value="2">Second Semester</option>
					<option>Summer</option></select/></td>
	</tr>

	<tr>
	
		<td>Type:	</td>
			<td><select name="subject_specification" required>
				<option value="">---Select Subject Type---</option>
												<?php $q = mysql_query("SELECT * FROM specification order by specification_id");
												while($r = mysql_fetch_array($q)){
												$name = $r['specification']; 
												?>
												<option value="<?php echo $r['specification_id'];?>"><?php echo $name ?></option>
												<?php }?>
												</select>	
	</tr>

	<tr>
		<th colspan="2">Include: </th>
	</tr>
	
	<tr>
		<td>None:</td><td align="center"><input type="radio" name="type" value="none" onClick="message('Radio Button None')" /></td>
	</tr>
	<tr>
		<td>Pre-requisite</td><td align="center"><input type="radio" name="type" value="pre" onClick="message('Radio Button Pre-requisite')"/></td>
	</tr>
	<tr>
		<td>Co-requisite</td><td align="center"><input type="radio" name="type" value="co" onClick="message('Radio Button Pre-requisite')"/></td>
	</tr>
	<!--<tr>
		<td>Co-requisite</td><td align="center"><input type="radio" name="type" value="co" /></td>
	</tr>-->

<tr></tr>
	<tr>
		<td>&nbsp;</td><td><input class='button' type="submit" name="btnsave" value="save"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class='button' type="reset" name="reset" value="reset"/></td>
		
	</tr>
	
	
	
</table>
</form>

<?php 
 
		 $submit=$_POST['btnsave'];
		 
	if(isset($_POST['btnsave'])){
$subject_code=$_POST['subject_code'];
$subject_course=$_POST['subject_course'];
$type=$_POST['type'];
 $query = mysql_query("SELECT * FROM subject WHERE (`subject_code` LIKE '%".$subject_code."%') AND (`subject_course` LIKE '%".$subject_course."%') ");
 
if($type != null){
	//====================none=====================//
	if($type == "none"){

if(mysql_num_rows($query) > 0){
   echo "<meta http-equiv='refresh' content='0; url=subjectadd.php'><script>alert('Cannot Add! Existing Subject Code!')</script>";
}else{
	 
		 $subject_code=$_POST['subject_code'];
		 $subject_desc=$_POST['subject_desc'];
		 $subject_units_lec=$_POST['subject_units_lec'];
		 $subject_units=$_POST['subject_units'];
		 $subject_yrlvl=$_POST['sub_cat'];
		 $subject_semester=$_POST['subject_semester'];
		 $subject_course=$_POST['parent_cat'];
		 $subject_specification=$_POST['subject_specification'];
		 //$prerequisite=$_POST['prerequisite'];
		 $total_units = $subject_units_lec + $subject_units;
mysql_query("INSERT INTO subject (subject_code, subject_desc, subject_units_lec, subject_units, subject_yrlvl, subject_semester, subject_course, subject_specification)
VALUES ('$subject_code', '$subject_desc', '$subject_units_lec', '$subject_units', '$subject_yrlvl', '$subject_semester', '$subject_course', '$subject_specification')");
$subject_id=mysql_insert_id();
mysql_query("INSERT INTO prerequisites(`pre_id`,`subject_id`,`prerequisite`,`corequisite`) VALUES('','$subject_id','none','none') ");
if($total_units == 6){
mysql_query("INSERT INTO subject_time(`sub_time_id`,`subject_id`,`subject_units`,`no_hrs`,`no_day_week`,`per_day`) VALUES('','$subject_id','$total_units','$total_units','2','3')");
echo "<meta http-equiv='refresh' content='0; url=subjectadd.php'><script>alert('1 record added')</script>";
}else if($total_units == 5){
mysql_query("INSERT INTO subject_time(`sub_time_id`,`subject_id`,`subject_units`,`no_hrs`,`no_day_week`,`per_day`) VALUES('','$subject_id','$total_units','$total_units','2','3')");
echo "<meta http-equiv='refresh' content='0; url=subjectadd.php'><script>alert('1 record added')</script>";	
}else if($total_units == 4){
mysql_query("INSERT INTO subject_time(`sub_time_id`,`subject_id`,`subject_units`,`no_hrs`,`no_day_week`,`per_day`) VALUES('','$subject_id','$total_units','$total_units','2','2')");
echo "<meta http-equiv='refresh' content='0; url=subjectadd.php'><script>alert('1 record added')</script>";	
}else if($total_units == 2){
mysql_query("INSERT INTO subject_time(`sub_time_id`,`subject_id`,`subject_units`,`no_hrs`,`no_day_week`,`per_day`) VALUES('','$subject_id','$total_units','$total_units','2','1')");
echo "<meta http-equiv='refresh' content='0; url=subjectadd.php'><script>alert('1 record added')</script>";	
}
else{
	$t=$total_units/$total_units;
mysql_query("INSERT INTO subject_time(`sub_time_id`,`subject_id`,`subject_units`,`no_hrs`,`no_day_week`,`per_day`) VALUES('','$subject_id','$total_units','$total_units','3','$t')");
echo "<meta http-equiv='refresh' content='0; url=subjectadd.php'><script>alert('1 record added')</script>";

}
}
}
//====================Prerequisites=====================//
else if($type == "pre"){
		 $subject_code=$_POST['subject_code'];
		 $subject_desc=$_POST['subject_desc'];
		 $subject_units_lec=$_POST['subject_units_lec'];
		 $subject_units=$_POST['subject_units'];
		 $subject_yrlvl=$_POST['sub_cat'];
		 $subject_semester=$_POST['subject_semester'];
		 $subject_course=$_POST['parent_cat'];
		 $subject_specification=$_POST['subject_specification'];
		 //$prerequisite=$_POST['prerequisite'];
/*$querysubject=mysql_query("SELECT * FROM subject WHERE `subject_id` = '$subject_id' ");
$getquerysubject=mysql_fetch_array($querysubject);*/

$querysubject2=mysql_query("SELECT * FROM subject WHERE `subject_course`='$subject_course' AND `subject_yrlvl`<='$subject_yrlvl' ");

	echo"
		<form action='' method='post'>	
		 <input type='hidden' value='$subject_code' name='subject_code'>
		 <input type='hidden' value='$subject_desc' name='subject_desc'>
		 <input type='hidden' value='$subject_units_lec' name='subject_units_lec'>
		 <input type='hidden' value='$subject_units' name='subject_units'>
		 <input type='hidden' value='$subject_units' name='subject_units'>
		 <input type='hidden' value='$subject_yrlvl' name='sub_cat'>
		 <input type='hidden' value='$subject_semester' name='subject_semester'>
		 <input type='hidden' value='$subject_course' name='subject_course'>
		 <input type='hidden' value='$subject_specification' name='subject_specification'>	

		 <table class='menu_tab2' width='30%' rules='all'>
			<tr>
				<td style='background:black;color:white;'>
					Subjects:
				</td>
			</tr>
			<tr>
				<td>
					<div style='background:white; width:100%; height:300px; color:black; overflow:scroll;'>";
					while($getquerysubject2=mysql_fetch_array($querysubject2)){
					echo"
					<input type='radio' name='idsub' value='$getquerysubject2[subject_id]'> $getquerysubject2[subject_code]|$getquerysubject2[subject_desc]<br>
						";
					}
																	
					echo"</div>
				</td>
			</tr>
			<tr>
				<td align='center'><input type='submit' name='enter' value='Enter'></td>
			</tr>
		 </table>
		</form>";

}
//====================Corequisites=====================//
else if($type == "co"){
		 $subject_code=$_POST['subject_code'];
		 $subject_desc=$_POST['subject_desc'];
		 $subject_units_lec=$_POST['subject_units_lec'];
		 $subject_units=$_POST['subject_units'];
		 $subject_yrlvl=$_POST['sub_cat'];
		 $subject_semester=$_POST['subject_semester'];
		 $subject_course=$_POST['parent_cat'];
		 $subject_specification=$_POST['subject_specification'];
		 //$prerequisite=$_POST['prerequisite'];
/*$querysubject=mysql_query("SELECT * FROM subject WHERE `subject_id` = '$subject_id' ");
$getquerysubject=mysql_fetch_array($querysubject);*/

$querysubject2=mysql_query("SELECT * FROM subject WHERE `subject_course`='$subject_course' AND `subject_yrlvl`<='$subject_yrlvl' ");

	echo"
		<form action='' method='post'>	
		 <input type='hidden' value='$subject_code' name='subject_code'>
		 <input type='hidden' value='$subject_desc' name='subject_desc'>
		 <input type='hidden' value='$subject_units_lec' name='subject_units_lec'>
		 <input type='hidden' value='$subject_units' name='subject_units'>
		 <input type='hidden' value='$subject_units' name='subject_units'>
		 <input type='hidden' value='$subject_yrlvl' name='sub_cat'>
		 <input type='hidden' value='$subject_semester' name='subject_semester'>
		 <input type='hidden' value='$subject_course' name='subject_course'>
		 <input type='hidden' value='$subject_specification' name='subject_specification'>	

		 <table class='menu_tab2' width='30%' rules='all'>
			<tr>
				<td style='background:black;color:white;'>
					Subjects:
				</td>
			</tr>
			<tr>
				<td>
					<div style='background:white; width:100%; height:300px; color:black; overflow:scroll;'>";
					while($getquerysubject2=mysql_fetch_array($querysubject2)){
					echo"
					<input type='radio' name='idsub2' value='$getquerysubject2[subject_id]'> $getquerysubject2[subject_code]|$getquerysubject2[subject_desc]<br>
						";
					}
																	
					echo"</div>
				</td>
			</tr>
			<tr>
				<td align='center'><input type='submit' name='enter2' value='Enter'></td>
			</tr>
		 </table>
		</form>";

}
}
else {
	echo"Please choose an Option!";
}
}
if(isset($_POST['enter'])){
	$subject_code=$_POST['subject_code'];
	$subject_desc=$_POST['subject_desc'];
	$subject_units_lec=$_POST['subject_units_lec'];
	$subject_units=$_POST['subject_units'];
	$subject_yrlvl=$_POST['sub_cat'];
	$subject_semester=$_POST['subject_semester'];
	$subject_course=$_POST['subject_course'];
	$subject_specification=$_POST['subject_specification'];
	$total_units = $subject_units_lec + $subject_units;
	$t=$total_units/$total_units;

	if(isset($_POST['idsub'])){
		$idsub=$_POST['idsub'];
mysql_query("INSERT INTO subject (subject_code, subject_desc, subject_units_lec, subject_units, subject_yrlvl, subject_semester, subject_course, subject_specification)
VALUES ('$subject_code', '$subject_desc', '$subject_units_lec', '$subject_units', '$subject_yrlvl', '$subject_semester', '$subject_course', '$subject_specification')");
$subject_id=mysql_insert_id();
if($total_units == 6){
mysql_query("INSERT INTO subject_time(`sub_time_id`,`subject_id`,`subject_units`,`no_hrs`,`no_day_week`,`per_day`) VALUES('','$subject_id','$total_units','$total_units','2','3')");
}else if($total_units == 5){
mysql_query("INSERT INTO subject_time(`sub_time_id`,`subject_id`,`subject_units`,`no_hrs`,`no_day_week`,`per_day`) VALUES('','$subject_id','$total_units','$total_units','2','3')");
echo "<meta http-equiv='refresh' content='0; url=subjectadd.php'><script>alert('1 record added')</script>";	
}else if($total_units == 4){
mysql_query("INSERT INTO subject_time(`sub_time_id`,`subject_id`,`subject_units`,`no_hrs`,`no_day_week`,`per_day`) VALUES('','$subject_id','$total_units','$total_units','2','2')");
echo "<meta http-equiv='refresh' content='0; url=subjectadd.php'><script>alert('1 record added')</script>";	
}else if($total_units == 2){
mysql_query("INSERT INTO subject_time(`sub_time_id`,`subject_id`,`subject_units`,`no_hrs`,`no_day_week`,`per_day`) VALUES('','$subject_id','$total_units','$total_units','2','1')");
echo "<meta http-equiv='refresh' content='0; url=subjectadd.php'><script>alert('1 record added')</script>";	
}else{
mysql_query("INSERT INTO subject_time(`sub_time_id`,`subject_id`,`subject_units`,`no_hrs`,`no_day_week`,`per_day`) VALUES('','$subject_id','$total_units','$total_units','3','$t')");
//echo "<meta http-equiv='refresh' content='0; url=subjectadd.php'><script>alert('1 record added')</script>";
}
mysql_query("INSERT INTO prerequisites(`pre_id`,`subject_id`,`prerequisite`,`corequisite`) VALUES('','$subject_id','$idsub','none') ");
echo "<meta http-equiv='refresh' content='0; url=subjectadd.php'><script>alert('1 record added')</script>";


	}
}
else if(isset($_POST['enter2'])){
	$subject_code=$_POST['subject_code'];
	$subject_desc=$_POST['subject_desc'];
	$subject_units_lec=$_POST['subject_units_lec'];
	$subject_units=$_POST['subject_units'];
	$subject_yrlvl=$_POST['sub_cat'];
	$subject_semester=$_POST['subject_semester'];
	$subject_course=$_POST['subject_course'];
	$subject_specification=$_POST['subject_specification'];
	$total_units = $subject_units_lec + $subject_units;
	$t=$total_units/$total_units;

	if(isset($_POST['idsub2'])){
		$idsub=$_POST['idsub2'];
mysql_query("INSERT INTO subject (subject_code, subject_desc, subject_units_lec, subject_units, subject_yrlvl, subject_semester, subject_course, subject_specification)
VALUES ('$subject_code', '$subject_desc', '$subject_units_lec', '$subject_units', '$subject_yrlvl', '$subject_semester', '$subject_course', '$subject_specification')");
$subject_id=mysql_insert_id();
if($total_units == 6){
mysql_query("INSERT INTO subject_time(`sub_time_id`,`subject_id`,`subject_units`,`no_hrs`,`no_day_week`,`per_day`) VALUES('','$subject_id','$total_units','$total_units','2','3')");
}else if($total_units == 5){
mysql_query("INSERT INTO subject_time(`sub_time_id`,`subject_id`,`subject_units`,`no_hrs`,`no_day_week`,`per_day`) VALUES('','$subject_id','$total_units','$total_units','2','3')");
echo "<meta http-equiv='refresh' content='0; url=subjectadd.php'><script>alert('1 record added')</script>";	
}else if($total_units == 4){
mysql_query("INSERT INTO subject_time(`sub_time_id`,`subject_id`,`subject_units`,`no_hrs`,`no_day_week`,`per_day`) VALUES('','$subject_id','$total_units','$total_units','2','2')");
echo "<meta http-equiv='refresh' content='0; url=subjectadd.php'><script>alert('1 record added')</script>";	
}else if($total_units == 2){
mysql_query("INSERT INTO subject_time(`sub_time_id`,`subject_id`,`subject_units`,`no_hrs`,`no_day_week`,`per_day`) VALUES('','$subject_id','$total_units','$total_units','2','1')");
echo "<meta http-equiv='refresh' content='0; url=subjectadd.php'><script>alert('1 record added')</script>";	
}
else{
mysql_query("INSERT INTO subject_time(`sub_time_id`,`subject_id`,`subject_units`,`no_hrs`,`no_day_week`,`per_day`) VALUES('','$subject_id','$total_units','$total_units','3','$t')");
//echo "<meta http-equiv='refresh' content='0; url=subjectadd.php'><script>alert('1 record added')</script>";
}
mysql_query("INSERT INTO prerequisites(`pre_id`,`subject_id`,`prerequisite`,`corequisite`) VALUES('','$subject_id','none','$idsub') ");
echo "<meta http-equiv='refresh' content='0; url=subjectadd.php'><script>alert('1 record added')</script>";


	}
}

?>
<!--<input type="" name="" value="<?php //echo $subject_id ?>" />-->
</center>

	</header>



	<div align='center'class='menu_nav3'>
						
							
								<a style="text-decoration:none;" href='subjectmain.php'/><input class='button' type="button" value="Back"/></a>
						
								
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