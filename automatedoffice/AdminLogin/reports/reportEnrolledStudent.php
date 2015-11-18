<?php
	require_once('../../auth.php');
	require_once('../../initialize.php');
	include('../../config/sy.php');
	confirm_logged_in();
?>
<html>
	<head>
		<title>
			Enrolled Students
		</title>
	<link href="css/report.css" rel="stylesheet" type="text/css" />
	</head>
	
	<script language="javascript">
	function docprint()
		{ 
		  var disp_setting="toolbar=no,location=no,directories=no,menubar=no, scrollbars=yes,width=1000, height=600, left=100, top=25"; 
		  var content_vlue = document.getElementById("print_content").innerHTML; 
		  
		   var docprint=window.open("","",disp_setting);
		   docprint.document.open(); 
		   docprint.document.write('<html><head><title></title><style>table, td, th{border-collapse: collapse;border: 2px solid gray;padding:5px;margin:10px;text-align:center;}</style><body onLoad="self.print()" style="width: 100%; font-size:12px; font-family:arial;">');          
		   docprint.document.write(content_vlue);          
		   docprint.document.write('</body></html>'); 
		   docprint.document.close(); 
		   docprint.focus();
		}
	</script>
	
	<body>
		<center>
		<p align="center"><input type="button" onClick=location.href="javascript:docprint()" value="Print"> <a href="../reports/reportEnrolledStudent.php"><button>Back</button></a></p>
			<div id="print_content">
				<?php include("header.php"); ?>
				<center>
					<h2><u>List of Enrolled Students</u></h2>
						<?php
						if(isset($_REQUEST['submit'])){
							$sem = $_REQUEST['sem'];
							$sy = $_REQUEST['sy'];
									if (empty ($sem) === true && empty($sy) === true){
										echo "<script>alert('select semester and school year');window.location.href='reportEnrolledStudent.php';</script>";
									}else if (empty ($sem) === true){
										echo "<script>alert('select semester');window.location.href='reportEnrolledStudent.php';</script>";
									}else if (empty ($sy) === true){
										echo "<script>alert('select school year');window.location.href='reportEnrolledStudent.php';</script>";
									}
							
								$query = mysql_query("SELECT * FROM enroll,sy WHERE enroll.SY=sy.sy_id AND enroll.SY='$sy' AND enroll.sem='$sem' ") or die(mysql_error());
								$semsy = mysql_fetch_array($query);
						?>
						
						<pre>
<b>Semester : <?php echo $semsy['sem']; ?></b>                      <b>School Year : <?php echo $semsy['school_yr'].'-'.$semsy['school_yr2']; ?></b>
						</pre>
						<table border='1' rules='all' cellpadding='5px'>
							<thead>
								<tr>
									<th>No.</th>
									<th>Student Control Number</th>
									<th  height="35">Student Name</th>
									<th>Course</th>
									<th>Address</th>
									<th>Contact Number</th>
								</tr>
							</thead>
							<?php
								$query = mysql_query("SELECT DISTINCT enroll.SY, enroll.sem, student.control_number, student.lname, student.fname, student.mi, student.address, student.contact_number, course.course_code FROM enroll, student, course WHERE enroll.control_number=student.control_number AND student.course=course.course_id AND enroll.SY='$sy' AND enroll.sem='$sem' ") or die(mysql_error());
								$num=0;
								if(mysql_num_rows($query)>0){
									while($enrolled = mysql_fetch_assoc($query)){
									$num++;
							?>
							<tbody>
								<td align='center'><?php echo $num."." ?></td>
								<td align='center'><?php echo $enrolled['control_number']; ?></td>
								<td><div align="center"><?php echo $enrolled['lname'].", ".$enrolled['fname']." ".$enrolled['mi']; ?></div></td>
								<td align='center'><?php echo $enrolled['course_code']; ?></td>
								<td align='center'><?php echo $enrolled['address']; ?></td>
								<td align='center'><?php echo $enrolled['contact_number']; ?></td>
							</tbody>
							<?php
									}
								}else{
									echo "<script>alert('no record found');window.location.href='reportEnrolledStudent.php';</script>";
								}
							}else{?>
									<form action='reportEnrolledStudent.php' method='POST'>
									<!--this select to get semester-->
									<select name = 'sem'>
									<option value = '' selected>Semester</option>
										<?php
											$query = mysql_query('SELECT DISTINCT bscheds.sem FROM bscheds order by sem') or die(mysql_error());
												if(mysql_num_rows($query)>0){ 
													while($data = mysql_fetch_array($query)) {
										?>
									<option value = '<?php echo $data['sem']?>'><?php echo $data['sem']?></option>
										<?php
													}
												}
										?>
									</select>
									<!--this select to get school year-->
									<select name = 'sy'>
									<option value = '' selected>School Year</option>
										<?php
											$query = mysql_query('SELECT DISTINCT bscheds.sy_id, sy.school_yr, sy.school_yr2 FROM bscheds,sy WHERE bscheds.sy_id=sy.sy_id ') or die(mysql_error());
												if(mysql_num_rows($query)>0){ 
													while($data = mysql_fetch_array($query)) {
										?>
									<option value = '<?php echo $data['sy_id']?>'><?php echo $data['school_yr'].'-'.$data['school_yr2']?></option>
										<?php
													}
												}
										?>
									</select>
									<input type = 'submit' name = 'submit' value = 'Search'>
									</form>
							<?php
							}
							?>
						</table></center>
					<?php include("footer.php"); ?>
			</div>			
		
	</body>
</html>