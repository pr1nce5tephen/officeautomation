<?php
	include('../../config/connection.php');
 	 require('../../auth.php');
 	 confirm_logged_in();
 	 check_level();
?>
<html>
	<head>
		<title>
			Add User
		</title>
	<link href="../../button.css" rel="stylesheet" type="text/css" />
	
	</head>
	
	<?php include('../../menu/nav2.php');?>
		
		
						<!--<center>
						<form action='subject.php' method='POST'>
							<select name='#'>
								<option name='none'>Search By</option>
								<option name='rID'>Room ID</option>
								<option name='rNumber'>Room Number</option>
								<option name='rDescription'>Room Description</option>
							</select>
							<input type='text' name='search_contrib' placeholder='Search Record...' required />
							<input type='button' name='b_search' value='Search' />
						</form>
						</center>-->
						<br /><center/>
						<table class='menu_tab2' rules='all' width='30%'>
							<?php
							 
							function random_password( $length = 8 ) {
								$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
								$password = substr( str_shuffle( $chars ), 0, $length );
								return $password;
							}						
													
						//para sa adding
								if(isset($_REQUEST['add'])){
								$userID=$_REQUEST['add'];
								$record = mysql_query("SELECT * FROM users WHERE userID = '$userID'");
								$data = mysql_fetch_assoc($record);
								
								echo" 
									<form method='POST' action ='addUser.php'>
										<tr>
											<th colspan = 2 > USER INFORMATION </th>
										</tr>
										<tr>
											<td> User Level: </td>
											<td>	<select name = 'userLevel'>
														<option value='none'>-Select-</option>
													
														<option value='1'>Administrator</option>
														<option value='3'>Student Assistant</option>
											</select></td>
										</tr>
										<tr>
											<td colspan = '4' align='center'><input class='button' type = 'submit' name = 'adding' value = 'Add' > <a class='button' href='usermain.php'>Back</a></td>
										</tr>
									</form>";
								}
							//pag add sa database
							if(isset($_POST['adding'])){
								
								$userLevel = $_POST['userLevel'];
								//$userPass = random_password(8);
								
								$qry = mysql_query("SELECT * from users");
								//$num_rows = mysql_num_rows($qry); 
					
					
								if ($userLevel == '1'){
									mysql_query("INSERT INTO users(userID,userName,userPass,userLevel,userStat) VALUES 
									('','Admin','password','1','0')") or die(mysql_error());
									
									// $last = mysql_query("SELECT * FROM users WHERE userID = last_insert_ID()");
									// $insert = mysql_fetch_assoc($last);
									//mysql_query("INSERT INTO audittrail(auditID,uID,auditDate,auditTime,description) VALUES ('','$_SESSION[record]',NOW(),NOW(),'added user, $insert[userName] to database')") or die (mysql_error());
										 
									echo"<meta http-equiv = 'refresh' content='0; url=usermain.php' />
											<script type='text/javascript'>\n
											alert('Admin Added');\n
											</script>";
								}
								else if ($userLevel == '3'){
									mysql_query("INSERT INTO users(userID,userName,userPass,userLevel,userStat) VALUES 
									('','StudentAssistant','password','3','0')") or die(mysql_error());
										
									echo"<meta http-equiv = 'refresh' content='0; url=usermain.php' />
											<script type='text/javascript'>\n
											alert('Student Assistant Added');\n
											</script>";
								}
								else{
									echo"<meta http-equiv = 'refresh' content='0; url=usermain.php' />
											<script>\n
											alert('Select user level');\n
											</script>";
								}
							}
?>
						</table>
					
				
						<ul>
							<li>
								
							</li>
						</ul>
					
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