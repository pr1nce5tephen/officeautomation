<?php
	include('../config/sy.php');
	include('../menu/nav3.php');



//updating to database
								if(isset($_POST['update'])){
									$userID = $_POST['userID'];
									$userName = $_POST['userName'];
									$userPass = $_POST['userPass'];
									$cPass = $_POST['cPass'];



									$check = mysql_query("SELECT * FROM faculty WHERE fcode = '$userID'");
									$same = mysql_fetch_assoc($check);
										if($userPass!=$cPass){
											echo"<meta http-equiv = 'refresh' content='0; url=change.php' />";
											echo "<script type='text/javascript'>\n";
											echo "alert('Password and Confirm Password did not match!');\n";
											echo "</script>";
										}

									else{
										mysql_query("UPDATE faculty SET InstID = '$userName', pin = '$userPass' where fcode ='$userID'")or die (mysql_error());
								echo"<meta http-equiv = 'refresh' content='0; url=change.php' /><script type='text/javascript'>alert('Account Details Succesfully Save!')</script>";
									}

								}

?>
<html>
	<head>
		<title>
			Account Details
		</title>
	</head>

	<body>



					<br>
					<div align="center" class='menu_nav2'>
						<form action = "change.php" method="POST">
							<?php
					$id = $_SESSION['userid'];
							$query = mysql_query("SELECT * FROM users WHERE userID = '$id' LIMIT 1") or die(mysql_error());
							$rec = mysql_fetch_array($query);
					?>
						<table class="menu_tab2" rules="all" >
							<th colspan="2"><h2>Login Details</h2></th>
							<form method='POST' action ='change.php'>
										<center>

											<tr>
												<td> User ID </td>
												<td align = center><?php echo $rec['userID']?> <input type = 'hidden' name = 'userID' value = '<?php echo $rec['fcode']?>' required></td>
											</tr>
											<tr>
												<td> User Name: </td>
												<td><input type = 'text' name = 'userName' size = '33'value = '<?php echo $rec['userName']?>' required></td>
											</tr>
											<tr>
												<td>Password: </td>
												<td><input type = 'password' name = 'userPass' size = '33' value = '<?php echo $rec['userPass']?>' required='required' pattern='^(?=.*\d)(?=.*[a-zA-Z]).{6,12}$' placeholder='At least 6-12 letter and number combination'/></td>
											</tr>
											<tr>
												<td> Confirm Password: </td>
												<td><input type = 'password' name = 'cPass' size = '33' value = '<?php echo $rec['userPass']?>' placeholder='Repeat Password'></td>
											</tr>


											<td colspan = '2' align='center'><input type = 'submit' name = 'update' value = 'Save' >  <input type="reset" name="cancel" value="Cancel"></td>
												</tr>
										</form>
						</table>
						</form>
					</div>

					<center>
						<ul>
							<li>
								<a href= '../users/usermain.php'><button>Back</button></a>
							</li>
						</ul><br/>

<footer>
			<div class="section">
				<p>
				</p>
			</div>



		</footer>
</body>
</html>
