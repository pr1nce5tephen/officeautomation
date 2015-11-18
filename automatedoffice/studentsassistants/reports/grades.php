<?php
	require_once('../../auth.php');
	require_once('../../initialize.php');
	include('../../config/sy.php');
	confirm_logged_in();
	check_level();
$id=$_REQUEST['id'];
$course=$_REQUEST['course'];
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
					<script language="javascript">
	function docprint()
		{ 
		  var disp_setting="toolbar=no,location=no,directories=no,menubar=no, scrollbars=yes,width=800, height=500, left=100, top=25"; 
		  var content_vlue = document.getElementById("print_content").innerHTML; 
		  
		   var docprint=window.open("","",disp_setting);
		   docprint.document.open(); 
		   docprint.document.write('<html><head><title></title><style>table, td, th{border-collapse: collapse;border: 1px solid gray;rules:all;padding:5px;margin:10px;text-align:center;}</style><body onLoad="self.print()" style="width: 100%; font-size:12px; font-family:arial;">');          
		   docprint.document.write(content_vlue);          
		   docprint.document.write('</body></html>'); 
		   docprint.document.close(); 
		   docprint.focus();
		}
	</script>		
		</head>
		
		<body>
			
      <!--menu-->


       <?php include('../../menu/nav2.php');?>
<center/>
<br/>

<form action="" method="POST">
	<input type="hidden" name="id" value="<?php echo $id ?>" />

<select name="yr">
	<option>---Yearlevel---</option>
	<?php 
	
		$yr=mysql_query("SELECT DISTINCT course_yrlvl.yrlvl FROM course,course_yrlvl WHERE course.course_id=course_yrlvl.course_id AND course_yrlvl.course_id='$course' ORDER BY course_yrlvl.yrlvl ASC");
		while($yr2=mysql_fetch_array($yr)){
	 ?>
	 	<option value="<?php echo $yr2['yrlvl'] ?>"><?php echo $yr2['yrlvl'] ?></option>
	 <?php } ?>
</select>

<select name="sem" required>
	<option value="">---Semester---</option>
	<?php 
		$sem=mysql_query("SELECT DISTINCT enroll.sem FROM enroll ORDER BY sem ASC");
			if(mysql_num_rows($sem) > 0){
				while($getsem=mysql_fetch_array($sem)){		
	 ?>
	 	<option value="<?php echo $getsem['sem'] ?>"><?php echo $getsem['sem']?></option>
<?php 	} } ?>
</select>

<select name="SY" required>
	<option value="">---School Year---</option>
	<?php 
		$sy=mysql_query("SELECT DISTINCT sy.school_yr, sy.school_yr2, sy.sy_id FROM enroll,sy WHERE enroll.SY=sy.sy_id ORDER BY SY ASC");
			if(mysql_num_rows($sy) > 0){
				while($getsy=mysql_fetch_array($sy)){
			 ?>
			 <option value="<?php echo $getsy['sy_id'] ?>"><?php echo $getsy['school_yr'].'-'.$getsy['school_yr'] ?></option>
	 <?php 	} } ?>
</select>
<input type="submit" name="find" value="Search" /> 
</form>

			<p align="center"><input type="button" onClick=location.href="javascript:docprint()" value="Print"> <a href="gradeinquiry.php">Back</a></p>
			<div id="print_content">
				<center>
<?php 
	$stud=mysql_query("SELECT * FROM student WHERE control_number='$id'");
	$getstud=mysql_fetch_array($stud);
 ?>
<table class="menu_tab2" border="1" rules="all">
	<tr><th colspan="10"><h3><?php echo $getstud['lname'].', '. $getstud['fname'].' '.$getstud['mi'].'.'?></h3></th></tr>
	<tr>
		<th>Subject</th>
		<th>Semester</th>
		<th>School Year</th>
		<th>Prelim</th>
		<th>Midterm</th>
		<th>Semi-Final</th>
		<th>Finals</th>
		<th>Subject Grade</td>
		<th>Equivalent</th>
		<th>Remarks</th>
	</tr>

<?php
if(isset($_POST['find'])){
if(empty($_POST['sem']) === true && empty($_POST['SY']) === true){
	echo"<meta http-equiv='refresh' content='0; url=grades.php?id=$id'><script>alert('Please choose Semester and School Year!')</script>";
}else if(!empty($_POST['sem'])=== true && empty($_POST['SY']) === true){
	echo"<meta http-equiv='refresh' content='0; url=grades.php?id=$id'><script>alert('Please choose School Year!')</script>";
}
else if(empty($_POST['sem'])=== true && !empty($_POST['SY']) === true){
	echo"<meta http-equiv='refresh' content='0; url=grades.php?id=$id'><script>alert('Please choose Semester!')</script>";
}else if(!empty($_POST[sem])=== true && !empty($_POST[SY]) === true){
$query=mysql_query("SELECT * FROM enroll,bscheds,subject,sy WHERE enroll.sched_id=bscheds.sched_id AND enroll.subject_id=subject.subject_id AND enroll.SY=sy.sy_id AND enroll.control_number='$id'");
if(mysql_num_rows($query) > 0){
while($getquery=mysql_fetch_array($query)){
?>
	<tr align="center">
		<td><?php echo $getquery['subject_code'] ?></td>
		<td><?php echo $getquery['sem'] ?></td>
		<td><?php echo $getquery['school_yr'].'-'.$getquery['school_yr2'] ?></td>
		<td><?php echo $getquery['pgrade'] ?></td>
		<td><?php echo $getquery['mgrade'] ?></td>
		<td><?php echo $getquery['sfgrade'] ?></td>
		<td><?php echo $getquery['fgrade'] ?></td>
		<td><?php echo $getquery['grade'] ?></td>
		<td><?php echo $getquery['equiv'] ?></td>
		<td><?php echo $getquery['remark'] ?></td>
	</tr>

<?php } }else{echo"<meta http-equiv='refresh' content='0; url=grades.php?id=$id&&course=$course'><script>alert('No data found')</script>"; } } 
}else{ 
	/*$id=$_REQUEST['id'];
	$query=mysql_query("SELECT * FROM enroll,schedules,subject WHERE enroll.sched_id=schedules.sched_id AND schedules.subject_id=subject.subject_id AND enroll.control_number='$id'");
	while($getquery=mysql_fetch_array($query)){*/
 ?>

 <tr align="center">
		<td colspan="10">No Results</td>
	</tr>

<?php }  ?>
</table>

</div>
<br/>

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





