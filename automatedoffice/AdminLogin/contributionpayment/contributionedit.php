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
			Contribution
		</title>
	<link href="../../style.css" rel="stylesheet" type="text/css" />
	</head>
	<form action='index.php' method='POST'>
	<body>
		
	</form>	
		
		 <?php include('../../menu/nav2.php');?>
		
					<br>
					
					<?php	
							//for editing!!
							if(isset($_REQUEST['edit'])){
								$contribID = $_REQUEST['edit'];
								$record = mysql_query("SELECT * FROM contribution WHERE contribID = '$contribID'");
								$data = mysql_fetch_assoc($record);
								if(isset($_POST['status'],$_POST['contribID'],$_POST['contribDesc'],$_POST['contribAmount'],$_POST['contribSem'], $_POST['contribYear']))
								{
									$contribID = $_POST['contribID'];
									$contribDesc = $_POST['contribDesc'];
									$contribAmount = $_POST['contribAmount'];
									$contribSem = $_POST['contribSem'];
									$contribYear = $_POST['contribYear'];
									$status = $_POST['status'];
									
								}
								else{
									$contribID = $data['contribID'];
									$contribDesc = $data['contribDesc'];
									$contribAmount = $data['contribAmount'];
									$contribSem = $data['contribSem'];
									$contribYear = $data['contribYear'];
									$status = $data['status'];
								}


								
								echo" 
									<form method='POST' action ='contributionedit.php?edit'>
									<center>
									<table class='menu_tab2' rules='all' width='30%'  border='1'>
										<tr>
											<td><b> contribution ID </td>
											<td>$contribID <input type = 'hidden' name = 'contribID' value = '$contribID' ></td>
										</tr>
										<tr>
											<td><b> Description</td>
											<td><input type = 'text' name = 'contribDesc' value = '$contribDesc' required></td>
										</tr>
										<tr>
											<td><b>Amount </td>
											<td><input type = 'text' name = 'contribAmount' value = '$contribAmount' required></td>
										</tr>
										<tr>
											<td><b>Semester</td>
											<td>
												<select name = 'contribSem'>
												<option value='$contribSem'>$contribSem</option>";
												if($contribSem=='summer'){
													echo"<option value='1st Sem'>1st Sem</option>
														 <option value='2nd Sem'>2nd Sem</option>";
												}
												else if($contribSem=='1st semester'){
													echo"<option value='summer'>summer</option>
														 <option value='2nd Sem'>2nd Sem</option>";
												}
												else if($contribSem=='2nd semester'){
													echo"<option value='summer'>summer</option>
														 <option value='1st Sem'>1st Sem</option>";
												}
												else{
													echo"<option value='summer'>summer</option>
														 <option value='1st Sem'>1st Sem</option>
														 <option value='2nd Sem'>2nd Sem</option>";
												}
										echo"</td>
										</tr>
										<tr>
											<td>Status</td>
											<td><select name = 'status'>";
											if($status == 0)
												echo"<option value='$status'>Available</option>
													 <option value='2'>On hold</option>";
											elseif($status == 1)
												echo"<option value='$status'>Active</option>
													 <option value='2'>On hold</option>";
											elseif($status == 2)
												echo"<option value='$status'>On hold</option>
													<option value='1'>Active</option>";
										echo"
										</td>
										</tr>
										<tr>
											<td><b>Year  (<em>e.g. 2011</em>)</td>
											<td><input type = 'year' name = 'contribYear' value = '$contribYear' required></td>
										</tr>";
										if($data['status']==0)
										{
											echo "
												<tr>
												<td><b>Applied to:</td>
												<td><input type = 'radio' name = 'type' value='all'>All<br>
													<input type= 'radio' name='type' value='subject'>Subject</td>
												</tr>
											";
										}
										echo"
										<tr>
											<td colspan = '2' align='center'><input type = 'submit' name = 'update' value = 'UPDATE' ></td>
										</tr>
										</table>
										</form>";
										
								if(isset($_REQUEST['update'])){
									$contribID = $_REQUEST['contribID'];
									$contribDesc = $_REQUEST['contribDesc'];
									$contribAmount = $_REQUEST['contribAmount'];
									$contribSem = $_REQUEST['contribSem'];
									$status = $_REQUEST['status'];
									$contribYear = $_REQUEST['contribYear'];	
									if(isset($_REQUEST['type'])){
										$type = $_REQUEST['type'];
									}
									else{
										$type=null;
									}
									
									$result = mysql_query("SELECT * FROM payments where contribID LIKE '$contribID'") or die(mysql_error());
									$num_rows = mysql_num_rows($result); 
									
									if($num_rows > 0 && $status == '2'){
										echo "Can't disable contribution";
									}
									else{
										if($contribSem !="none"){
											if(is_numeric($contribAmount)){
												if($type != null){
													if($type=="all"){
														mysql_query("DELETE from studentcontribution where contribID='$contribID'");
														mysql_query("UPDATE contribution SET contribDesc = '$contribDesc', contribAmount = '$contribAmount', contribSem = '$contribSem', contribYear = '$contribYear', status = '$status' WHERE contribID='$contribID'") or die (mysql_error());
														$student = mysql_query("SELECT control_number from student");
														while($studentID=mysql_fetch_assoc($student))
														{

															$id = $studentID['control_number'];
															mysql_query("INSERT into studentcontribution(tableID, contribID, StudID)Values('','$contribID','$id')");
														}
														echo"<meta http-equiv = 'refresh' content='0; url=contribution.php'/>";
													}
													else{
														$subjects = mysql_query("SELECT * FROM class,subject WHERE class.scode=subject.subject_id order by scode asc")or die(mysql_error());
														echo 
														"	
															<form method = 'POST' action = 'contributionedit.php'>
															<input type='hidden' value='$contribID' name='contribID'>
															<input type='hidden' value='$contribDesc' name='contribDesc'>
															<input type='hidden' value='$contribAmount' name='contribAmount'>
															<input type='hidden' value='$contribSem' name='contribSem'>
															<input type='hidden' value='$contribYear' name='contribYear'>
															<input type='hidden' value='$status' name='status'>
															<input type='hidden' value='$type' name='type'>

															<table class='menu_tab2' rules='all' width='30%'  border='1'>
																<tr>
																	<td>
																		Subjects:
																	</td>
																</tr>
																<tr>
																	<td>
																		<div style='background:white; width:100%; height:300px; color:black; overflow:scroll;'>";
																		while($subject_arr=mysql_fetch_assoc($subjects)){
																			echo"
																				<input type='checkbox' name='classID[]' value='$subject_arr[classno]'> $subject_arr[subject_code] | $subject_arr[subject_desc]<br>
																			";
																		}
																	
														echo"			</div>
																	</td>
																</tr>
																<tr>
																	<td align='center'><input type='submit' name='update2' value='Enter'></td>
																</tr>
															<table>
															</form>
															
														";
													}	
												}
												else{
													mysql_query("UPDATE contribution SET contribDesc = '$contribDesc', contribAmount = '$contribAmount', contribSem = '$contribSem', contribYear = '$contribYear', status = '$status' WHERE contribID='$contribID'") or die (mysql_error());
													echo"<meta http-equiv = 'refresh' content='0; url=contribution.php'/>";
												}
											}
											else{
												echo"Amount must be valid";
											}
											
										}
									}
										
								}
							}

							if(isset($_REQUEST['update2'])){
								$contribID = $_REQUEST['contribID'];
								$contribDesc = $_REQUEST['contribDesc'];
								$contribAmount = $_REQUEST['contribAmount'];
								$contribSem = $_REQUEST['contribSem'];
								$status = $_REQUEST['status'];
								$contribYear = $_REQUEST['contribYear'];

								if(isset($_POST['classID']))
								{
									$checkbox = $_POST['classID'];
									$count = count($checkbox);
									mysql_query("DELETE from studentcontribution where contribID='$contribID'");
									mysql_query("UPDATE contribution SET contribDesc = '$contribDesc', contribAmount = '$contribAmount', contribSem = '$contribSem', contribYear = '$contribYear', status = '$status' WHERE contribID='$contribID'") or die (mysql_error());

									for($i=0;$i<$count;$i++)
									{
										$queryDatabank = mysql_query("Select * from enroll where classno = '$checkbox[$i]'");
										while($fetchstudent = mysql_fetch_assoc($queryDatabank))
										{
											$id=$fetchstudent['StudID'];
											mysql_query("INSERT into studentcontribution(tableID, contribID, StudID)Values('','$contribID','$id')");
										}
									}
								}
								else{
									mysql_query("UPDATE contribution SET contribDesc = '$contribDesc', contribAmount = '$contribAmount', contribSem = '$contribSem', contribYear = '$contribYear', status = '$status' WHERE contribID='$contribID'") or die (mysql_error());
								}
								echo"<meta http-equiv = 'refresh' content='0; url=contribution.php'/>";
							}
							
							if(isset($_REQUEST['delete'])){
								$contribID = $_REQUEST['delete'];
								mysql_query("DELETE FROM contribution WHERE contribID ='$contribID'") or die (mysql_error());
								echo"DATA DELETED!  <br> Redirecting page.... please wait";
								echo"<meta http-equiv = 'refresh' content='1; url=contribution.php' />";
								
							}
							
							//searching
							
							if(isset($_REQUEST['submitSearch'])){
												$search_input = $_POST['search_input'];
												$search = $_POST['search'];
												
													
										 if(strcmp($search,'contribDesc')==0)
												{
													$result = mysql_query("SELECT * FROM contribution where contribDesc = '$search_input'") or die(mysql_error());
													$num_rows = mysql_num_rows($result); 
												
												}
										
										
										
										else if(strcmp($search,'contribYear')==0)
												{
													$result = mysql_query("SELECT * FROM contribution where contribYear LIKE '$search_input'") or die(mysql_error());
													$num_rows = mysql_num_rows($result); 
										
												}
												
												if(!isset($num_rows)){
													$num_rows=0;
												}
												if($num_rows>0){
														echo "<center>
															<form action='contributionedit.php' method='POST'>
																<td>
																	<select name = 'search'>
																		<option value='none'>-Select-</option>
																		<option value='contribDesc'>Description</option>
																		<option value='contribYear'>Year</option>
																	</select>
																</td>
																<input type='text' name='search_input' placeholder='Search Contribution...' required />
																
																<input type='submit' name='submitSearch' value='Search' />
															</form>
															</center>
															<br />
														<center><table class='menu_tab2' rules='all' width='90%'  border='1'>
															<tr>
																<th>Contribution Description</th>
																<th>Amount</th>
																<th>Semester</th>
																<th>Year</th>
																<th>Status</th>
																<th colspan='2'>Action</th>
														</tr>";
														
														
														
														while($data = mysql_fetch_assoc($result)) {
														echo "<tr>
															  <td>$data[contribDesc]</td>
															  <td>$data[contribAmount]</td>
															  <td>$data[contribSem]</td>
															  <td>$data[contribYear]</td>";
															  if($data['status'] == '0')
																echo"<td>Available</td>";
															  else if($data['status'] == '1')
																echo"<td>Active</td>";
															  else
																echo"<td>On hold</td>";
															 echo"
															  <td><a style='text-decoration:none;' href = 'contributionedit.php?edit=$data[contribID]'><input type='button' value='Edit' name='edit' /> </td>
															  <td><a style='text-decoration:none;' href = 'paymentfunc.php?add=$data[contribID]'><input type='button' value='Payment' name='pay' /> </td>
															  </tr> ";
															  
													}
														echo"</table>
														<center/>
														<ul>
															<li>
																<a href='contributionedit.php?add'><button>Add</button></a>
															</li>
														</ul><br/>";
													}
													else{
														echo "No match found!";
														
													}
							}
							
							
							//for adding!
							echo"<center/>";
								if(isset($_REQUEST['add'])){
									if(isset($_REQUEST['contribDesc'],$_REQUEST['contribAmount'],$_REQUEST['contribSem'], $_REQUEST['contribYear']))
									{
										$contribDesc = $_REQUEST['contribDesc'];
										$contribAmount = $_REQUEST['contribAmount'];
										$contribSem = $_REQUEST['contribSem'];
										$contribYear = $_REQUEST['contribYear'];
										
										
									}	
									else
									{
										$contribDesc = "";
										$contribAmount = "";
										$contribSem = "";
										//$dd =  date('Y')+1;
										$contribYear = date(Y) ;
										//$dd =  date('Y')+1;
		 								
									}

									
									echo" 
										<form method='POST' action ='contributionedit.php?add'>
										<table class='menu_tab2' rules='all' width='30%' >
											<tr>
												<td><b> Description</td>
												<td><input type = 'text' name = 'contribDesc' value='$contribDesc' required></td>
											</tr>
											<tr>
												<td><b>Amount </td>
												<td><input type = 'text' name = 'contribAmount' value='$contribAmount' required></td>
											</tr>
											<tr>
												<td><b>Semester</td>
												<td>
													<select name = 'contribSem'>
													<option value='none'>-Select-</option>
													<option value='summer'>Summer</option>
													<option value='1st Sem'>1st Semester</option>
													<option value='2nd Sem'>2nd Semester</option>
												</td>
											</tr>
											<tr>
												<td><b>Year (<em>e.g. 2011</em>)</td>
												<td><label>$contribYear</label></td>
												<input type = 'hidden' name = 'contribYear' value='$contribYear' required>
											</tr>
											<tr>
												<td><b>Applied to:</td>
												<td><input type = 'radio' name = 'type' value='all'>All<br>
													<input type= 'radio' name='type' value='subject'>Subject</td>
											</tr>
											<tr>
												<td colspan = '2' align='center'><input type = 'submit' name = 'go' value = 'GO' ></td>
											</tr>
										</table>	
										</form>
									";

									if(isset($_REQUEST['go'])){
										$contribDesc = $_REQUEST['contribDesc'];
										$contribAmount = $_REQUEST['contribAmount'];
										$contribSem = $_REQUEST['contribSem'];
										$contribYear = $_REQUEST['contribYear'];
										if(isset($_REQUEST['type'])){
											$type = $_REQUEST['type'];
										}
										else{
											$type=null;
										}
										
										

										if($contribSem != "none"){
											if(is_numeric($contribAmount)){
												if($type != null){
													if($type=="all"){
														mysql_query("INSERT into contribution(contribID,contribDesc, contribAmount, contribSem, contribYear, status)VALUES ('','$contribDesc', 'P$contribAmount.00', '$contribSem', '$contribYear', '0')") or die(mysql_error());
														$contribID = mysql_insert_id();
														$student = mysql_query("SELECT control_number from student");
														while($studentID=mysql_fetch_assoc($student))
														{

															$id = $studentID['control_number'];
															mysql_query("INSERT into studentcontribution(tableID, contribID, StudID)Values('','$contribID','$id')");
														}
														echo"<meta http-equiv = 'refresh' content='0; url=contribution.php'/>";
													}
													else{
														$subjects = mysql_query("SELECT * FROM class,subject WHERE class.scode=subject.subject_id order by scode asc")or die(mysql_error());

														echo 
														"	
															<form method = 'POST' action = 'contributionedit.php?add'>
															<input type='hidden' value='$contribDesc' name='contribDesc'>
															<input type='hidden' value='$contribAmount' name='contribAmount'>
															<input type='hidden' value='$contribSem' name='contribSem'>
															<input type='hidden' value='$contribYear' name='contribYear'>
															<input type='hidden' value='$type' name='type'>

															<table class='menu_tab2' rules='all' width='30%'>
																<tr>
																	<td>
																		Subjects:
																	</td>
																</tr>
																<tr>
																	<td>
																		<div style='background:white; width:100%; height:300px; color:black; overflow:scroll;'>";
																		while($subject_arr=mysql_fetch_assoc($subjects)){
																			echo"
																				<input type='checkbox' name='classID[]' value='$subject_arr[classno]'> $subject_arr[subject_code] | $subject_arr[subject_desc]<br>
																			";
																		}
																	
														echo"			</div>
																	</td>
																</tr>
																<tr>
																	<td align='center'><input type='submit' name='enter' value='Enter'></td>
																</tr>
															<table>
															</form>
															
														";
													}	
													
													// mysql_query("INSERT into contribution(contribID,contribDesc, contribAmount, contribSem, contribYear, status)VALUES ('','$contribDesc', '$contribAmount', '$contribSem', '$contribYear', '0')") or die(mysql_error());
													// echo"DATA ADDED!  <br> Redirecting page.... please wait";
													// echo"<meta http-equiv = 'refresh' content='2; url=contribution.php' />";
												}
												else
												{
													echo "Please choose an option";
												}
											}
											else
											{
												echo "Amount must be valid";
											}
										}

										else
										{
											echo"Please choose a semester";
										}

										
									}

									//for the subjects option, inserting to database
									if(isset($_POST['enter'])){
										$contribDesc = $_REQUEST['contribDesc'];
										$contribAmount = $_REQUEST['contribAmount'];
										$contribSem = $_REQUEST['contribSem'];
										$contribYear = $_REQUEST['contribYear'];

										if(isset($_POST['classID']))
										{
											$checkbox = $_POST['classID'];
											$count = count($checkbox);
											mysql_query("INSERT into contribution(contribID,contribDesc, contribAmount, contribSem, contribYear, status)VALUES ('','$contribDesc', 'P$contribAmount.00', '$contribSem', '$contribYear', '0')") or die(mysql_error());
											$contribID = mysql_insert_id();

											for($i=0;$i<$count;$i++)
											{
												$queryDatabank = mysql_query("Select * from enroll where  classno = '$checkbox[$i]'");
												while($fetchstudent = mysql_fetch_assoc($queryDatabank))
												{
													$id=$fetchstudent['control_number'];
													mysql_query("INSERT into studentcontribution(tableID, contribID, StudID)Values('','$contribID','$id')");
												}
											}
											echo"<meta http-equiv = 'refresh' content='0; url=contribution.php'/>";
										}
										else{
											echo "Please check a box";
										}
										
										// $queryClass= mysql_query("SELECT * FROM databank where classID = 1");
									}
								}

								
						?>
						
					<center/>
					<ul>
							<form action="contribution.php">
							<li>
								<a href='contribution.php'><button>Back</button></a>
							</li>
						</form>
						</ul>
					<footer>
			<div class="section">
				<p>
				</p>
			</div>
			
			
			
		</footer>	
	
</body>

</html>