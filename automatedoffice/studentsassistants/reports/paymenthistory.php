<?php
	require_once('../../auth.php');
	require_once('../../initialize.php');
	include('../../config/sy.php');
	confirm_logged_in();
?>
<html>
	<head>
		<title>
			Payment history
		</title>
	
	</head>
	<form action='index.php' method='POST'>
	<body>
		
	</form>
		
		 <!--menu-->


       <?php include('../../menu/nav2.php');?>
		
					<br>
					<center/>
						<br />
						<table class='menu_tab2' rules='all' width='90%'>
							<th width='10%'>
									Student ID
								</th>
								<th width='20%'>
									Name
								</th>
								<th width='10%'>
									Course ID
								</th>
								<th width='10%'>
									Payments
								</th>
							</tr>
							<?php
								$query = mysql_query("SELECT * FROM student JOIN course WHERE student.course=course.course_id ORDER BY `student`.`lname` ASC");
								while($data = mysql_fetch_assoc($query)) {
								$stat = $data['status'];
									echo "<tr>
										  <td><center>$data[control_number]</td>
										  <td>&nbsp;&nbsp;$data[lname],&nbsp;$data[fname]&nbsp;$data[mi]</td>
										  <td><center>$data[course_code]</td>";	 
									echo"
									<td align = center><a style='text-decoration:none;' href = 'paymenthistory2.php?view=$data[control_number]&lname=$data[lname]&fname=$data[fname]&mi=$data[mi]' title = 'View' target='_blank'>View Payments History</a></td>
										 </tr>";
								}
								echo"</table>";
							?>
						</table>
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