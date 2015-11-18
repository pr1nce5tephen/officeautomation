<?php
 include('../../config/connection.php');
	 require('../../auth.php');
	 include('../../config/sy.php');
 	confirm_logged_in();
 	check_level();
//require_once('ae/function.php');


if(isset($_REQUEST['delist'])) {		
		$enlistment_id = $_REQUEST['enlistment_id'];
		$classno	= $_REQUEST['classno'];
		$control_number	= $_REQUEST['control_number'];
		$sem		= $_REQUEST['sem'];
		$SY			= $_REQUEST['SY'];	
			mysql_query("DELETE FROM enroll WHERE enlistment_id= '$enlistment_id'") or die(mysql_error());				
			$get_class = mysql_query("SELECT * FROM bscheds WHERE sched_id = '$classno'");
			echo "<meta http-equiv='refresh' content='0; url=enlistment.php?submit=$submit&enlistment_id=$enlistment_id&classno=$classno&control_number=$control_number&sem=$sem&SY=$SY'><script>alert('Subject Removed')</script>";
			$class_info = mysql_fetch_assoc($get_class);
			$pop = $class_info['pop'] - 1;		
			mysql_query("UPDATE bscheds SET pop = '$pop' WHERE sched_id = '$classno'");	
			//size_and_population($classno);
	}

	if(isset($_REQUEST['enlist'])) {		
		$classno	= $_REQUEST['sched_id'];
		$subject_id = $_REQUEST['subject_id'];
		$control_number	= $_REQUEST['control_number'];
		$sem		= $_REQUEST['sem'];
		$SY			= $_REQUEST['SY'];
		$disable 	= 2;		
		$load = mysql_query("SELECT * FROM enroll WHERE sched_id = '$classno' AND control_number = '$control_number' ") or die(mysql_error());
		$available = mysql_query("SELECT * FROM bscheds WHERE sched_id= '$classno' AND status='full'") or die(mysql_error());
		
		$prereq = mysql_query("SELECT * FROM prerequisites WHERE subject_id='$subject_id' ");
		$getprereq=mysql_fetch_array($prereq);
		$prerequisite_id=$getprereq['prerequisite'];

		$sub=mysql_query("SELECT * FROM subject WHERE subject_id = '$prerequisite_id' ");
		$getsub=mysql_fetch_array($sub);
		$sub_code=$getsub['subject_code'];

		$sub2=mysql_query("SELECT * FROM subject WHERE subject_id='$subject_id'");
		$getsub2=mysql_fetch_array($sub2);
		$sub_code2=$getsub2['subject_code'];

		$check=mysql_query("SELECT * FROM enroll WHERE control_number='$control_number' AND subject_id='$prerequisite_id' ");
		$getcheck=mysql_fetch_array($check);
		$remark=$getcheck['remark'];

		if(mysql_num_rows($load) > 0) {
			echo" <script language='javascript'>
			alert('You are already enrolled in this subject!');
			</script>";
				echo "<meta http-equiv='refresh' content='0; url=enlistment.php?submit=$submit&control_number=$control_number&sem=$sem&SY=$SY' />";
		}

		else if(mysql_num_rows($available) > 0) {
				echo "<meta http-equiv='refresh' content='0; url=enlistment.php?submit=$submit&control_number=$control_number&sem=$sem&SY=$SY'> <script language='javascript'>
			alert('You cannot enrolled in this subject its already full!');
			</script>";
		} else {

			if(mysql_num_rows($prereq) > 0){
				if($prerequisite_id != none ){
					if(mysql_num_rows($check) > 0)
						{
						   if(!empty($remark) == true)
						   {
							if($remark == 'PASSED')
								{
									mysql_query("INSERT INTO enroll(sched_id, subject_id, control_number, sem, SY) VALUES('$classno', '$subject_id', '$control_number', '$sem', '$SY')") or die(mysql_error());	
									echo "<meta http-equiv='refresh' content='0; url=enlistment.php?submit=$submit&control_number=$control_number&sem=$sem&SY=$SY'/><script>alert('Subject Enlisted')</script>";
									
									$get_class = mysql_query("SELECT * FROM bscheds WHERE sched_id = '$classno'");
									
									$class_info = mysql_fetch_assoc($get_class);
									
									$pop = $class_info['pop'] + 1;
									
									mysql_query("UPDATE bscheds SET pop = '$pop' WHERE sched_id = '$classno'");
								}
							else if($remark == 'INC')
								{
									echo"<meta http-equiv='refresh' content='0; url=enlistment.php?submit=$submit&control_number=$control_number&sem=$sem&SY=$SY'/><script>alert('student $control_number dont have grade on $sub_code')</script>";
								}
								else
								{
									echo"<meta http-equiv='refresh' content='0; url=enlistment.php?submit=$submit&control_number=$control_number&sem=$sem&SY=$SY'/><script>alert('student $control_number must enroll and passed $sub_code before enlisting $sub_code2')</script>";
								}
							}
							else
								{
									echo"<meta http-equiv='refresh' content='0; url=enlistment.php?submit=$submit&control_number=$control_number&sem=$sem&SY=$SY'/><script>alert('student $control_number is still taking up $sub_code')</script>";
								}
								//
							
						}
						else
						{
							echo"<meta http-equiv='refresh' content='0; url=enlistment.php?submit=$submit&control_number=$control_number&sem=$sem&SY=$SY'/><script>alert('student $control_number must enroll and passed $sub_code before enlisting $sub_code2')</script>";
						}
				}else{
				mysql_query("INSERT INTO enroll(sched_id, subject_id, control_number, sem, SY) VALUES('$classno', '$subject_id', '$control_number', '$sem', '$SY')") or die(mysql_error());	
			echo "<meta http-equiv='refresh' content='0; url=enlistment.php?submit=$submit&control_number=$control_number&sem=$sem&SY=$SY'/><script>alert('Subject Enlisted')</script>";
			
			$get_class = mysql_query("SELECT * FROM bscheds WHERE sched_id = '$classno'");
			
			$class_info = mysql_fetch_assoc($get_class);
			
			$pop = $class_info['pop'] + 1;
			
			mysql_query("UPDATE bscheds SET pop = '$pop' WHERE sched_id = '$classno'");
				}
					
			}else{
			mysql_query("INSERT INTO enroll(sched_id, subject_id, control_number, sem, SY) VALUES('$classno', '$subject_id', '$control_number', '$sem', '$SY')") or die(mysql_error());	
			echo "<meta http-equiv='refresh' content='0; url=enlistment.php?submit=$submit&control_number=$control_number&sem=$sem&SY=$SY'/><script>alert('Subject Enlisted')</script>";
			
			$get_class = mysql_query("SELECT * FROM bscheds WHERE sched_id = '$classno'");
			
			$class_info = mysql_fetch_assoc($get_class);
			
			$pop = $class_info['pop'] + 1;
			
			mysql_query("UPDATE bscheds SET pop = '$pop' WHERE sched_id = '$classno'");
			}
		}
		//size_and_population($classno);
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
			<script language="javascript" src="../restriction.js" type="text/javascript"></script>
			
		</head>
		
		<body>
			
      <!--menu-->
       <?php include('../../menu/nav2.php');?>
       <br/>

<?php
						
					if(isset($_REQUEST['submit'])){
						$submit=$_REQUEST['submit'];
						$control_number = $_REQUEST['control_number'];
						$sem = $_REQUEST['sem'];
						$SY = $_REQUEST['SY'];
						
						$query = mysql_query("SELECT * FROM student,course WHERE course.course_id=student.course AND control_number = '$control_number' AND status = 'Active' LIMIT 1");
						if(mysql_num_rows($query) >0){
							while($stud_data = mysql_fetch_assoc($query)){
							echo "<center>";
							echo "<table class='menu_tab2' border='1' rules='all' width='90%'>";
							
							echo "<tr>
									<th colspan='7'><h2>STUDENT INFORMATION</h2></th>
									</tr>";
							echo "<tr align='center'>
									<th>Student ID</th>
									<th>Student Name</th>
									<th>Gender</th>
									<th>Course</th>
									<th>Year Level</th>
									<th>Birthdate</th>
									<th>Status</th>
								</tr>";
							echo "<tr align='center'>
									<td>$stud_data[control_number]</td>
									<td>$stud_data[lname], $stud_data[fname] $stud_data[mi]</td>
									<td>$stud_data[gender]</td>
									<td>$stud_data[course_code]</td>
									<td>$stud_data[yrlvl]</td>
									<td>$stud_data[birthdate]</td>
									<td>$stud_data[status]</td>
									</tr>";
							echo "</table>";														
							echo "<br />";
							
							echo "<table class='menu_tab2' border='1' rules='all' width='90%'>";
							echo "<tr>
									<th colspan='7'><h2>ENLISTED SUBJECTS</h2></th>
									</tr>";
							echo "<tr>
									<th>Subject Code</th>
									<th>Description</th>
									<th>Time</th>
									<th>Days</th>									
									<th>Room</th>
									<th>Units</th>
									<th>Action</th>
									</tr>";
							
							$en_query = mysql_query("SELECT DISTINCT * FROM enroll JOIN bscheds JOIN subject JOIN rooms WHERE enroll.sched_id = bscheds.sched_id AND bscheds.subject_id = subject.subject_id AND control_number = '$control_number'   AND bscheds.sem = '$sem' AND bscheds.room_id = rooms.room_id") or die(mysql_error());							
							$units = 0;								
								while($en_data = mysql_fetch_assoc($en_query)) {
									
									echo "<form action='enlistment.php' action='POST'>";
									echo "<input type='hidden' name='enlistment_id' value='$en_data[enlistment_id]'>";
									echo "<input type='hidden' name='classno' value='$en_data[sched_id]'>";
									echo "<input type='hidden' name='control_number' value='$control_number'>";
									echo "<input type='hidden' name='sem' value='$sem'>";
									echo "<input type='hidden' name='SY' value='$SY'>";
								
									echo "<tr align='center'>
											<td>$en_data[subject_code]</td>
											<td>$en_data[subject_desc]</td>
											<td> $en_data[in] $en_data[out] $en_data[type] </td>
											<td>$en_data[monday] $en_data[tuesday] $en_data[wednesday] $en_data[thursday] $en_data[friday] $en_data[saturday] $en_data[sunday]</td>
											<td>$en_data[room_description]</td>
											<td>$en_data[subject_units]</td>
											
											<td><input class='button' type='submit' name='delist' value='Remove'></td>	
											</tr>";	
											$units = $units + $en_data['subject_units']; 
									
									echo "</form>";
							
							}	
							echo "<tr align='center'><td colspan='7'> Total number of Units : $units</td></tr>";	
						
							echo "</table>";
							
							echo "<br />";
							
							
							echo "<table class='menu_tab2' border='1' rules='all' width='90%'>";
							echo "<tr>
									<th colspan='8'><h2>OFFERED SUBJECTS</h2></th>
									</tr>";
							echo "<tr>
									<th>Section</th>
									<th>Subject Code</th>
									<th>Description</th>
									<th>Time</th>
									<th>Days</th>
									<th>Room</th>
									<th>Population</th>									
									<th>Action</th>
								</tr>";
							
							$class_query = mysql_query("SELECT * FROM bscheds JOIN subject JOIN rooms WHERE bscheds.subject_id = subject.subject_id AND bscheds.room_id=rooms.room_id AND sem='$sem' AND sy_id='$SY'") or die(mysql_error());
							
							while($class_data = mysql_fetch_assoc($class_query)) {
								
								echo "<form action='enlistment.php' action='POST'>";
								
								echo "<input type='hidden' name='sched_id' value='$class_data[sched_id]'>";
								echo "<input type='hidden' name='subject_id' value='$class_data[subject_id]'>";
								echo "<input type='hidden' name='control_number' value='$control_number'>";
								echo "<input type='hidden' name='sem' value='$sem'>";
								echo "<input type='hidden' name='SY' value='$SY'>";
								
								
								echo "<tr align='center'>
										<td>$class_data[section_id]</td>
										<td>$class_data[subject_code]</td>
										<td>$class_data[subject_desc]</td>
										<td> $class_data[in]-$class_data[out] $class_data[type] </td>
										<td>$class_data[monday] $class_data[tuesday] $class_data[wednesday] $class_data[thursday] $class_data[friday] $class_data[saturday] $class_data[sunday]</td>
										<td>$class_data[room_description]</td>
										<td>$class_data[pop] / $class_data[size]</td>
										
										<td><input class='button' type='submit' name='enlist' value=' Enlist '></td>	
									</tr>";
								echo "</form>"; 
							}		
							echo "</table>";
							echo"</center>";
							}
						}
						else{
						echo "<script language='javascript'>alert('No Record  Found or  Not Enrolled or Student is not Active')</script>
						<meta http-equiv = 'refresh' content='0; url=enlistment.php' />";
						}
					}
					//}
					//}	
?>

<br>
	<center>
	<form action='enlistment.php' method='POST'>
						<select name = "sem">
						<option value = "" selected>Semester</option>
							<?php
								$query = mysql_query("SELECT DISTINCT bscheds.sem FROM bscheds order by sem") or die(mysql_error());
									if(mysql_num_rows($query)>0){ 
										while($data = mysql_fetch_array($query)) {
							?>
						<option value = "<?php echo $data['sem']?>"><?php echo $data['sem']?></option>
							<?php
										}
									}
							?>
						</select>
						<!--this select to get school year-->
						<select name = "SY">
						<option value = "" selected>School Year</option>
							<?php
								$query = mysql_query("SELECT DISTINCT sy.school_yr,sy.school_yr2,sy.sy_id FROM sy WHERE sy_stat='active' order by sy_id") or die(mysql_error());
									if(mysql_num_rows($query)>0){ 
										while($data = mysql_fetch_array($query)) {
							?>
						<option value = "<?php echo $data['sy_id']?>"><?php echo $data['school_yr'].'-'.$data['school_yr2']?></option>
							<?php
										}
									}
							?>
						</select>
						
						<input type='text' name='control_number' onkeyup="checkInput2(this)" placeholder='Enter Control Number'>
						<input class='button' type='submit' name='submit' value='SUBMIT'>
						</form>
						</center>
						<br>
					


		
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