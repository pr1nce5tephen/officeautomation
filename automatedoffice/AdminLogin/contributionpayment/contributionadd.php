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
	<form action='index.php' method='POST'>
	</head>
	<form action='index.php' method='POST'>
	<body>
		
	</form>	
		
					<div class='menu_nav2'>
						<table class='menu_tab'>
							<tr>
								<th width='30%'>
									Description
								</th>
								<th width='20%'>
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
								<th width='10%'>
									Action
								</th>
							</tr>
							<tr align='center'>
								<td>
									<input type='text' name='' maxlength='100' size='50' placeholder='Description' required />
								</td>
								<td>
									Php&nbsp;<input type='text' name='' maxlength='100' size='30' placeholder='Amount' required />
								</td>
								<td>
									<select name='select'>
										<option value='none'>-Select</option>
										<option value='summer'>Summer</option>
										<option value='1sem'>1st Semester</option>
										<option value='2sem'>2nd Semester</option>
									<select>
								</td>
								<td>
									<input type='text' name='' maxlength='100' placeholder='Year' required />
								</td>
								<td>
									<select name='select'>
										<option value='enabled'>Enabled</option>
										<option value='disabled'>Disabled</option>
										
									<select>
								</td>
								<td>
									<input type='submit' name='save' value='Save' />
								</td>
								<?php
								if(isset($_POST['save'])){
									$contribDesc = $_POST['contribDesc'];
									$contribAmount = $_POST['contribAmount'];
									$contribSem = $_POST['contribSem'];
									$contribYear = $_POST['contribYear'];
									$status = $_POST['contribYear'];
									
									mysql_query("INSERT into contribution(contribID,contribDesc, contribAmount, contribSem, contribYear, status)VALUES ('','$contribDesc', '$contribAmount', '$contribSem', '$contribYear', '$status')") or die(mysql_error());
									echo"DATA ADDED!  <br> Redirecting page.... please wait";
									echo"<meta http-equiv = 'refresh' content='2; url=contribution.php' />";
		}
								
								?>
							</tr>
						</table>
					</div>
					
						<ul>
							<li>
								<a href='contribution.php'>Back</a>
							</li>
						</ul>
					
				
			
	</body>
</html>
