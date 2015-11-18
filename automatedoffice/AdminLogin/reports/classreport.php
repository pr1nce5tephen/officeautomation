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
<link href="../../style.css" rel="stylesheet" type="text/css" />
	</head>
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
		<body>
		<center>
       <?php include('../../menu/nav2.php');?>

				
						<?php
						if(isset($_REQUEST['submit'])){
							$sem = $_POST['sem'];
							$sy = $_POST['sy'];
							$course = $_POST['course'];
							$section = $_POST['section'];
								
								$query = mysql_query("SELECT * FROM ascheds,course,sy WHERE ascheds.sy_id=sy.sy_id AND ascheds.course_id=course.course_id AND ascheds.sy_id='$sy' AND ascheds.sem='$sem' AND ascheds.course_id='$course' AND ascheds.section_id='$section' ") or die(mysql_error());
								$semsy = mysql_fetch_array($query);
						?>
						<p align="center"><input type="button" onClick=location.href="javascript:docprint()" value="Print"> <a href="classreport.php">Back</a></p>
			<div id="print_content">
				<center>
							<h2><u>Class Schedules</u></h2>
						<table border="1" rules="all" cellpadding="10px">
<tr>
<td><b>Semester</b> : <?php echo $semsy['sem']; ?></td> 
<td><b>School Year</b> : <?php echo $semsy['school_yr'].'-'.$semsy['school_yr2']; ?></td>                 
<td><b>Course</b> : <?php echo $semsy['course_code']; ?></td>
<td><b>Section</b> : <?php echo $semsy['section_id']; ?></td></tr>

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
									<th>Capacity</th>
									
								 
									<th>Status</th>
								</tr>
							</thead>
							<?php
							$query = mysql_query("SELECT * FROM ascheds,course,sy,subject,rooms WHERE ascheds.sy_id=sy.sy_id AND ascheds.course_id=course.course_id AND ascheds.subject_id=subject.subject_id AND ascheds.room_id=rooms.room_id AND ascheds.sy_id='$sy' AND ascheds.sem='$sem' AND ascheds.course_id='$course' AND ascheds.section_id='$section' ") or die(mysql_error());
								//$query = mysql_query("SELECT DISTINCT ascheds.sy_id, ascheds.size, ascheds.status, subject.subject_code, rooms.room_code, a_time.in, a_time.out, ascheds.monday, ascheds.tuesday, ascheds.wednesday, ascheds.thursday, ascheds.friday, ascheds.type FROM ascheds, a_time, subject, rooms, days WHERE ascheds.in=a_time.in AND ascheds.out=a_time.out AND ascheds.monday=days.monday AND ascheds.tuesday=days.tuesday AND ascheds.wednesday=days.wednesday AND ascheds.thursday=days.thursday AND ascheds.friday=days.friday AND ascheds.subject_id=subject.subject_id AND ascheds.room_id=rooms.room_id AND ascheds.sy_id='$sy' AND ascheds.sem='$sem' AND ascheds.course_id='$course' AND ascheds.section_id='$section' ") or die(mysql_error());
								$num=0;
								if(mysql_num_rows($query)>0){
									while($enrolled = mysql_fetch_assoc($query)){
									$num++;
							?>
							<tbody>
								
								<td align='center'><?php echo $enrolled['subject_code']; ?></td>
								<td><div align="center"><?php echo $enrolled['in'].''.$enrolled['type']; ?></div></td>
								<td><div align="center"><?php echo $enrolled['out'].''.$enrolled['type']; ?></div></td>
								<td><div align="center"><?php echo $enrolled['monday'].' '.$enrolled['tuesday'].' '.$enrolled['wednesday'].' '.$enrolled['thursday'].' '.$enrolled['friday'].' '.$enrolled['saturday'].' '.$enrolled['sunday']; ?></div></td>
								<td><div align="center"><?php echo $enrolled['room_code'].'/'.$enrolled['room_description']; ?></div></td>
								<td><div align="center"><?php echo $enrolled['pop']; ?></div></td>
								<td><div align="center"><?php echo $enrolled['size']; ?></div></td>
								<td><div align="center"><?php echo $enrolled['status']; ?></div></td>
							</tbody>
</center>
							<?php
									}
								}else{
									echo "<script>alert('no record found');window.location.href='classreport.php';</script>";
								}
							}else{?>
							<br/>
							<fieldset style="width:40%;"><legend>Search Options:</legend>
									<form action='classreport.php' method='POST'>
									<!--this select to get semester-->
									<select name = 'sem' required>
									<option value = '' selected>Semester</option>
										<?php
											$query = mysql_query('SELECT DISTINCT ascheds.sem FROM ascheds order by sem') or die(mysql_error());
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
									<select name = 'sy' required>
									<option value = '' selected>School Year</option>
										<?php
											$query = mysql_query('SELECT DISTINCT ascheds.sy_id, sy.school_yr, sy.school_yr2 FROM ascheds,sy WHERE ascheds.sy_id=sy.sy_id order by sy_id') or die(mysql_error());
												if(mysql_num_rows($query)>0){ 
													while($data = mysql_fetch_array($query)) {
										?>
									<option value = '<?php echo $data['sy_id']?>'><?php echo $data['school_yr'].'-'.$data['school_yr2']?></option>
										<?php
													}
												}
										?>
									</select>

									<select name = 'course' required>
									<option value = '' selected>Course</option>
										<?php
											$query = mysql_query('SELECT DISTINCT ascheds.course_id, course.course_code FROM ascheds,course WHERE ascheds.course_id=course.course_id order by course_id') or die(mysql_error());
												if(mysql_num_rows($query)>0){ 
													while($data = mysql_fetch_array($query)) {
										?>
									<option value = '<?php echo $data['course_id']?>'><?php echo $data['course_code']?></option>
										<?php
													}
												}
										?>
									</select>

									<select name = 'section' required>
									<option value = '' selected>Section</option>
										<?php
											$query = mysql_query('SELECT DISTINCT ascheds.section_id FROM ascheds ') or die(mysql_error());
												if(mysql_num_rows($query)>0){ 
													while($data = mysql_fetch_array($query)) {
										?>
									<option value = '<?php echo $data['section_id']?>'><?php echo $data['section_id']?></option>
										<?php
													}
												}
										?>
									</select>
									<input type = 'submit' name = 'submit' value = 'Search'>
									</form>
								</fieldset>
							<?php
							}
							?>
						</table>

			<center>
	</center>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
						<footer>
			<div class="section">
				<p>
				</p>
			</div>
			
			
			
		</footer>
						</body>
</html>