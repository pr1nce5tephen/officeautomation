<?php
	 error_reporting(0);
	 include('../../config/connection.php');
 	 require('../../auth.php');
 	 confirm_logged_in();
 	 check_level();
 	 session_start('0');
?>
<html>
	<head>
		<title>
			User Maintenance
		</title>
	<link href="../../button.css" rel="stylesheet" type="text/css" />
	 
	</head>
	
		
		
		
					<?php include('../../menu/nav2.php');?>
					
					<br>
					<div class='menu_nav2'>
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
<center/>
						<table class='menu_tab2' rules='all' border='1' width='90%'>
<?php
					echo"<tr>
								 
								<th>User Name</th>
								<th>User Level</th>
								<th>User Stat</th>
								<th>Action</th>
								
							</tr>";
							$id = $_SESSION['userid'];
	$query = mysql_query("SELECT * FROM users");
		while($data = mysql_fetch_assoc($query)) {
		$ulvl = $data['userLevel'];
		$stat = $data['userStat'];
					echo "<tr>
								 
								<td align = center>$data[userName]</td>
								<td align = center>"; if($ulvl==1){ echo "Administrator"; }else if($ulvl==2){ echo "Instructor"; }else{ echo "Student Assistant"; } echo "</td>
								<td align = center>"; if($stat==1){ echo "Active"; }else{ echo "Onhold"; } echo "</td>
								<td align = center><a class='button' href = 'editUser.php?edit=$data[userID]' title = 'edit'>Edit</a></td>
							<tr>";
		}
mysql_close();
?>
						</table>
					</div>
					<br/>
					<center/>
						<ul>
							<li>
								<a class='button' href = 'addUser.php?add'>Add User</a>
							</li>
						</ul>
						<br/>
					
	
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