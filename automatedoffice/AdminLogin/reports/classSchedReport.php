<?php
	require_once('../../auth.php');
	require_once('../../initialize.php');
	include('../../config/sy.php');
	confirm_logged_in();
?>
<html>
	<head>
		<title>
			Class Schedules
		</title>
	<link href="css/report.css" rel="stylesheet" type="text/css" />
	</head>
	
	<!--<script language="javascript">
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
	</script>-->
	
	<body>
		<center>
		<!--<p align="center"><input type="button" onClick=location.href="javascript:docprint()" value="Print"> <a href="../reports/classSchedReport.php"><button>Back</button></a> <a href="../class/createClass.php"><button>Return to Class</button></a></p>
			<div id="print_content">
				<center/>
				<?php //include("header.php"); ?>-->
				<center>
					<h2><u>Class Schedules</u></h2>
						<?php
						if(isset($_REQUEST['submit'])){
							$sem = $_REQUEST['sem'];
							$sy = $_REQUEST['sy'];
							$course = $_REQUEST['course'];
							$section = $_REQUEST['section'];
									if (empty ($sem) === true && empty($sy) === true && empty($course) === true){
										echo "<script>alert('select semester and school year');window.location.href='classSchedReport.php';</script>";
									}else if (empty ($sem) === true){
										echo "<script>alert('select semester');window.location.href='classSchedReport.php';</script>";
									}else if (empty ($sy) === true){
										echo "<script>alert('select school year');window.location.href='classSchedReport.php';</script>";
									}else if (empty ($course) === true){
										echo "<script>alert('select course');window.location.href='classSchedReport.php';</script>";
									}else if (empty ($section) === true){
										echo "<script>alert('select section');window.location.href='classSchedReport.php';</script>";
									}
								$query = mysql_query("SELECT DISTINCT class.sem, class.sy, class.course, section.section_desc, course.course_code FROM class,section,course WHERE class.section=section.section_id AND class.course=course.course_id AND class.sy='$sy' AND class.sem='$sem' AND class.course='$course'  AND class.section='$section' ") or die(mysql_error());
								$semsy = mysql_fetch_array($query);
						?>
						
						<table border="1" rules="all" cellpadding="10px">
<tr>
<td><b>Semester</b> : <?php echo $semsy['sem']; ?></td> 
<td><b>School Year</b> : <?php echo $semsy['sy']; ?></td>                 
<td><b>Course</b> : <?php echo $semsy['course_code']; ?></td>
<td><b>Section</b> : <?php echo $semsy['section_desc']; ?></td></tr>

						</table>
						<br/>
						<table border='1' rules='all' cellpadding='5px'>
							<thead>
								<tr>
									<th>Subject</th>
									
								
									<th>Start</th>
									<th>End</th>
									<th>Days</th>
									<th>Room</th>
									<th>Population</th>
									
								 
									<th>Status</th>
								</tr>
							</thead>
							<?php
								$query = mysql_query("SELECT DISTINCT class.sy, class.sem, class.course, class.in, class.out, class.days, class.size, class.Status, subject.subject_code, rooms.room_code, section.section_desc FROM class, subject, rooms, section WHERE class.scode=subject.subject_id AND class.room=rooms.room_id AND class.section=section.section_id AND class.sy='$sy' AND class.sem='$sem'  AND class.course='$course' AND class.section='$section' ") or die(mysql_error());
								$num=0;
								if(mysql_num_rows($query)>0){
									while($enrolled = mysql_fetch_assoc($query)){
									$num++;
							?>
							<tbody>
								
								<td align='center'><?php echo $enrolled['subject_code']; ?></td>
								
								
								<td><div align="center"><?php echo $enrolled['in']; ?></div></td>
								<td><div align="center"><?php echo $enrolled['out']; ?></div></td>
								<td><div align="center"><?php echo $enrolled['days']; ?></div></td>
								<td><div align="center"><?php echo $enrolled['room_code']; ?></div></td>
								<td><div align="center"><?php echo $enrolled['size']; ?></div></td>
								
							 
								<td><div align="center"><?php echo $enrolled['Status']; ?></div></td>
							</tbody>
							<?php
									}
								}else{
									echo "<script>alert('no record found');window.location.href='classSchedReport.php';</script>";
								}
							}else{?>
									<form action='classSchedReport.php' method='POST'>
									<!--this select to get semester-->
									<select name = 'sem'>
									<option value = '' selected>Semester</option>
										<?php
											$query = mysql_query('SELECT DISTINCT class.sem FROM class order by sem') or die(mysql_error());
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
											$query = mysql_query('SELECT DISTINCT class.sy FROM class order by sy') or die(mysql_error());
												if(mysql_num_rows($query)>0){ 
													while($data = mysql_fetch_array($query)) {
										?>
									<option value = '<?php echo $data['sy']?>'><?php echo $data['sy']?></option>
										<?php
													}
												}
										?>
									</select>

									<select name = 'course'>
									<option value = '' selected>Course</option>
										<?php
											$query = mysql_query('SELECT DISTINCT class.course, course.course_code FROM class,course WHERE class.course=course.course_id order by course') or die(mysql_error());
												if(mysql_num_rows($query)>0){ 
													while($data = mysql_fetch_array($query)) {
										?>
									<option value = '<?php echo $data['course']?>'><?php echo $data['course_code']?></option>
										<?php
													}
												}
										?>
									</select>

									<select name = 'section'>
									<option value = '' selected>Section</option>
										<?php
											$query = mysql_query('SELECT DISTINCT class.section, section.section_desc FROM class,section WHERE class.section=section.section_id ORDER BY section') or die(mysql_error());
												if(mysql_num_rows($query)>0){ 
													while($data = mysql_fetch_array($query)) {
										?>
									<option value = '<?php echo $data['section']?>'><?php echo $data['section_desc']?></option>
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
					<!--<?php //include("footer.php"); ?>
			</div>-->			
		
	</body>
</html>