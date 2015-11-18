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
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<form action='index.php' method='POST'>
	</head>
	<form action='index.php' method='POST'>
	<body>
		<div class='header'>
		<a herf='logout.php'><input type='submit' name='logout' value='Logout'></a>
		</div>
	</form>	
		<div class='footer'>
		</div>
		
		<div class='main'>
			<div class='content_tab'>
				<div class='content_menu_nav_bg'>
					<div class='menu_nav'>
						<ul>
							<li class='active'>
								<a href='contribution.html'>Contributions</a>
							</li>
							<li>
								<a href='payment.html'>Payments</a>
							</li>
						</ul>
					</div>
					<div class='menu_nav2'>
						<center>
							<input type='text' name='search_contrib' placeholder='Search Contribution...' required />
							<input type='button' name='b_search' value='Search' />
						</center>
						<br />
						<table class='menu_tab'>
							<tr>
								<th width='20%'>
									Contribution Description
								</th>
								<th width='15%'>
									Amount
								</th>
								<th width='10%'>
									Semester
								</th>
								<th width='10%'>
									Year
								</th>
								<th width='10%'>
									Status
								</th>
								<th  colspan='2' width='15%'>
									Action
								</th>
							</tr>
							<?php
							
							if(isset($_POST['submitSearch'])){
								$search_input = $_POST['search_input'];
						
							$result = mysql_query("SELECT * FROM contribution where contribDesc LIKE '%$search_input%'") or die(mysql_error());
							$num_rows = mysql_num_rows($result); 
									if($num_rows>0){
											while($data = mysql_fetch_assoc($result)) { 
												
															echo"<tr>
																  <td>$data[contribDesc]</td>
																  <td>$data[contribAmount]</td>
																  <td>$data[contribSem]</td>
																  <td>$data[contribYear]</td>";
																  if($data[status] == '0')
																	echo"<td>Enabled</td>";
																  else
																	echo"<td>Disabled</td>";
																 echo"
																  <td><a href = 'contributionfunc.php?edit=$data[contribID]'> Edit </td>
																  <td><a href = 'contributionfunc.php?delete=$data[contribID]'> Delete </td>
															</tr>";
											}
										}
										else{
											echo "No match found!";
											
										}
										}
									?>
						</table>
					</div>
					<div align='center'class='menu_nav3'>
						<ul>
							<li>
								<a href='contributionadd.html'>Add</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
			
	</body>
</html>
