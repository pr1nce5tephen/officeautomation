<?php
	require_once('../../auth.php');
	require_once('../../initialize.php');
	include('../../config/sy.php');
	confirm_logged_in();
	check_level();
?>
<html>
	<head>
		<title>
			Payments
		</title>
	<link href="../../style.css" rel="stylesheet" type="text/css" />
	</head>
	<form action='index.php' method='POST'>
	<body>
		
	</form>
		
		
		
						<?php include('../../menu/nav2.php');?>
					
					<br>
					
						<center>
							<!-- <form action = 'paymentfunc.php' method = 'POST'>
							<td>
										<select name = "search">
										<option value="none">-Select-</option>
										<option value="studID">Student ID</option>
										<option value="contribDesc">Description</option>
										<option value="stamp">Year</option>
										<option value="view">View All</option>
							</td>
						<input type = "text" name="search_input" placeholder='Search Payment...' >
						<input type = "submit" name="submitSearch" value="SEARCH">
						</form> -->
						<br />
						
										<?php	
											//for editing!!
											if(isset($_GET['edit'])){
												$entryID = $_GET['edit'];
												$record = mysql_query("SELECT * FROM payments WHERE entryNum = '$entryID'");
												$data = mysql_fetch_assoc($record);
												
												echo" 
													<form method='GET' action ='paymentfunc.php'>
													<center>
													<table class='menu_tab2' rules='all' width='90%'  border='1'>
														<tr>
															<td><b> Entry ID </td>
															<td>$data[entryNum] <input type = 'hidden' name = 'entryID' value = '$data[entryNum]' ></td>
														</tr>
														<tr>
															<td><b>Contribution ID </td>
															<td><input type = 'text' name = 'contribID' value = '$data[contribID]' ></td>
														</tr>
														<tr>
															<td><b> Student ID</td>
															<td><input type = 'text' name = 'studID' value = '$data[studID]' ></td>
														</tr>
														<tr>
															<td><b>Amount </td>
															<td><input type = 'text' name = 'amount' value = '$data[amount]' ></td>
														</tr>
														<tr>
															<td colspan = '2' align='center'><input type = 'submit' name = 'update' value = 'UPDATE' ></td>
														</tr>
														</form>				
												
												";
													
											}
											
											if(isset($_GET['update'])){
												$entryNum = $_GET['entryID'];
												$contribID = $_GET['contribID'];
												$studID = $_GET['studID'];		
												$amount = $_GET['amount'];		
												
												mysql_query("UPDATE payments SET contribID = '$contribID', studID = '$studID', amount = '$amount' WHERE entryNum='$entryNum'") or die (mysql_error());
													
												echo"DATA UPDATED! <br> Redirecting page.... please wait";
												echo"<meta http-equiv = 'refresh' content='3; url=payment.php' />";
													
											}
											
											if(isset($_REQUEST['delete'])){
												$entryNum = $_REQUEST['delete'];
												mysql_query("DELETE FROM payments WHERE entryNum ='$entryNum'") or die (mysql_error());
												echo"DATA DELETED!  <br> Redirecting page.... please wait";
												echo"<meta http-equiv = 'refresh' content='3; url=payment.php' />";
												
											}
											
											//searching
											
											if(isset($_POST['submitSearch'])){
																$search_input = $_POST['search_input'];
																$search = $_POST['search'];
																
														if(strcmp($search,'studID')==0)
																{
																	$result = mysql_query("SELECT * FROM payments JOIN contribution JOIN student WHERE contribution.contribID=payments.contribID AND payments.studID=student.StudID AND payments.studID = '$search_input' ") or die(mysql_error());
																	$num_rows = mysql_num_rows($result); 
																	
																	if($num_rows>0){
																				echo"	<center>
																				<table class='menu_tab2' rules='all' width='90%'  border='1'>
																			
																				<th>Contribution Name</th>
																				<th>Student ID</th>
																				<th>Student Name</th>
																				<th>Amount</th>
																				<th>Stamp</th>
																				<th>Balance</th>";
																			 
																			 while($payment_rec = mysql_fetch_assoc($result)) {
																				 
																				 $balance = $payment_rec['contribAmount'] - $payment_rec['amount'];
																				 
																			echo"	<tr>
																							<td>$payment_rec[contribDesc]</td>
																							<td>$payment_rec[studID]</td>
																							<td>$payment_rec[StudLName], $payment_rec[StudFName] $payment_rec[StudMName] </td>
																							<td>$payment_rec[amount]</td>
																							<td>$payment_rec[stamp]</td>
																							<td>$balance</td>";
																							
																							
																			echo"	<tr>";
															
																		}
																		echo"</table>";
																	}
																	else{
																		echo "No match found!";
																		
																	}
																
														}
																	
														else if(strcmp($search,'contribDesc')==0)
																{
																		$result = mysql_query("SELECT * FROM contribution JOIN payments JOIN student WHERE contribution.contribID=payments.contribID AND payments.studID=student.StudID AND contribution.contribDesc = '$search_input' ") or die(mysql_error());
																	$num_rows = mysql_num_rows($result); 
																	
																	if($num_rows>0){
																				echo"	<center>
																				<table class='menu_tab2' rules='all' width='90%'  border='1'>
																			
																				<th>Contribution Name</th>
																				<th>Student ID</th>
																				<th>Student Name</th>
																				<th>Amount</th>
																				<th>Stamp</th>
																				<th>Balance</th>";
																			 
																			 while($payment_rec = mysql_fetch_assoc($result)) {
																				 
																				 $balance = $payment_rec['contribAmount'] - $payment_rec['amount'];
																				 
																			echo"	<tr>
																							<td>$payment_rec[contribDesc]</td>
																							<td>$payment_rec[studID]</td>
																							<td>$payment_rec[StudLName], $payment_rec[StudFName] $payment_rec[StudMName] </td>
																							<td>$payment_rec[amount]</td>
																							<td>$payment_rec[stamp]</td>
																							<td>$balance</td>";
																							
																							
																			echo"	<tr>";
															
																		}
																		echo"</table>";
																	}
																	else{
																		echo "No match found!";
																		
																	}
																
														}
														
														
														
														else if(strcmp($search,'stamp')==0)
																{
																	$result = mysql_query("SELECT * FROM payments JOIN contribution JOIN student WHERE payments.stamp LIKE '%$search_input%' AND payments.contribID =contribution.contribID AND payments.studID=student.StudID ") or die(mysql_error());
																	$num_rows = mysql_num_rows($result); 
																	
																	if($num_rows>0){
																				echo"	<center>
																				<table class='menu_tab2' rules='all' width='90%'  border='1'>
																			
																				<th>Contribution Name</th>
																				<th>Student ID</th>
																				<th>Student Name</th>
																				<th>Amount</th>
																				<th>Stamp</th>
																				<th>Balance</th>";
																			 
																			 while($payment_rec = mysql_fetch_assoc($result)) {
																				 $balance = $payment_rec['contribAmount'] - $payment_rec['amount'];
																			echo"	<tr>
																							<td>$payment_rec[contribDesc]</td>
																							<td>$payment_rec[studID]</td>
																							<td>$payment_rec[StudLName], $payment_rec[StudFName] $payment_rec[StudMName] </td>
																							<td>$payment_rec[amount]</td>
																							<td>$payment_rec[stamp]</td>
																							<td>$balance</td>
																						<tr>";
																		}
																		echo"</table>";
																	}
																	else{
																		echo "No match found!";
																	}
														}
														else if(strcmp($search,'view')==0)
																{
																	$result = mysql_query("SELECT * FROM payments JOIN contribution JOIN student WHERE payments.contribID =contribution.contribID AND payments.studID=student.StudID ") or die(mysql_error());
																	$num_rows = mysql_num_rows($result); 
																	
																	if($num_rows>0){
																				echo"	<center>
																				<table class='menu_tab2' rules='all' width='90%'  border='1'>
																			
																				<th>Contribution Name</th>
																				<th>Student ID</th>
																				<th>Student Name</th>
																				<th>Amount</th>
																				<th>Stamp</th>
																				<th>Balance</th>";
																			 
																			 while($payment_rec = mysql_fetch_assoc($result)) {
																				 
																				 $balance = $payment_rec['contribAmount'] - $payment_rec['amount'];
																				 
																			echo"	<tr>
																							<td>$payment_rec[contribDesc]</td>
																							<td>$payment_rec[studID]</td>
																							<td>$payment_rec[StudLName], $payment_rec[StudFName] $payment_rec[StudMName] </td>
																							<td>$payment_rec[amount]</td>
																							<td>$payment_rec[stamp]</td>
																							<td>$balance</td>
																					<tr>";
															
																		}
																		echo"</table>";
																	}
																	else{
																		echo "No match found!";
																		
																	}
																
														}
														else{
															echo"Please choose an option!";
														}
														
											}
																
											//for paying!
											
												if(isset($_REQUEST['add'])){
												$contribID = $_REQUEST['add'];
												$amount = $_REQUEST['amount'];
													
													// echo" 
													// 	<form method='POST' action ='paymentfunc.php'>
													// 	<center><br>
													// 	<table class='menu_tab2'>
													// 		<tr>
													// 			<td></td>
													// 			<td><input type = 'hidden' name = 'contribID' value ='$contribID'></td>
													// 		</tr>
													// 		<tr>
													// 			<td><b>Student ID</td>
													// 			<td><input type = 'text' name = 'studID'></td>
													// 		</tr>
													// 		<tr>
													// 			<td><b>Amount</td>
													// 			<td><input type = 'year' name = 'amount'></td>
													// 		</tr>
													// 		</table>
													// 			<input type = 'submit' name = 'save' value = 'OK' ></td>
													// 			<input type = 'submit' name = 'cancel' value = 'CANCEL' ></td>
													// 	</form>";
													$students=mysql_query("SELECT * FROM studentcontribution INNER JOIN student ON studentcontribution.StudID = student.control_number inner join course on student.course = course.course_id WHERE contribID ='$contribID'");
													//$students=mysql_query("SELECT * FROM studentcontribution JOIN student JOIN course WHERE studentcontribution.StudID = student.control_number AND student.course = course.course_id AND contribID ='$contribID'");
													echo"

															<table class='menu_tab2' rules='all' width='90%'  border='1'>
																<tr>
																	<th>Control Number</th>
																	<th>Lastname</th>
																	<th>Firstname</th>
																	<th>Course</th>
																	<th>Pay</th>

																</tr>";
																while ($fetchstudent = mysql_fetch_assoc($students))
																{
																	echo"
																		<tr align='center'>
																			<td>
																				$fetchstudent[control_number]
																			</td>
																			<td>$fetchstudent[lname]</td>
																			<td>$fetchstudent[fname]</td>
																			<td>$fetchstudent[course_code]</td>";

																			$query=mysql_query("SELECT * FROM payments where contribID='$contribID'and studID='$fetchstudent[control_number]'");
																			if($fetchquery = mysql_fetch_assoc($query)){
																				echo"
																					<td><a style='text-decoration:none;' href='paymentfunc.php?unpay&add=$contribID&amount=$amount&studID=$fetchstudent[control_number]'><input class='button2' type='button' name='unpay' value='PAID' disabled/></a></td>
																				";
																			}
																			else
																			{
																				echo"
																					<td><a style='text-decoration:none;'  href='paymentfunc.php?pay&add=$contribID&amount=$amount&studID=$fetchstudent[control_number]'><input class='button' type='button' name='pay' value='PAY' /></a></td>
																				";
																			}
																}

													echo"
															</table>
													";
	
												}
												function random_numbers( $length = 8 ) {
													$chars = "0123456789";
													$password = substr( str_shuffle( $chars ), 0, $length );
														return $password;
																			}	

												if(isset($_REQUEST['pay'])){
													$contribID=$_REQUEST['add'];
													$studID = $_REQUEST['studID'];
													$amount = $_REQUEST['amount'];
													$orno 	= random_numbers(8);

													mysql_query("INSERT into payments(entryNum,contribID,studID,amount,ornum,stamp)VALUES ('','$contribID', '$studID', '$amount', 'WLC$orno',NOW())") or die(mysql_error());
													echo"<meta http-equiv = 'refresh' content='0; url=receipt.php?add=$contribID&amount=$amount&studID=$studID' />";
												}

												if(isset($_REQUEST['unpay'])){
													$contribID=$_REQUEST['add'];
													$studID = $_REQUEST['studID'];
													$amount = $_REQUEST['amount'];

													mysql_query("DELETE from payments where contribID='$contribID' and studID='$studID'");
													echo"<meta http-equiv = 'refresh' content='0; url=paymentfunc.php?add=$contribID&amount=$amount' />";
												}

												
												
												//cancelling!!
												if(isset($_REQUEST['cancel'])){
													echo"<meta http-equiv = 'refresh' content='0; url=contribution.php' />";
												}
												
												if(isset($_REQUEST['save'])){
													$contribID = $_REQUEST['contribID'];
													$studID = $_REQUEST['studID'];
													$amount = $_REQUEST['amount'];
												
															
														$record = mysql_query("SELECT * FROM payments WHERE studID = '$studID' and contribID='$contribID' ") or die(mysql_error());
														$data = mysql_fetch_assoc($record);
														$num_rows = mysql_num_rows($record);
														
														$student = mysql_query("SELECT * FROM student WHERE StudID = '$studID'") or die(mysql_error());
														$stud = mysql_fetch_assoc($student);
														$studnum = mysql_num_rows($student);
														
														
														$details = mysql_query("SELECT * FROM contribution WHERE contribID='$contribID' ") or die(mysql_error());
														$amt = mysql_fetch_assoc($details);
														$amnum_rows = mysql_num_rows($details);
															
														 if (is_numeric($amount) && $amount>=0) {
																if($studnum > 0 ){
																		if ($num_rows > '0'){
																			$balance = $data['amount'] + $amount;
																			
																			 if($data['amount'] == $amt['contribAmount']) {
																				echo "Sorry but this student is already done paying  <br> Redirecting page.... please wait";	
																			 }
																			else if ($amount > $amt['contribAmount']){
																				echo "Sorry but the entered amount exceeds the contribution amount ";
																			 }
																			else if ($balance > $amt['contribAmount']){
																				echo "Sorry but the entered amount exceeds the balance of the student ";
																			 }
																			 else{
																					$total = $data['amount'] + $amount;
																				mysql_query("UPDATE payments SET amount = '$total' WHERE studID = '$studID' and contribID='$contribID' ") or die (mysql_error());
																				mysql_query("UPDATE contribution SET status = '1' WHERE contribID='$contribID' ") or die (mysql_error());
																				echo"Paid successfully!  <br> Redirecting page.... please wait";
																				echo"<meta http-equiv = 'refresh' content='2; url=contribution.php' />";
																			}
																		}
																		
																		else if($amount > $amt['contribAmount']){
																			echo"Sorry but the entered amount exceeds the contribution amount";
																		}
																		
																		else{
																			mysql_query("INSERT into payments(entryNum,contribID,studID,amount,stamp)VALUES ('','$contribID', '$studID', '$amount',NOW())") or die(mysql_error());
																			mysql_query("UPDATE contribution SET status = '1' WHERE contribID='$contribID' ") or die (mysql_error());
																			echo"Paid successfully!  <br> Redirecting page.... please wait";
																			echo"<meta http-equiv = 'refresh' content='2; url=contribution.php' />";
																		}
																}
																else{
																	echo "Student ID doesn't exist.";
																}
														}
														
														else{
															echo "invalid input!";
														}
															
												}
												
												//viewing
												
												if(isset($_GET['view'])){
												$contribID= $_GET['view'];
												
												echo" 
													<center>
													<table class='menu_tab2' rules='all' width='90%'  border='1'>
												
													<th>Contribution Name</th>
													<th>Student ID</th>
													<th>Student Name</th>
													<th>Amount</th>
													<th>Date Paid</th>";
													//<th>Balance</th>
												
												 $record = mysql_query("SELECT * FROM payments JOIN contribution JOIN student WHERE contribution.contribID=payments.contribID AND payments.studID=student.control_number AND payments.contribID = '$contribID'");
												 
												 while($payment_rec = mysql_fetch_assoc($record)) {
													 
													 $balance = $payment_rec['contribAmount'] - $payment_rec['amount'];
													 
												echo"	<tr>
															  <td align='center'>$payment_rec[contribDesc]</td>
															  <td align='center'>$payment_rec[studID]</td>
															  <td align='center'>$payment_rec[lname], $payment_rec[fname] $payment_rec[mi] </td>
															  <td align='center'>$payment_rec[amount]</td>
															  <td align='center'>$payment_rec[stamp]</td>
															  
															<tr>";
											}
											echo"</table>";
											}
											
										?>
					
					<center/>
					<ul>
							<form action="contribution.php">
							<li>
								<a href='contribution.php'><button class='button'>Back</button></a>
							</li>
						</form>
						</ul>
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