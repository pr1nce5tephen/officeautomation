<?php
	require_once('../../auth.php');
	require_once('../../initialize.php');
	include('../../config/sy.php');
	confirm_logged_in();
?>
<html>
	<head>
		<title>
			Registered Instructor
		</title>
	
	</head>
	<script language="javascript">
		function docprint()
		{ 
		  var disp_setting="toolbar=no,location=no,directories=no,menubar=no, scrollbars=yes,width=1000, height=600, left=100, top=25"; 
		  var content_vlue = document.getElementById("container").innerHTML; 
		  
		   var docprint=window.open("","",disp_setting);
		   docprint.document.open(); 
		   docprint.document.write('<html><head><title></title><style>table, td, th{border-collapse: collapse;border: 2px solid gray;padding:5px;margin:10px;text-align:center;}</style><body onLoad="self.print()" style="width: 100%; font-size:12px; font-family:arial;">');          
		   docprint.document.write(content_vlue);          
		   docprint.document.write('</body></html>'); 
		   docprint.document.close(); 
		   docprint.focus();
		}
	</script>
	
	<body>
	<p align="center"><input type="button" onClick=location.href="javascript:docprint()" value="Print"> <a href="../course/coursemain.php"><button>Back</button></a></p>
		<div id="container">
					<div id="print_content">
						<center/>
				<?php include("header.php"); ?>
						<center>
						<h2><u>List of Registered Instructors</u></h2>
							<table rules='all' border='1' cellpadding='5px' width='50%'>
								<thead>
									<tr>
										<th>No.</th>
										<th>Instructor ID</th>
										<th>Instructor Name</th>
										<th>Address</th>
										<th>Contact Number</th>
										
									</tr>
								</thead>
								<?php
								$query_faculty = mysql_query("SELECT * FROM faculty order by lname") or die(mysql_error());
								$num=0;
								if(mysql_num_rows($query_faculty)>0){
									while($instructor = mysql_fetch_array($query_faculty)){
									$num++;
								?>
										<tbody>
											<tr>
												<td align='center'><?php echo $num."."?></td>
												<td align='center'><?php echo $instructor['fcode'];?></td>
												<td><div align="center"><?php echo $instructor['lname'].", ".$instructor['fname']." ".$instructor['mi'];?></div></td>
												<td><div align="center"><?php echo $instructor['address']; ?></div></td>
												<td align='center'><?php echo $instructor['contactno']; ?></td>
												
											</tr>
										</tbody>
								<?php
									}
								}else{
									echo "no records found";
								}
								?>		
							</table>
							
						</center><?php include("footer.php"); ?>
					</div>
		</div>
	</body>
</html>