<?php
	require_once('../../auth.php');
	require_once('../../initialize.php');
	confirm_logged_in();
?>
<head>
		<title>Payment Report</title>
		<link href="report.css" rel="stylesheet" type="text/css" />
		
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
	<div id="container" >
		<p align="center"><input type="button" onClick=location.href="javascript:docprint()" value="Print"></p>

		<div id="print_content">
			
			
				<?php
					include("header.php");
					
					echo "<center>";
						if(isset($_REQUEST['action'])){
							$action = $_REQUEST['action'];
							$contribID = $_REQUEST['contribID'];
							$contribution = mysql_query("SELECT * FROM contribution where contribID=$contribID");
							$fetchcontrib = mysql_fetch_assoc($contribution);
							if($action == "all"){
								echo "<strong><h1>List of all students for the contribution in $fetchcontrib[contribDesc]<br></strong></h1>";
								$course = mysql_query("SELECT * from course order by course_code asc");
								while($fetchcourse = mysql_fetch_assoc($course)){
									$students=mysql_query("SELECT * FROM studentcontribution INNER JOIN student ON studentcontribution.StudID = student.control_number inner join course on student.course = course.course_id WHERE contribID ='$contribID' and course_code='$fetchcourse[course_code]' order by lname asc");
									echo"
									<table rules='all' width='45%'  border='1'>
										<tr>
											<th colspan=5><h3>$fetchcourse[course_code]</h3></th>

										</tr>

										<tr>
											<th>Student ID</th>
											<th>Lastname</th>
											<th>Firstname</th>
											<th>Middle Initial</th>
											<th>Status</th>
										</tr>";
										while ($fetchstudent = mysql_fetch_assoc($students))
										{
											echo"
												<tr>
													<td>
														$fetchstudent[control_number]
													</td>
													<td>$fetchstudent[lname]</td>
													<td>$fetchstudent[fname]</td>
													<td>$fetchstudent[mi]</td>";
													$query=mysql_query("SELECT * FROM payments where contribID='$contribID'and studID='$fetchstudent[StudID]'");
													if($fetchquery = mysql_fetch_assoc($query)){
														echo"
															<td>Paid</td>";
													}
													else{
														echo"
															<td>Unpaid</td>";
													}
										}

									echo"</table>";
									echo"<br/>";
								}
							}

							if($action=="paid"){
								echo "<strong><h1>$fetchcontrib[contribDesc]<br></strong></h1>";
								echo "<strong><h2>List of paid student</strong></h2>";
								$course = mysql_query("SELECT * from course order by course_code asc");
								$total=mysql_query("SELECT sum(amount) FROM payments WHERE contribID ='$contribID'");
								$gettotal=mysql_fetch_array($total);
								while($fetchcourse = mysql_fetch_assoc($course)){
									$students=mysql_query("SELECT * FROM payments INNER JOIN student ON payments.studID = student.control_number inner join course on student.course = course.course_id WHERE contribID ='$contribID' and course_code='$fetchcourse[course_code]' order by lname asc");
									
									echo"
									<br>
									<table rules='all' width='45%'  border='1'>
										<tr>
											<th colspan=5>$fetchcourse[course_code]</th
										</tr>
										<tr>
											<th>Control Number</th>
											<th>Lastname</th>
											<th>Firstname</th>
											<th>Middle Initial</th>
											<th>Amount</th>
										</tr>";
										while ($fetchstudent = mysql_fetch_assoc($students))
										{
											echo"
												<tr>
													<td>
														$fetchstudent[control_number]
													</td>
													<td>$fetchstudent[lname]</td>
													<td>$fetchstudent[fname]</td>
													<td>$fetchstudent[mi]</td>
													<td>$fetchstudent[amount]</td>
													
													</tr>";
										}

									echo"
									</table>";
								}
								 echo"<h3>Total amount collected in $fetchcontrib[contribDesc] <i><u> P$gettotal[0].00</u></i></h3>";
							}

							if($action=="unpaid"){
								echo "<strong><h1>$fetchcontrib[contribDesc]<br></strong></h1>";
								echo "<strong><h2>List of Unpaid Students</strong></h2>";
								$course = mysql_query("SELECT * from course order by course_code asc");
								while($fetchcourse = mysql_fetch_assoc($course)){

									$students=mysql_query("SELECT * FROM studentcontribution INNER JOIN student ON studentcontribution.StudID = student.control_number inner join course on student.course = course.course_id WHERE contribID ='$contribID' and course_code='$fetchcourse[course_code]' order by lname asc");
									
									echo"
									<br>
									<table rules='all' width='45%' border='1'>
										<tr>
											<th colspan=5>$fetchcourse[course_code]</th
										</tr>
										<tr>
											<th>Student ID</th>
											<th>Lastname</th>
											<th>Firstname</th>
											<th>Middle Initial</th>

										</tr>";
										while ($fetchstudent = mysql_fetch_assoc($students))
										{
											$query=mysql_query("SELECT * FROM payments where contribID='$contribID'and studID='$fetchstudent[control_number]'");
											if(!($fetchquery=mysql_fetch_assoc($query))){
												echo"
												<tr>
													<td>
														$fetchstudent[control_number]
													</td>
													<td>$fetchstudent[lname]</td>
													<td>$fetchstudent[fname]</td>
													<td>$fetchstudent[mi]</td>";
											}
											
										}

									echo"
									</table>";
								}
							}
						} 
					
					echo "</center>";
					include("footer.php");
				?>
		</div>
	</div>
</body>
