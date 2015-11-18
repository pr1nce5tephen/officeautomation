<?php
 include('../../config/connection.php');
 require('../../auth.php');
 include('../../config/sy.php');
 confirm_logged_in();
 check_level();
//require_once('ae/function.php');
$cid=$_REQUEST['CID'];
?>
<!DOCTYPE html>
	<head>
		<title>Prospectus</title>
		<!--<link href="css/report.css" rel="stylesheet" type="text/css" />-->
	</head>
	<script language="javascript">
		function docprint()
		{ 
		  var disp_setting="toolbar=no,location=no,directories=no,menubar=no, scrollbars=yes,width=1000, height=600, left=100, top=25"; 
		  var content_vlue = document.getElementById("container").innerHTML; 
		  
		   var docprint=window.open("","",disp_setting);
		   docprint.document.open(); 
		   docprint.document.write('<html><head><title></title><style>table, td, th{border-collapse: collapse;border: 2px solid gray;padding:5px;margin:10px;text-align:center;}</style><body onLoad="self.print()" style="width: 100%; font-size:12px; font-family:arial;">');          
		   docprint.document.write(content_vlue);          
		   docprint.document.write('</body></html>'); 
		   docprint.document.close(); 
		   docprint.focus();
		}
	</script>
<body >
	<center><input type="button" onClick=location.href="javascript:docprint()" value="Print"><a style="text-decoration:none;" href="../subject/subjectmain.php">&nbsp;<button>Back</button></a></p></center>
	<div id="container">
		
		<div id="print_content">
		
			<?php
			echo'<center/>';
				include ('header.php');

				//include ('registeredStudents.php');
$cid=$_REQUEST['CID'];
$course=mysql_query("SELECT * FROM course WHERE course_id='$cid'");
$getcourse=mysql_fetch_array($course);
echo "<h3>".$getcourse['course_desc']." (".$getcourse['course_code'].")</h3>";

//==========================First Year - First Semester===========================//
$cour=mysql_query("SELECT * FROM subject,course,prerequisites WHERE subject.subject_course=course.course_id AND subject.subject_id=prerequisites.subject_id AND subject.subject_semester='1' AND subject.subject_course='$cid' AND subject.subject_yrlvl='1'");

$count=mysql_query("SELECT sum(subject_units_lec) FROM subject WHERE `subject_yrlvl`='1' AND `subject_semester`='1' ");
$getcountlec=mysql_fetch_array($count);

$count2=mysql_query("SELECT sum(subject_units) FROM subject WHERE `subject_yrlvl`='1' AND `subject_semester`='1' ");
$getcountlab=mysql_fetch_array($count2);

$all=$getcountlec['0'] + $getcountlab['0'];

if(mysql_num_rows($cour) > 0){
	echo"<span align='left'><b>First Year - First Semester</b></span>";
	echo"<table border='1' width='70%'>
		<tr><th>COURSE CODE</th><th>DESCRIPTIONS</th><th>Lecture</th><th>Laboratory</th><th>Total units</th><th>Pre-requisites</th></tr>";
		//echo"<th colspan='6'><br/></th>";
	while($getcour=mysql_fetch_array($cour))
	{

		$co=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.corequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getco=mysql_fetch_array($co);

		$subject_units=$getcour['subject_units'];
		$subject_units_lec=$getcour['subject_units_lec'];
		$total_units=$subject_units + $subject_units_lec;
		$subpre=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.prerequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getsubpre=mysql_fetch_array($subpre);	
		echo "<tr align='center'>
		<td>$getcour[subject_code]</td>
		<td>$getcour[subject_desc]</td>
		<td>$subject_units_lec</td>
		<td>$subject_units</td>
		<td>$total_units</td>";
		if($getcour['prerequisite'] != 'none' AND empty($getco['corequisite']) == 'true'){
		echo"<td>$getsubpre[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND empty($getco['corequisite']) != 'true')
			{
			echo"<td>Co-req: $getco[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND $getco['corequisite'] == 'none')
			{
			echo"<td> </td></tr>";
			}
			else
			{
			echo"<td> </td></tr>";
			}
	}
	echo"<td> </td><td><b>Total Units:</b></td><td align='center'><b>$getcountlec[0]</b></td><td align='center'><b>$getcountlab[0]</b></td><td align='center'><b>$all</b></td></tr>";
}else{
	
}
echo"</table>";

//==========================First Year - Second Semester===========================//
echo "<br/>";
echo"<table>";	
$cour=mysql_query("SELECT * FROM subject,course,prerequisites WHERE subject.subject_course=course.course_id AND subject.subject_id=prerequisites.subject_id AND subject.subject_semester='2' AND subject.subject_course='$cid' AND subject.subject_yrlvl='1'");
$count=mysql_query("SELECT sum(subject_units_lec) FROM subject WHERE `subject_yrlvl`='1' AND `subject_semester`='2' ");
$getcountlec=mysql_fetch_array($count);

$count2=mysql_query("SELECT sum(subject_units) FROM subject WHERE `subject_yrlvl`='1' AND `subject_semester`='2' ");
$getcountlab=mysql_fetch_array($count2);

$all=$getcountlec['0'] + $getcountlab['0'];

if(mysql_num_rows($cour) > 0){
	echo"<span align='left'><b>First Year - Second Semester</b></span>";
	echo"<table border='1' width='70%'>
		<tr><th>COURSE CODE</th><th>DESCRIPTIONS</th><th>Lecture</th><th>Laboratory</th><th>Total units</th><th>Pre-requisites</th></tr>";

	while($getcour=mysql_fetch_array($cour))
	{
	$co=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.corequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getco=mysql_fetch_array($co);

		$subject_units=$getcour['subject_units'];
		$subject_units_lec=$getcour['subject_units_lec'];
		$total_units=$subject_units + $subject_units_lec;
		$subpre=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.prerequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getsubpre=mysql_fetch_array($subpre);	
		echo "<tr align='center'>
		<td>$getcour[subject_code]</td>
		<td>$getcour[subject_desc]</td>
		<td>$subject_units_lec</td>
		<td>$subject_units</td>
		<td>$total_units</td>";
		if($getcour['prerequisite'] != 'none' AND empty($getco['corequisite']) == 'true'){
		echo"<td>$getsubpre[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND empty($getco['corequisite']) != 'true')
			{
			echo"<td>Co-req: $getco[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND $getco['corequisite'] == 'none')
			{
			echo"<td> </td></tr>";
			}
			else
			{
			echo"<td> </td></tr>";
			}
	}
	echo"<tr><td> </td><td><b>Total Units:</b></td><td align='center'><b>$getcountlec[0]</b></td><td align='center'><b>$getcountlab[0]</b></td><td align='center'><b>$all</b></td></tr>";
}else{
	
}
echo"</table>";
echo"<table>";

//==========================Second Year - First Semester===========================//
echo "<br/>";

$cour=mysql_query("SELECT * FROM subject,course,prerequisites WHERE subject.subject_course=course.course_id AND subject.subject_id=prerequisites.subject_id AND subject.subject_semester='1' AND subject.subject_course='$cid' AND subject.subject_yrlvl='2'");

$count=mysql_query("SELECT sum(subject_units_lec) FROM subject WHERE `subject_yrlvl`='2' AND `subject_semester`='1' ");
$getcountlec=mysql_fetch_array($count);

$count2=mysql_query("SELECT sum(subject_units) FROM subject WHERE `subject_yrlvl`='2' AND `subject_semester`='1' ");
$getcountlab=mysql_fetch_array($count2);

$all=$getcountlec['0'] + $getcountlab['0'];


if(mysql_num_rows($cour) > 0){
	echo"<span align='left'><b>Second Year - First Semester</b></span>";
	echo"<table border='1' width='70%'>
		<tr><th>COURSE CODE</th><th>DESCRIPTIONS</th><th>Lecture</th><th>Laboratory</th><th>Total units</th><th>Pre-requisites</th></tr>";

	while($getcour=mysql_fetch_array($cour))
	{
	$co=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.corequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getco=mysql_fetch_array($co);

		$subject_units=$getcour['subject_units'];
		$subject_units_lec=$getcour['subject_units_lec'];
		$total_units=$subject_units + $subject_units_lec;
		$subpre=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.prerequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getsubpre=mysql_fetch_array($subpre);	
		echo "<tr align='center'>
		<td>$getcour[subject_code]</td>
		<td>$getcour[subject_desc]</td>
		<td>$subject_units_lec</td>
		<td>$subject_units</td>
		<td>$total_units</td>";
		if($getcour['prerequisite'] != 'none' AND empty($getco['corequisite']) == 'true'){
		echo"<td>$getsubpre[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND empty($getco['corequisite']) != 'true')
			{
			echo"<td>Co-req: $getco[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND $getco['corequisite'] == 'none')
			{
			echo"<td> </td></tr>";
			}
			else
			{
			echo"<td> </td></tr>";
			}
	}
		echo"<tr><td> </td><td><b>Total Units:</b></td><td align='center'><b>$getcountlec[0]</b></td><td align='center'><b>$getcountlab[0]</b></td><td align='center'><b>$all</b></td></tr>";
}else{
	
}
echo"</table>";

echo"<table>";//==========================Second Year - Second Semester===========================//
echo "<br/>";

$cour=mysql_query("SELECT * FROM subject,course,prerequisites WHERE subject.subject_course=course.course_id AND subject.subject_id=prerequisites.subject_id AND subject.subject_semester='2' AND subject.subject_course='$cid' AND subject.subject_yrlvl='2'");

$count=mysql_query("SELECT sum(subject_units_lec) FROM subject WHERE `subject_yrlvl`='2' AND `subject_semester`='2' ");
$getcountlec=mysql_fetch_array($count);

$count2=mysql_query("SELECT sum(subject_units) FROM subject WHERE `subject_yrlvl`='2' AND `subject_semester`='2' ");
$getcountlab=mysql_fetch_array($count2);

$all=$getcountlec['0'] + $getcountlab['0'];


if(mysql_num_rows($cour) > 0){
	echo"<span align='left'><b>Second Year - First Semester</b></span>";
	echo"<table border='1' width='70%'>
		<tr><th>COURSE CODE</th><th>DESCRIPTIONS</th><th>Lecture</th><th>Laboratory</th><th>Total units</th><th>Pre-requisites</th></tr>";

	while($getcour=mysql_fetch_array($cour))
	{
	$co=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.corequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getco=mysql_fetch_array($co);

		$subject_units=$getcour['subject_units'];
		$subject_units_lec=$getcour['subject_units_lec'];
		$total_units=$subject_units + $subject_units_lec;
		$subpre=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.prerequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getsubpre=mysql_fetch_array($subpre);	
		echo "<tr align='center'>
		<td>$getcour[subject_code]</td>
		<td>$getcour[subject_desc]</td>
		<td>$subject_units_lec</td>
		<td>$subject_units</td>
		<td>$total_units</td>";
		if($getcour['prerequisite'] != 'none' AND empty($getco['corequisite']) == 'true'){
		echo"<td>$getsubpre[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND empty($getco['corequisite']) != 'true')
			{
			echo"<td>Co-req: $getco[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND $getco['corequisite'] == 'none')
			{
			echo"<td> </td></tr>";
			}
			else
			{
			echo"<td> </td></tr>";
			}
	}
		echo"<tr><td> </td><td><b>Total Units:</b></td><td align='center'><b>$getcountlec[0]</b></td><td align='center'><b>$getcountlab[0]</b></td><td align='center'><b>$all</b></td></tr>";
}else{
	
}
echo"</table>";
//==========================Third Year - First Semester===========================//
echo "<br/>";

$cour=mysql_query("SELECT * FROM subject,course,prerequisites WHERE subject.subject_course=course.course_id AND subject.subject_id=prerequisites.subject_id AND subject.subject_semester='1' AND subject.subject_course='$cid' AND subject.subject_yrlvl='3'");


$count=mysql_query("SELECT sum(subject_units_lec) FROM subject WHERE `subject_yrlvl`='3' AND `subject_semester`='1' ");
$getcountlec=mysql_fetch_array($count);

$count2=mysql_query("SELECT sum(subject_units) FROM subject WHERE `subject_yrlvl`='3' AND `subject_semester`='1' ");
$getcountlab=mysql_fetch_array($count2);

$all=$getcountlec['0'] + $getcountlab['0'];



if(mysql_num_rows($cour) > 0){
	echo"<span align='left'><b>Third Year - First Semester</b></span>";
	echo"<table border='1' width='70%'>
		<tr><th>COURSE CODE</th><th>DESCRIPTIONS</th><th>Lecture</th><th>Laboratory</th><th>Total units</th><th>Pre-requisites</th></tr>";

	while($getcour=mysql_fetch_array($cour))
	{
	$co=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.corequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getco=mysql_fetch_array($co);

		$subject_units=$getcour['subject_units'];
		$subject_units_lec=$getcour['subject_units_lec'];
		$total_units=$subject_units + $subject_units_lec;
		$subpre=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.prerequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getsubpre=mysql_fetch_array($subpre);	
		echo "<tr align='center'>
		<td>$getcour[subject_code]</td>
		<td>$getcour[subject_desc]</td>
		<td>$subject_units_lec</td>
		<td>$subject_units</td>
		<td>$total_units</td>";
		if($getcour['prerequisite'] != 'none' AND empty($getco['corequisite']) == 'true'){
		echo"<td>$getsubpre[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND empty($getco['corequisite']) != 'true')
			{
			echo"<td>Co-req: $getco[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND $getco['corequisite'] == 'none')
			{
			echo"<td> </td></tr>";
			}
			else
			{
			echo"<td> </td></tr>";
			}
	}
		echo"<tr><td> </td><td><b>Total Units:</b></td><td align='center'><b>$getcountlec[0]</b></td><td align='center'><b>$getcountlab[0]</b></td><td align='center'><b>$all</b></td></tr>";
}else{
	
}
echo"</table>";
echo"<table>";
//==========================Third Year - Second Semester===========================//
echo "<br/>";

$cour=mysql_query("SELECT * FROM subject,course,prerequisites WHERE subject.subject_course=course.course_id AND subject.subject_id=prerequisites.subject_id AND subject.subject_semester='2' AND subject.subject_course='$cid' AND subject.subject_yrlvl='3'");


$count=mysql_query("SELECT sum(subject_units_lec) FROM subject WHERE `subject_yrlvl`='3' AND `subject_semester`='2' ");
$getcountlec=mysql_fetch_array($count);

$count2=mysql_query("SELECT sum(subject_units) FROM subject WHERE `subject_yrlvl`='3' AND `subject_semester`='2' ");
$getcountlab=mysql_fetch_array($count2);

$all=$getcountlec['0'] + $getcountlab['0'];



if(mysql_num_rows($cour) > 0){
	echo"<span align='left'><b>Third Year - Second Semester</b></span>";
	echo"<table border='1' width='70%'>
		<tr><th>COURSE CODE</th><th>DESCRIPTIONS</th><th>Lecture</th><th>Laboratory</th><th>Total units</th><th>Pre-requisites</th></tr>";

	while($getcour=mysql_fetch_array($cour))
	{
	$co=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.corequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getco=mysql_fetch_array($co);

		$subject_units=$getcour['subject_units'];
		$subject_units_lec=$getcour['subject_units_lec'];
		$total_units=$subject_units + $subject_units_lec;
		$subpre=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.prerequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getsubpre=mysql_fetch_array($subpre);	
		echo "<tr align='center'>
		<td>$getcour[subject_code]</td>
		<td>$getcour[subject_desc]</td>
		<td>$subject_units_lec</td>
		<td>$subject_units</td>
		<td>$total_units</td>";
		if($getcour['prerequisite'] != 'none' AND empty($getco['corequisite']) == 'true'){
		echo"<td>$getsubpre[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND empty($getco['corequisite']) != 'true')
			{
			echo"<td>Co-req: $getco[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND $getco['corequisite'] == 'none')
			{
			echo"<td> </td></tr>";
			}
			else
			{
			echo"<td> </td></tr>";
			}
	}
echo"<tr><td> </td><td><b>Total Units:</b></td><td align='center'><b>$getcountlec[0]</b></td><td align='center'><b>$getcountlab[0]</b></td><td align='center'><b>$all</b></td></tr>";

}else{
	
}	
echo"</table>";
echo"<table>";
//==========================Fourth Year - First Semester===========================//
echo "<br/>";

$cour=mysql_query("SELECT * FROM subject,course,prerequisites WHERE subject.subject_course=course.course_id AND subject.subject_id=prerequisites.subject_id AND subject.subject_semester='1' AND subject.subject_course='$cid' AND subject.subject_yrlvl='4'");


$count=mysql_query("SELECT sum(subject_units_lec) FROM subject WHERE `subject_yrlvl`='4' AND `subject_semester`='1' ");
$getcountlec=mysql_fetch_array($count);

$count2=mysql_query("SELECT sum(subject_units) FROM subject WHERE `subject_yrlvl`='4' AND `subject_semester`='1' ");
$getcountlab=mysql_fetch_array($count2);

$all=$getcountlec['0'] + $getcountlab['0'];



if(mysql_num_rows($cour) > 0){
	echo"<span align='left'><b>Fourth Year - First Semester</b></span>";
	echo"<table border='1' width='70%'>
		<tr><th>COURSE CODE</th><th>DESCRIPTIONS</th><th>Lecture</th><th>Laboratory</th><th>Total units</th><th>Pre-requisites</th></tr>";

	while($getcour=mysql_fetch_array($cour))
	{
	$co=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.corequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getco=mysql_fetch_array($co);

		$subject_units=$getcour['subject_units'];
		$subject_units_lec=$getcour['subject_units_lec'];
		$total_units=$subject_units + $subject_units_lec;
		$subpre=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.prerequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getsubpre=mysql_fetch_array($subpre);	
		echo "<tr align='center'>
		<td>$getcour[subject_code]</td>
		<td>$getcour[subject_desc]</td>
		<td>$subject_units_lec</td>
		<td>$subject_units</td>
		<td>$total_units</td>";
		if($getcour['prerequisite'] != 'none' AND empty($getco['corequisite']) == 'true'){
		echo"<td>$getsubpre[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND empty($getco['corequisite']) != 'true')
			{
			echo"<td>Co-req: $getco[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND $getco['corequisite'] == 'none')
			{
			echo"<td> </td></tr>";
			}
			else
			{
			echo"<td> </td></tr>";
			}
	}
		echo"<tr><td> </td><td><b>Total Units:</b></td><td align='center'><b>$getcountlec[0]</b></td><td align='center'><b>$getcountlab[0]</b></td><td align='center'><b>$all</b></td></tr>";
}else{
	
}			
echo"</table>";
//==========================Fourth Year - Second Semester===========================//

echo "<br/>";
echo"<table>";
$cour=mysql_query("SELECT * FROM subject,course,prerequisites WHERE subject.subject_course=course.course_id AND subject.subject_id=prerequisites.subject_id AND subject.subject_semester='2' AND subject.subject_course='$cid' AND subject.subject_yrlvl='4'");


$count=mysql_query("SELECT sum(subject_units_lec) FROM subject WHERE `subject_yrlvl`='4' AND `subject_semester`='2' ");
$getcountlec=mysql_fetch_array($count);

$count2=mysql_query("SELECT sum(subject_units) FROM subject WHERE `subject_yrlvl`='4' AND `subject_semester`='2' ");
$getcountlab=mysql_fetch_array($count2);

$all=$getcountlec['0'] + $getcountlab['0'];



if(mysql_num_rows($cour) > 0){
	echo"<span align='left'><b>Fourth Year - Second Semester</b></span>";
	echo"<table border='1' width='70%'>
		<tr><th>COURSE CODE</th><th>DESCRIPTIONS</th><th>Lecture</th><th>Laboratory</th><th>Total units</th><th>Pre-requisites</th></tr>";

	while($getcour=mysql_fetch_array($cour))
	{
	$co=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.corequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getco=mysql_fetch_array($co);

		$subject_units=$getcour['subject_units'];
		$subject_units_lec=$getcour['subject_units_lec'];
		$total_units=$subject_units + $subject_units_lec;
		$subpre=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.prerequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getsubpre=mysql_fetch_array($subpre);	
		echo "<tr align='center'>
		<td>$getcour[subject_code]</td>
		<td>$getcour[subject_desc]</td>
		<td>$subject_units_lec</td>
		<td>$subject_units</td>
		<td>$total_units</td>";
		if($getcour['prerequisite'] != 'none' AND empty($getco['corequisite']) == 'true'){
		echo"<td>$getsubpre[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND empty($getco['corequisite']) != 'true')
			{
			echo"<td>Co-req: $getco[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND $getco['corequisite'] == 'none')
			{
			echo"<td> </td></tr>";
			}
			else
			{
			echo"<td> </td></tr>";
			}
	}
		echo"<tr><td> </td><td><b>Total Units:</b></td><td align='center'><b>$getcountlec[0]</b></td><td align='center'><b>$getcountlab[0]</b></td><td align='center'><b>$all</b></td></tr>";

}else{
	
}	
echo"</table>";	

//==========================Fifth Year - First Semester===========================//

echo "<br/>";
echo"<table>";
$cour=mysql_query("SELECT * FROM subject,course,prerequisites WHERE subject.subject_course=course.course_id AND subject.subject_id=prerequisites.subject_id AND subject.subject_semester='1' AND subject.subject_course='$cid' AND subject.subject_yrlvl='5'");


$count=mysql_query("SELECT sum(subject_units_lec) FROM subject WHERE `subject_yrlvl`='5' AND `subject_semester`='1' ");
$getcountlec=mysql_fetch_array($count);

$count2=mysql_query("SELECT sum(subject_units) FROM subject WHERE `subject_yrlvl`='5' AND `subject_semester`='1' ");
$getcountlab=mysql_fetch_array($count2);

$all=$getcountlec['0'] + $getcountlab['0'];



if(mysql_num_rows($cour) > 0){
	echo"<span align='left'><b>Fourth Year - Second Semester</b></span>";
	echo"<table border='1' width='70%'>
		<tr><th>COURSE CODE</th><th>DESCRIPTIONS</th><th>Lecture</th><th>Laboratory</th><th>Total units</th><th>Pre-requisites</th></tr>";

	while($getcour=mysql_fetch_array($cour))
	{
	$co=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.corequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getco=mysql_fetch_array($co);

		$subject_units=$getcour['subject_units'];
		$subject_units_lec=$getcour['subject_units_lec'];
		$total_units=$subject_units + $subject_units_lec;
		$subpre=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.prerequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getsubpre=mysql_fetch_array($subpre);	
		echo "<tr align='center'>
		<td>$getcour[subject_code]</td>
		<td>$getcour[subject_desc]</td>
		<td>$subject_units_lec</td>
		<td>$subject_units</td>
		<td>$total_units</td>";
		if($getcour['prerequisite'] != 'none' AND empty($getco['corequisite']) == 'true'){
		echo"<td>$getsubpre[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND empty($getco['corequisite']) != 'true')
			{
			echo"<td>Co-req: $getco[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND $getco['corequisite'] == 'none')
			{
			echo"<td> </td></tr>";
			}
			else
			{
			echo"<td> </td></tr>";
			}
	}
		echo"<tr><td> </td><td><b>Total Units:</b></td><td align='center'><b>$getcountlec[0]</b></td><td align='center'><b>$getcountlab[0]</b></td><td align='center'><b>$all</b></td></tr>";
}else{
	
}	
echo"</table>";	

//==========================Fifth Year - Second Semester===========================//

echo "<br/>";
echo"<table>";
$cour=mysql_query("SELECT * FROM subject,course,prerequisites WHERE subject.subject_course=course.course_id AND subject.subject_id=prerequisites.subject_id AND subject.subject_semester='2' AND subject.subject_course='$cid' AND subject.subject_yrlvl='5'");


$count=mysql_query("SELECT sum(subject_units_lec) FROM subject WHERE `subject_yrlvl`='5' AND `subject_semester`='2' ");
$getcountlec=mysql_fetch_array($count);

$count2=mysql_query("SELECT sum(subject_units) FROM subject WHERE `subject_yrlvl`='5' AND `subject_semester`='2' ");
$getcountlab=mysql_fetch_array($count2);

$all=$getcountlec['0'] + $getcountlab['0'];



if(mysql_num_rows($cour) > 0){
	echo"<span align='left'><b>Fourth Year - Second Semester</b></span>";
	echo"<table border='1' width='70%'>
		<tr><th>COURSE CODE</th><th>DESCRIPTIONS</th><th>Lecture</th><th>Laboratory</th><th>Total units</th><th>Pre-requisites</th></tr>";

	while($getcour=mysql_fetch_array($cour))
	{
	$co=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.corequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getco=mysql_fetch_array($co);

		$subject_units=$getcour['subject_units'];
		$subject_units_lec=$getcour['subject_units_lec'];
		$total_units=$subject_units + $subject_units_lec;
		$subpre=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.prerequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getsubpre=mysql_fetch_array($subpre);	
		echo "<tr align='center'>
		<td>$getcour[subject_code]</td>
		<td>$getcour[subject_desc]</td>
		<td>$subject_units_lec</td>
		<td>$subject_units</td>
		<td>$total_units</td>";
		if($getcour['prerequisite'] != 'none' AND empty($getco['corequisite']) == 'true'){
		echo"<td>$getsubpre[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND empty($getco['corequisite']) != 'true')
			{
			echo"<td>Co-req: $getco[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND $getco['corequisite'] == 'none')
			{
			echo"<td> </td></tr>";
			}
			else
			{
			echo"<td> </td></tr>";
			}
	}
		echo"<tr><td> </td><td><b>Total Units:</b></td><td align='center'><b>$getcountlec[0]</b></td><td align='center'><b>$getcountlab[0]</b></td><td align='center'><b>$all</b></td></tr>";
}else{
	
}	
echo"</table>";	
//==========================Sixth Year - First Semester===========================//

echo "<br/>";
echo"<table>";
$cour=mysql_query("SELECT * FROM subject,course,prerequisites WHERE subject.subject_course=course.course_id AND subject.subject_id=prerequisites.subject_id AND subject.subject_semester='1' AND subject.subject_course='$cid' AND subject.subject_yrlvl='6'");


$count=mysql_query("SELECT sum(subject_units_lec) FROM subject WHERE `subject_yrlvl`='6' AND `subject_semester`='1' ");
$getcountlec=mysql_fetch_array($count);

$count2=mysql_query("SELECT sum(subject_units) FROM subject WHERE `subject_yrlvl`='6' AND `subject_semester`='1' ");
$getcountlab=mysql_fetch_array($count2);

$all=$getcountlec['0'] + $getcountlab['0'];



if(mysql_num_rows($cour) > 0){
	echo"<span align='left'><b>Fourth Year - Second Semester</b></span>";
	echo"<table border='1' width='70%'>
		<tr><th>COURSE CODE</th><th>DESCRIPTIONS</th><th>Lecture</th><th>Laboratory</th><th>Total units</th><th>Pre-requisites</th></tr>";

	while($getcour=mysql_fetch_array($cour))
	{
	$co=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.corequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getco=mysql_fetch_array($co);

		$subject_units=$getcour['subject_units'];
		$subject_units_lec=$getcour['subject_units_lec'];
		$total_units=$subject_units + $subject_units_lec;
		$subpre=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.prerequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getsubpre=mysql_fetch_array($subpre);	
		echo "<tr align='center'>
		<td>$getcour[subject_code]</td>
		<td>$getcour[subject_desc]</td>
		<td>$subject_units_lec</td>
		<td>$subject_units</td>
		<td>$total_units</td>";
		if($getcour['prerequisite'] != 'none' AND empty($getco['corequisite']) == 'true'){
		echo"<td>$getsubpre[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND empty($getco['corequisite']) != 'true')
			{
			echo"<td>Co-req: $getco[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND $getco['corequisite'] == 'none')
			{
			echo"<td> </td></tr>";
			}
			else
			{
			echo"<td> </td></tr>";
			}
	}
		echo"<tr><td> </td><td><b>Total Units:</b></td><td align='center'><b>$getcountlec[0]</b></td><td align='center'><b>$getcountlab[0]</b></td><td align='center'><b>$all</b></td></tr>";
}else{
	
}	
//==========================Sixth Year - Second Semester===========================//

echo "<br/>";
echo"<table>";
$cour=mysql_query("SELECT * FROM subject,course,prerequisites WHERE subject.subject_course=course.course_id AND subject.subject_id=prerequisites.subject_id AND subject.subject_semester='2' AND subject.subject_course='$cid' AND subject.subject_yrlvl='6'");


$count=mysql_query("SELECT sum(subject_units_lec) FROM subject WHERE `subject_yrlvl`='6' AND `subject_semester`='2' ");
$getcountlec=mysql_fetch_array($count);

$count2=mysql_query("SELECT sum(subject_units) FROM subject WHERE `subject_yrlvl`='6' AND `subject_semester`='2' ");
$getcountlab=mysql_fetch_array($count2);

$all=$getcountlec['0'] + $getcountlab['0'];



if(mysql_num_rows($cour) > 0){
	echo"<span align='left'><b>Fourth Year - Second Semester</b></span>";
	echo"<table border='1' width='70%'>
		<tr><th>COURSE CODE</th><th>DESCRIPTIONS</th><th>Lecture</th><th>Laboratory</th><th>Total units</th><th>Pre-requisites</th></tr>";

	while($getcour=mysql_fetch_array($cour))
	{
	$co=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.corequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getco=mysql_fetch_array($co);

		$subject_units=$getcour['subject_units'];
		$subject_units_lec=$getcour['subject_units_lec'];
		$total_units=$subject_units + $subject_units_lec;
		$subpre=mysql_query("SELECT * FROM prerequisites,subject WHERE prerequisites.prerequisite=subject.subject_id AND prerequisites.subject_id='$getcour[subject_id]'");
		$getsubpre=mysql_fetch_array($subpre);	
		echo "<tr align='center'>
		<td>$getcour[subject_code]</td>
		<td>$getcour[subject_desc]</td>
		<td>$subject_units_lec</td>
		<td>$subject_units</td>
		<td>$total_units</td>";
		if($getcour['prerequisite'] != 'none' AND empty($getco['corequisite']) == 'true'){
		echo"<td>$getsubpre[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND empty($getco['corequisite']) != 'true')
			{
			echo"<td>Co-req: $getco[subject_code]</td>";
			}
			else if($getcour['prerequisite'] == 'none' AND $getco['corequisite'] == 'none')
			{
			echo"<td> </td></tr>";
			}
			else
			{
			echo"<td> </td></tr>";
			}
	}
		echo"<tr><td> </td><td><b>Total Units:</b></td><td align='center'><b>$getcountlec[0]</b></td><td align='center'><b>$getcountlab[0]</b></td><td align='center'><b>$all</b></td></tr>";
}else{
	
}	
include ('footer.php');
			?>
		</div>
	</div>
</body>