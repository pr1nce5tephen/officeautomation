<?php
	 
	 include('../../config/connection.php');
 require('../../auth.php');
 	confirm_logged_in();
 	check_level();
?>
<html>
	<head>
		<title>
			Edit User
		</title>
	<link href="../../button.css" rel="stylesheet" type="text/css" />
	
	</head>
	
	<body>
		
	
		
		
						<?php include('../../menu/nav2.php');?>
					
					<br>
					<center/>
						<table class='menu_tab2' rules='all' width='30%' border='1'>
							<?php
							if(isset($_GET['edit'])){
									$userID = $_GET['edit'];
									$record = mysql_query("SELECT * FROM users WHERE userID = '$userID' ");
									$data = mysql_fetch_assoc($record);
									
									echo" 
										<form method='POST' action ='editUser.php'>
										<center>
											<tr>
												<th colspan = 2 class = 'records'> USER INFORMATION </th>
											</tr>
											<tr>
												<td> User ID </td>
												<td align = center>$data[userID] <input type = 'hidden' name = 'userID' value = '$data[userID]' ></td>
											</tr>
											<tr>
												<td> User Name: </td>
												<td><input type = 'text' name = 'userName' size = '33'value = '$data[userName]' required></td>
											</tr>
											<tr>
												<td>Password: </td>
												<td><input type = 'password' name = 'userPass' size = '33' value = '$data[userPass]' required='required' pattern='^(?=.*\d)(?=.*[A-Z])(?=.*[a-z]).{6,12}$' placeholder='At least 6-12 letter and number combination'/></td>
											</tr>
											<tr>
												<td> Confirm Password: </td>
												<td><input type = 'password' name = 'cPass' size = '33' value = '$data[userPass]' pattern='^(?=.*\d)(?=.*[A-Z])(?=.*[a-z]).{6,12}$'  placeholder='Repeat Password'></td>
											</tr>
												<tr>
													<td>User Level</td>
														<td><select name = 'userLevel'>";
														if($data[userLevel] == 3)
															echo"<option value='$data[userLevel]'>Student Assistant</option>
																	 <option value='1'>Administrator</option>
																	  <option value='2'>Instructor</option>";
														elseif($data[userLevel] == 1)
															echo"<option value='$data[userLevel]'>Administrator</option>
																	  <option value='3'>Student Assistant</option>
																	  <option value='2'>Instructor</option>";
														 elseif($data[userLevel] == 2)
															echo"<option value='$data[userLevel]'>Instructor</option>
														 			  <option value='1'>Administrator</option>
																	  <option value='3'>Student Assistant</option>";
													
															echo"
														</td>
												</tr>
												<tr>
													<td>Status</td>
														<td><select name = 'userStat'>";
														if($data[userStat] == 0)
															echo"<option value='$data[userStat]'>Onhold</option>
																	 <option value='1'>Active</option>";
														elseif($data[userStat] == 1)
															echo"<option value='$data[userStat]'>Active</option>
																	  <option value='0'>Onhold</option>";
															echo"
														</td>
												</tr>";
											echo"<td colspan = '2' align='center'><input type = 'submit' name = 'update' value = 'Update' ></td>
												</tr>
										</form>";
									}
								
								//updating to database
								if(isset($_POST['update'])){
									$userID = $_POST['userID'];
									$userName = $_POST['userName'];
									$userPass = $_POST['userPass'];
									$userPass = $_POST['userPass'];
									$cPass = $_POST['cPass'];
									$userLevel = $_POST['userLevel'];
									$userStat = $_POST['userStat'];
									
									
									$check = mysql_query("SELECT * FROM users WHERE userID = '$userID'");
									$same = mysql_fetch_assoc($check);
										if($userPass!=$cPass){
											echo"<meta http-equiv = 'refresh' content='0; url=editUser.php?edit=$userID' />";
											echo "<script type='text/javascript'>\n";
											echo "alert('Password and Confirm Password did not match!');\n";
											echo "</script>";
										}		

									else{
										mysql_query("UPDATE users SET userName = '$userName', userPass = '$userPass', userLevel = '$userLevel', userStat = '$userStat' where userID ='$userID'")or die (mysql_error());
								echo"<meta http-equiv = 'refresh' content='0; url=usermain.php' /><script>alert('Updated Succesfully!')</script>";	
									}
									
								}
								
								
								//deleting
								if(isset($_GET['delete']))
								{
									$userID=$_REQUEST['delete'];
									$uID= $_SESSION['id'];
									
									if($userID == $uID){
										echo"<meta http-equiv = 'refresh' content = '0; url = admin.php' />";

									}
									
									else if($userID != $uID)
									{
									
										/*echo "
													<script type='text/javascript'> 
														var retVal = confirm('Do you want to continue ?');
														if( retVal == true ){
															window.location='edit.php?deleteuser=$userID';
															return true; 
														}
														else{ 
															window.location='admin.php'; 
															return false;  
														}
													</script> 
													</form>";
										
									}*/
									mysql_query("DELETE FROM users WHERE userID ='$userID'") or die (mysql_error());
										//mysql_query("INSERT INTO audittrail(auditID,uID,auditDate,auditTime,description) VALUES ('','$_SESSION[record]',NOW(),NOW(),'deleted $data[userName]')") or die (mysql_error());
										echo" <script type='text/javascript'>
													alert('Data Deleted');
													window.location='admin.php';
													</script>";
								}
								
								//deleting into the database
								if(isset($_REQUEST['delete'])){
									   $uID = $_REQUEST['delete'];
									   $record = mysql_query("SELECT * FROM users WHERE userID = '$userID'");
									   $data = mysql_fetch_assoc($record);
										
								}
							}
							?>
						</table>
					
					
						<ul>
							<li>
								<a class='button' href='usermain.php'>Back</a>
							</li>
						</ul>
					
		
</center>
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