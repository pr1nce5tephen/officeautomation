<?php
	require_once('../../auth.php');
	require_once('../../initialize.php');
	include('../../config/sy.php');
	confirm_logged_in();

if(isset($_REQUEST['viewstud'])){
	$courstudid = $_REQUEST['viewstud'];
}

?>
<html>
<head>
 <!--Selecting all the checkbox-->
<script language="JavaScript">
//Selecting all the checkbox

  function selectAll(source) {
    checkboxes = document.getElementsByName('checkbox[]');
    for(var i in checkboxes)
      checkboxes[i].checked = source.checked;
  }
</script>
		<title>
			Course Reports
		</title>
	
	</head>
	<form action='index.php' method='POST'>
	<body>
		<?php include('../../menu/nav2.php');?>
	</form>
		
		
		
					<br>
					
						<center>
						<form action = "courserepprint.php" method = "POST">
							
								<?php
									$query = mysql_query("SELECT * FROM course WHERE course_id = '$courstudid'") or die(mysql_error());
									$stud = mysql_fetch_assoc($query);
									$complete_name = $stud['course_code']." ".$stud['course_desc'];
									$_SESSION['coursename'] = $complete_name;
								?>
								<table>
								<tr>
									<th colspan="7"><h2><?php echo $complete_name; ?></h2><h3>List of Enrolled Students in this Course.</h3></th>
								</tr>
								<table class='menu_tab2' rules='all' width='100%'>
								<tr>
								  <th> Check <input type="checkbox" id="selectall" onClick="selectAll(this)" /></th>
                                  <th>Student  Control Number</th>
                                  <th>Student First Name</th>
                                  <th>Student Middle Name</th>
                                  <th>Student Last Name</th>
								</tr>
								<tr>
								<?php
                                    
                                  $getdata = mysql_query("SELECT * FROM student WHERE course = '$courstudid'");
							      if(mysql_num_rows($getdata)>0){
								      while($row = mysql_fetch_array($getdata)){
									echo"
									<tr>
									<td><center><input type='checkbox' name='checkbox[]'  value='$row[student_id]' /></center></td>
									 <td><center>$row[control_number]</center></td>
									 <td><center>$row[fname]</center></td>
									 <td><center>$row[mi]</center></td>
									 <td><center>$row[lname]</center></td>
									</tr></tbody>";
								   }

							     }else{
										echo"<script type = 'text/javascript'>";
										echo"alert('No Record Found. Invalid Input.')";	
										echo"</script>";
							       }
							   ?>
                                </tr>
                            </table>
                         <center>
					        <input type = "submit" name = "courseprint" value = "Print record">
				         </center>
						</form>
						</center>
						<br/>
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