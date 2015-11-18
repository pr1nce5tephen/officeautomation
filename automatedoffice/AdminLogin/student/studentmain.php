	<?php
 error_reporting(0);
	 include('../../config/connection.php');
 require('../../auth.php');
 	confirm_logged_in();
 	check_level();
	 ?>
	<!DOCTYPE html>
		<html lang="en">
		<head> 
			<meta charset="utf-8" />
			<title> Western Leyte College </title>
			<meta name="keywords" content="" />
			<meta name="description" content="" />
			<script language="javascript" src="../subjects/confirmDel.js" type="text/javascript"></script>
			<script src="../../filterJavascript/filter.js" type="text/javascript" charset="utf-8"></script>
			<script src="../../filterJavascript/js/application.js" type="text/javascript" charset="utf-8"></script> 
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="../../style.css" rel="stylesheet" type="text/css" />
			
		</head>
		
		<body>
			
      <!--menu-->


      <?php include('../../menu/nav2.php');?>

				<br/>
			
				 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 <label for="filter">Search:</label> <input type="text" name="filter" value="" id="filter" />
	
			</center>
				<header>
					<br/>
					<center>
					<table class='menu_tab2' rules="all" width="90%"  border="1">
							<tr>
									<th>Control Number</th>
									<th>Name</th>	
									<th>Address</th>
									<th>Cellphone Number:</th>
									<th>Gender</th>
									<th>Course</th>
									<th>Year Lvl</th>
									<th>Birthdate</th>
									<th>Status</th>
									
								</tr>

<?php
$result=mysql_query("SELECT * FROM student,course WHERE student.course=course.course_id");
while($rows=mysql_fetch_array($result)){
		$get=$rows['status'];
		$status = $get == 'Active' ? 'Active' : 'Not Active';
		$student_id=$rows['student_id'];	
		echo'<tr align="center">';
		echo'<td>'.$rows['control_number'].'</td>';
		//echo'<td>'.$rows['control_number'].'</td>';
		echo'<td><a style="text-decoration:none;" href="updatestudent.php?student_id='.$student_id.'">'.$rows['lname'].','.$rows['fname'].' '.$rows['mi'].'</td>';
		echo'<td>'.$rows['address'].'</td>';
		echo'<td>'.$rows['contact_number'].'</td>';
		echo'<td>'.$rows['gender'].'</td>';
		echo'<td>'.$rows['course_code'].'</td>';
		echo'<td>'.$rows['yrlvl'].'</td>';
		echo'<td>'.$rows['birthdate'].'</td>';

		if($status == 'Active'){
			echo"<form action='process.php' method='POST'>
				 <input type='hidden' name='student_id' value='$rows[student_id]'>
				 <input type='hidden' name='status' value='Not Active'>
				 <td><input class='button' type='submit' name='stat' value='$status'></td>
				 </form>";
		}else{
			echo"<form action='process.php' method='POST'>
				 <input type='hidden' name='student_id' value='$rows[student_id]'>
				 <input type='hidden' name='status' value='Active'>
				 <td><input class='button' type='submit' name='stat' value='$status'></td>
				 </form>";
		}
		//echo'<td><img style="width:100px; height:100px;"  src="Upload/'.$rows['photo'].'"/></td>';
		//echo'<td><a style="text-decoration:none;" href="updatestudent.php?student_id='.$student_id.'"><img src="../images/b_edit.png"></img></a></td>';
		echo'</tr>';
		
		
		
	}++$i;
	?>
	</center>
	</table>
	</header>

		
		
			
	  
	
	  <div align='center'class='menu_nav3'>
						
							
								<a style="text-decoration:none;" href='studentadd.php'/><input class='button' type="button" value="ADD"/></a>
						
								
			</div>
	  
	  
			
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