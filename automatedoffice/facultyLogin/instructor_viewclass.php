<?php
/*require_once('../auth.php');
 include('../config/sy.php');
//require_once('../initialize.php');*/
include('../menu/nav3.php');
session_start();

if(isset($_SESSION['userid'])){
	$id = $_SESSION['userid'];
}
if(isset($_REQUEST['viewstudents'])){
	$classid = $_REQUEST['viewstudents'];
	$_SESSION['classno'] =$classid;
	$queryclass =mysql_query("SELECT * FROM schedules,subject WHERE schedules.sched_id='$classid' AND schedules.subject_id=subject.subject_id ") or die(mysql_error());
	$class = mysql_fetch_array($queryclass);
}

?>
<html>

	
	<form action='index.php' name='room' method='POST'>
	</head>
	<form action='instructor_class.php' method='POST'>
	<body>
		
	
	</form>
		
<?php
	$instractor_id = $_SESSION['userid'];
	$query = mysql_query("SELECT * FROM faculty WHERE fcode = '$instractor_id' ") or die(mysql_error());
	$instructor = mysql_fetch_assoc($query);
	$complete_name = $instructor['fname']." ".$instructor['mi']." ".$instructor['lname']	;
									//echo $complete_name;
?>
					<br>
					<center/>
					
							<form  action="instructor_class.php" method="POST">
							<table rules="all" border ="1" width="95%" class='menu_tab2'>
								<tr>
									<th colspan="11"><h2><?php echo $class['subject_code']."  ".$class['subject_desc']?></h2></th>
								</tr>
								<tr>
									<th colspan = "3">Student</th>
									<th colspan = '4'>Term Grades</th>
									<th rowspan = "2">Subject Grade</th>
									<th rowspan = "2">Equivalent</th>
									<th rowspan = "2">Remarks</th>
									<th rowspan = "2">ACTION</th>
								</tr>
								<tr>
									<th width = "100px">Last Name</th>
									<th width = "100px">First Name</th>
									<th width = '100px'>MI. </th>
									<th>Prelim</th>
									<th>Midterm</th>
									<th>PreFinal</th>
									<th>Final</th>
								</tr>
							</form>
							
								<?php
								$PASSED = 0;
								$FAILED = 0;
								$INC = 0;
								$query = mysql_query("SELECT * FROM enroll,student WHERE enroll.sched_id = '$classid' AND student.control_number = enroll.control_number");
									$count = mysql_num_rows($query);
									if($count > 0){
										while($info = mysql_fetch_array($query)){

								?>
								<tr>
									<td align='center'><?php echo $info['lname']; ?></td>
									<td align='center'><?php echo $info['fname']; ?></td>
									<td align='center'><?php echo $info['mi']; ?></td>
									<td align='center'><?php echo $info["pgrade"]; ?></td>
									<td align='center'><?php echo $info["mgrade"]; ?></td>
									<td align='center'><?php echo $info["sfgrade"]; ?></td>
									<td align='center'><?php echo $info["fgrade"]; ?></td>
									
									<td align='center'><?php echo $info["grade"]; ?></td>
									<td align='center'><?php echo $info["equiv"];?></td>
									<td align='center'><?php echo $info["remark"]; ?></td>

									<!--<td align='center'><a href='grade.php?control_number=<?php echo $info['control_number'];?>'>Grade</a></td>-->
									<td align='center'>
									
									<?php /*
										if ($info["remark"] == "PASSED"){
											$PASSED++;		
										}else if ($info["remark"] == "FAILED"){
											$FAILED++;
										}else{
											$INC++;
										}*/
									?>	

										<form action = 'grade.php' method = 'POST'>
										<br/>
											<input type="hidden" name="hidden" value = "<?php echo $info['control_number']; ?>">
											<input type = "submit" value = "Submit Grade" />
										</form>
									</td>
								</tr>
								<?php
										} 
									}else{
										echo"<tr>
											<td align='center' colspan = '11'><b>No Record Found</b></td>
										</tr>";
									}
								?>
							</table>
					
						<?php/* 
							$fpass =($PASSED/$count)*100;
							echo "PASSED: ".$fpass."%<br>"; 
							$ffail =($FAILED/$count)*100;
							echo "FAILED: ".$ffail."%<br>"; 
							$finc =($INC/$count)*100;
							echo "INC: ".$finc."%"; */
						?>

						<ul>
							<br/>
							<li>
								<a style="text-decoration:none;" href = "instructor_class.php"><button>Back</button></a>
							</li>
						</ul>
					<br/>
<footer>
			<div class="section">
				<p>
				</p>
			</div>
			
			
			
		</footer>	
	
		<p style="text-align: center; padding: 0px;"></p>
</body>

