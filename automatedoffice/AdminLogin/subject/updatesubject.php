<?php
error_reporting(0);
include('../../config/connection.php');
 require('../../auth.php');
 	confirm_logged_in();
 	check_level();
$subject_id=$_REQUEST['subject_id'];

if(isset($_REQUEST["subject_id"])) {
$id=$_REQUEST['subject_id'];	
$subject=mysql_query("SELECT * FROM subject,course,specification WHERE subject.subject_course=course.course_id AND subject.subject_specification=specification.specification_id AND subject_id='$id' LIMIT 1") or die(mysql_error());
$sub=mysql_fetch_assoc($subject);
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
		</head>
		
		<body>
			
      <!--menu-->


       <?php include('../../menu/nav2.php');?>

				<br/> 
				


				<header>
					<br/>

<center>
<form action="" method="post">
		<input type="hidden" name="subject_id" value="<?php echo $sub['subject_id'] ?>"/>
<table class='menu_tab2' rules="all" width="30%"  border="1">
	<th colspan="2"><label id = "label">Update Subject</label></th>

	<tr>
		<td>Subject Code:</td>
		<td><input type="text" name="subject_code" onkeyup="checkInput(this)"  value="<?php echo $sub['subject_code']?>"/></td>
	</tr>
	
	<tr>
		<td>Subject Description</td>
		<td><textarea name="subject_desc"><?php echo $sub['subject_desc']?></textarea></td>
	</tr>

	<tr>
		<td>Lec.</td>
		<td><input type="text" name="subject_units_lec" onkeyup="checkInput2(this)"  value="<?php echo $sub['subject_units_lec']?>"/></td>
	</tr>

	<tr>
		<td>Lab</td>
		<td><input type="text" name="subject_units" onkeyup="checkInput2(this)"  value="<?php echo $sub['subject_units']?>"/></td>
	</tr>

	<tr>
		<td>Semester</td>
		<td><select name="subject_semester"><option><?php echo $sub['subject_semester']?></option>
					<option>1</option>
					<option>2</option>
					<option>Summer</option></select></td>
	</tr>

	<tr>
				<td><label for="category">Course</label></td>
   				<td>

   					<select name="parent_cat" id="parent_cat">
				<option value="<?php echo $sub['course_id'];?>"><?php echo $sub['course_code']?></option>
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
    <td><select name="sub_cat" id="sub_cat"><option><?php echo $sub['subject_yrlvl']?></option></select></td>
 </tr>	

	<tr>
	
		<td>Type:</td>
			<td><select name="subject_specification">
				<option value="<?php echo $sub['specification_id']?>"><?php echo $sub['specification'] ?></option>
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
	<?php 
		$query=mysql_query("SELECT * FROM prerequisites WHERE subject_id='$_POST[subject_id]' ");
		$getquery=mysql_fetch_array($query);

		//if($getquery['prerequisite'] == "none"){
	 ?>
	<tr>
		<td>None:</td><td align="center"><input type="radio" name="type" value="none" /></td>
	</tr>
	<?php //}else{ ?>
	<tr>
		<!--<td>None:</td><td align="center"><input type="radio" name="type" value="none" checked /></td>-->
	</tr>
	<?php //} ?>
	<tr>
		<td>Pre-requisite</td><td align="center"><input type="radio" name="type" value="pre" /></td>
	</tr>
	<tr>
		<td>Co-requisite</td><td align="center"><input type="radio" name="type" value="co" /></td>
	</tr>

<tr></tr>
	<tr>
		<td>&nbsp;</td><td><input class='button' type="submit" name="btnsave" value="save"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class='button' type="reset" name="reset" value="reset"/></td>
		
	</tr>
	
	
	
</table>
</form>

<?php 
		 
	if(isset($_POST['btnsave'])){
		$id=$_POST['subject_id'];
		 $subject_code=$_POST['subject_code'];
		 $subject_desc=$_POST['subject_desc'];
		 $subject_units_lec=$_POST['subject_units_lec'];
		 $subject_units=$_POST['subject_units'];
		 $subject_yrlvl=$_POST['sub_cat'];
		 $subject_semester=$_POST['subject_semester'];
		 $subject_course=$_POST['parent_cat'];
		 $subject_specification=$_POST['subject_specification'];
		 $total_units = $subject_units_lec + $subject_units;
		 $type=$_POST['type'];


if($type == null){
 	mysql_query("UPDATE subject SET subject_code='$subject_code', subject_desc='$subject_desc', subject_units_lec='$subject_units_lec', subject_units='$subject_units', subject_yrlvl='$subject_yrlvl', subject_semester='$subject_semester', subject_course='$subject_course', subject_specification='$subject_specification' WHERE subject_id='$id' ");
echo "<script>alert('Data Updated.')</script>
<meta http-equiv = 'refresh' content='0; url= subjectmain.php' />";
 }
	else if($type == "none"){

	 	 $id=$_POST['subject_id'];
		 $subject_code=$_POST['subject_code'];
		 $subject_desc=$_POST['subject_desc'];
		 $subject_units_lec=$_POST['subject_units_lec'];
		 $subject_units=$_POST['subject_units'];
		 $subject_yrlvl=$_POST['sub_cat'];
		 $subject_semester=$_POST['subject_semester'];
		 $subject_course=$_POST['parent_cat'];
		 $subject_specification=$_POST['subject_specification'];
		 $total_units = $subject_units_lec + $subject_units;
		 $t=$total_units/$total_units;
		 //$prerequisite=$_POST['prerequisite'];

mysql_query("UPDATE subject SET subject_code='$subject_code', subject_desc='$subject_desc', subject_units_lec='$subject_units_lec', subject_units='$subject_units', subject_yrlvl='$subject_yrlvl', subject_semester='$subject_semester', subject_course='$subject_course', subject_specification='$subject_specification' WHERE subject_id='$id' ");
//$subject_id=mysql_insert_id();
if($subject_units == 6){
mysql_query("UPDATE subject_time SET subject_units='$total_units', no_hrs='$total_units', no_day_week='2', per_day='3' WHERE subject_id='$subject_id' ");
}else{
mysql_query("UPDATE subject_time SET subject_units='$total_units', no_hrs='$total_units', no_day_week='$subject_units', per_day='$t' WHERE subject_id='$subject_id' ");
}
mysql_query("DELETE FROM prerequisites WHERE `subject_id`='$id' ");
mysql_query("INSERT INTO prerequisites(`pre_id`,`subject_id`,`prerequisite`) VALUES('','$subject_id','none') ");
echo "<meta http-equiv='refresh' content='0; url=subjectmain.php'><script>alert('Record Updated')</script>";


}else if($type == "pre"){

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

$querysubject2=mysql_query("SELECT * FROM subject WHERE `subject_course`='$subject_course' AND `subject_yrlvl`<='$subject_yrlvl' AND `subject_code`!='$subject_code' ");

	echo"
		<form action='' method='post'>	
		 <input type='hidden' value='$subject_id' name='subject_id'>
		 <input type='hidden' value='$subject_code' name='subject_code'>
		 <input type='hidden' value='$subject_desc' name='subject_desc'>
		 <input type='hidden' value='$subject_units_lec' name='subject_units_lec'>
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

$querysubject2=mysql_query("SELECT * FROM subject WHERE `subject_course`='$subject_course' AND `subject_yrlvl`<='$subject_yrlvl' AND `subject_code`!='$subject_code'");
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
if(isset($_POST['enter'])){
	$subject_id=$_POST['subject_id'];
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
mysql_query("UPDATE subject SET subject_code='$subject_code', subject_desc='$subject_desc', subject_units_lec='$subject_units_lec', subject_units='$subject_units', subject_yrlvl='$subject_yrlvl', subject_semester='$subject_semester', subject_course='$subject_course', subject_specification='$subject_specification' WHERE subject_id='$subject_id' ");
//$subject_id=mysql_insert_id();
//mysql_query("DELETE FROM prerequisites WHERE subject_id='$subject_id'");
//mysql_query("INSERT INTO prerequisites(`pre_id`,`subject_id`,`prerequisite`,`corequisite`) VALUES('','$subject_id','$idsub','none') ");
mysql_query("UPDATE prerequisites SET `prerequisite`='$idsub', `corequisite`='none' WHERE `subject_id`='$subject_id' ");
if($total_units == 6){
mysql_query("UPDATE subject_time SET subject_units='$total_units', no_hrs='$total_units', no_day_week='2', per_day='3' WHERE subject_id='$subject_id' ");
}else if($total_units == 2){
mysql_query("UPDATE subject_time SET subject_units='$total_units', no_hrs='$total_units', no_day_week='2', per_day='$t' WHERE subject_id='$subject_id' ");
}else if($total_units == 4){
mysql_query("UPDATE subject_time SET subject_units='$total_units', no_hrs='$total_units', no_day_week='4', per_day='$t' WHERE subject_id='$subject_id' ");
}
else{
mysql_query("UPDATE subject_time SET subject_units='$total_units', no_hrs='$total_units', no_day_week='$subject_units', per_day='$t' WHERE subject_id='$subject_id' ");
echo "<script>alert('Data Updated.')</script>
<meta http-equiv = 'refresh' content='0; url= subjectmain.php' />";
}
	}
}
if(isset($_POST['enter2'])){
	$subject_id=$_REQUEST['subject_id'];
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
		$idsub2=$_POST['idsub2'];

mysql_query("UPDATE subject SET subject_code='$subject_code', subject_desc='$subject_desc', subject_units_lec='$subject_units_lec', subject_units='$subject_units', subject_yrlvl='$subject_yrlvl', subject_semester='$subject_semester', subject_course='$subject_course', subject_specification='$subject_specification' WHERE subject_id='$subject_id' ");
//$subject_id=mysql_insert_id();
//mysql_query("DELETE FROM prerequisites WHERE subject_id='$subject_id'");
//mysql_query("INSERT INTO prerequisites(`pre_id`,`subject_id`,`prerequisite`) VALUES('','$subject_id','$idsub') ");
mysql_query("UPDATE prerequisites SET `prerequisite`='$idsub', `corequisite`='none' WHERE `subject_id`='$subject_id' ");
if($subject_units == 6){
mysql_query("UPDATE subject_time SET subject_units='$total_units', no_hrs='$total_units', no_day_week='2', per_day='3' WHERE subject_id='$subject_id' ");
}else{
mysql_query("UPDATE subject_time SET subject_units='$total_units', no_hrs='$total_units', no_day_week='$subject_units', per_day='$t' WHERE subject_id='$subject_id' ");
echo "<script>alert('Data Updated.')</script>
<meta http-equiv = 'refresh' content='0; url= subjectmain.php' />";
}
	}
}
?>
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