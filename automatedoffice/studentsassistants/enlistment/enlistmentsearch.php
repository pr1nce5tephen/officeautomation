<?php
 include('../../config/connection.php');
	 require('../../auth.php');
	 include('../../config/sy.php');
 	confirm_logged_in();
 	?>
<html lang="en">
		<head> 
			<meta charset="utf-8" />
			<title> Western Leyte College </title>
			<meta name="keywords" content="" />
			<meta name="description" content="" />
			<script language="javascript" src="../subjects/confirmDel.js" type="text/javascript"></script>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="../../style.css" rel="stylesheet" type="text/css" />
			<script language="javascript" src="../restriction.js" type="text/javascript"></script>
			
		</head>
		
		<body>
			
      <!--menu-->


       <?php include('../../menu/nav2.php');?>
       <br/>

<br>
	<center>
		<script language="javascript" src="../../restriction.js" type="text/javascript"></script>
	<form action='enlistment.php' method='POST'>
						<select name = "sem">
						<option value = "" selected>Semester</option>
							<?php
								$query = mysql_query("SELECT DISTINCT class.sem FROM class order by sem") or die(mysql_error());
									if(mysql_num_rows($query)>0){ 
										while($data = mysql_fetch_array($query)) {
							?>
						<option value = "<?php echo $data['sem']?>"><?php echo $data['sem']?></option>
							<?php
										}
									}
							?>
						</select>
						<!--this select to get school year-->
						<select name = "SY">
						<option value = "" selected>School Year</option>
							<?php
								$query = mysql_query("SELECT DISTINCT class.SY FROM class order by SY") or die(mysql_error());
									if(mysql_num_rows($query)>0){ 
										while($data = mysql_fetch_array($query)) {
							?>
						<option value = "<?php echo $data['SY']?>"><?php echo $data['SY']?></option>
							<?php
										}
									}
							?>
						</select>
						
						<input type='text' name='control_number' onkeyup="checkInput2(this)" placeholder='Enter Control Number'>
						<input type='submit' name='submit' value='SUBMIT'>
						</form>
						</center>
						<br>
					


		
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