<?php
session_start();
include('../menu/nav3.php');
//UPDATE--------------------------
if(isset($_REQUEST['update'])) {
	$id = $_REQUEST['fcode'];
	$instid = $_REQUEST['InstID'];
	$lname = $_REQUEST['lname'];
	$fname = $_REQUEST['fname'];
	$mi = $_REQUEST['mi'];
	$address = $_REQUEST['address'];
	$specialization = $_REQUEST['specialization'];
	$InstID = $_REQUEST['InstID'];
	$pin = $_REQUEST['pin'];

	
	mysql_query("UPDATE faculty SET InstID='$instid', lname='$lname', fname='$fname', mi='$mi', address='$address', position='$specialization', InstID='$InstID', pin='$pin' WHERE fcode='$id' ") or die(mysql_error());
	

	
 echo "<script type='text/javascript'>alert('Data Updated.'); history.back(instructor_profile.php);</script>";
 echo "<meta http-equiv = 'refresh' content = '0; url = instructor_profile.php'/>";
}

if(isset($_SESSION['userid'])){
	$id = $_SESSION['userid'];
}
//$id = 4;

?>
<html>
	<head>
		<title>
			Instructor Page
		</title>
	
	<form action='index.php' name='room' method='POST'>
	</head>
	<form action='instructor_home.php' method='POST'>
	<body>
		
	</form>
				
					<br>
					<div align="center" class='menu_nav2'>
					<?php
					$id = $_SESSION['userid'];
							$query = mysql_query("SELECT * FROM faculty WHERE fcode = '$id' LIMIT 1") or die(mysql_error());
							$rec = mysql_fetch_array($query);
					?>
							<table class="menu_tab2" rules="all" width="40%">
								<th colspan="2"><h2>My Profile</h2></th>
								
								<tr align="center"><td>NAME: </td><td> <?php echo $rec['lname'];?>  <?php echo $rec['fname'];?>  <?php echo $rec['mi'];?></td></tr>
								<tr align="center"><td>Address:</td><td><?php echo $rec['address'] ; ?></td></tr>
								<tr align="center"><td>Gender: </td><td><?php echo $rec['gender'] ; ?></td></tr>
								<tr align="center"><td>Contact Number: </td><td><?php echo $rec['contactno'] ; ?></td></tr>
<!--<tr align="center"><td>Rate:</td><td><?php //echo $rec['rate'] ; ?></td></tr>-->
								<tr align="center"><td>Position: </td><td><?php echo $rec['position'] ; ?></td></tr>

								
							</table>
					</div>
					<center>
						<ul>
							<li>
								<a href = "editprof.php? id=<?php echo $rec["InsEntry"]; ?>" ><button>Edit Profile</button</a>
							</li>
						</ul>
						<br/>
				
<footer>
			<div class="section">
				<p>
				</p>
			</div>
			
			
			
		</footer>	
</body>
</html>
