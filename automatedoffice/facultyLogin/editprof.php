<?php
include('../menu/nav3.php');

if(isset($_REQUEST['id'])){
	$id = $_REQUEST['id'];
	
	
}

?>
<html>
	<head>
		<title>
			Instructor Page
		</title>
	
	<form action='index.php' name='room' method='POST'>
	</head>
<form action='instructor_profile.php' method='POST'>
	<body>
		
	</form>				
					<br>
					<div align="center" class='menu_nav2'>
						<form action = "instructor_profile.php" method="POST">
							<?php
					$id = $_SESSION['userid'];
							$query = mysql_query("SELECT * FROM faculty WHERE fcode = '$id' LIMIT 1") or die(mysql_error());
							$rec = mysql_fetch_array($query);
					?>
						<table class="menu_tab2" rules="all" width="50%" >
							<th colspan="2"><h2>Profile</h2></th>
							<input type = "hidden" name = "fcode" value = "<?php echo $rec ['fcode'] ?>" />
							<input type = "hidden" name = "InstID" value = "<?php echo $rec ['InstID'] ?>" />
							
						
							<tr><td>Last Name *</td><td><input type="text" name="lname"  size="10" value = "<?php echo $rec['lname'];?>" required /></td></tr>
							<tr><td>First Name *</td><td><input type="text" name="fname"  size="10" value = "<?php echo $rec['fname'];?>" required /></td></tr>
							<tr><td>Middle Name *</td><td><input type="text" name="mi"  size="8" value = "<?php echo $rec['mi'];?>"  /></td></tr>							
							<tr><td>Address *</td><td><input type="text" name="address" value = "<?php echo $rec['address'];?>" maxlength="80" required /></td></tr>
							
							
							<tr><td colspan="2" align="center"><input type = "submit" name = "update" value = "Update"></td></tr>
						</table>
						</form>
					</div>
					
					<center>
						<ul>
							<li>
								<a href= 'instructor_profile.php'><button>Back</button></a>
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
