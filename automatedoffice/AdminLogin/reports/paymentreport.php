<?php
	require_once('../../auth.php');
	require_once('../../initialize.php');
	include('../../config/sy.php');
	confirm_logged_in();
?>

	<head>
		<title>
			Payment Report
		</title>
	
	
	</head>

		<!--menu-->


       <?php include('../../menu/nav2.php');?>
		
					<br>
					
						<center>
							<form action='paymentreport.php' method='POST'>
							
									<select name = "search">
									<option value="none">-Select-</option>
									<option value="contribDesc">Description</option>
									<option value="contribYear">Year</option>
									</select>
								
								<input type='text' name='search_input' placeholder='Search Contribution...' required />
								
								<input type='submit' name="submitSearch" value='Search' />
							</form>
						</center>
						<br />
							<?php	
								
								if(isset($_REQUEST['submitSearch'])){
									$search_input = $_POST['search_input'];
									$search = $_POST['search'];
									
										
									 if(strcmp($search,'contribDesc')==0)
											{
												$result = mysql_query("SELECT * FROM contribution where contribDesc = '$search_input'") or die(mysql_error());
												$num_rows = mysql_num_rows($result); 
											
											}
									
									
									
									else if(strcmp($search,'contribYear')==0)
											{
												$result = mysql_query("SELECT * FROM contribution where contribYear LIKE '$search_input'") or die(mysql_error());
												$num_rows = mysql_num_rows($result); 
									
											}
											
											if(!isset($num_rows)){
												$num_rows=0;
											}
											if($num_rows>0){
													echo "<center><table class='menu_tab2' rules='all' width='90%''  border='1'>
														<tr>
															<th>Contribution</th>
															<th>Semester</th>
															<th>Year</th>
															<th colspan=3>Print List</th>
													</tr>";
													
													
													
													while($data = mysql_fetch_assoc($result)) {
														echo "<tr>
														  <td align = center>$data[contribDesc]</td>
														  <td align = center>$data[contribSem]</td>
														  <td align = center>$data[contribYear]</td>";
														 echo"		
														 <td align = center><a href = 'print.php?action=unpaid&contribID=$data[contribID]' target='_blank'>View Unpaid</a></td>
														 <td align = center><a href = 'print.php?action=paid&contribID=$data[contribID]' target='_blank'>View Paid</a></td>
														 <td align = center><a href = 'print.php?action=all&contribID=$data[contribID]' target='_blank'>View All</a></td> ";
														
														/*echo"<form action='paymentfunc.php' method='POST'>";
														echo"<td><input type='submit' name='view' value='View' />";
														echo"</form>"; */
														echo"<tr>";
														  
												}
													echo"</table>";
												}
												else{
													echo "No match found!";
													
												}
								}
								else{
										echo "
										<center/>
											<table class='menu_tab2' rules='all' width='90%''  border='1'>
												<tr>
													<th width='20%'>
														Contribution Description
													</th>
											
													<th width='10%'>
														Semester
													</th>
													<th width='10%'>
														Year
													</th>
													<th  colspan='3' width='15%'>
														PRINT LIST
													</th>
												</tr>";
											$query = mysql_query("SELECT * FROM contribution");
										
											while($data = mysql_fetch_assoc($query)) {
												echo "<tr>
												
													  <td align = center>$data[contribDesc]</td>
													  <td align = center>$data[contribSem]</td>
													  <td align = center>$data[contribYear]</td>";
													 echo"		
													 <td align = center><a style='text-decoration:none;' href = 'print.php?action=unpaid&contribID=$data[contribID]' target='_blank'>View Unpaid</a></td>
													 <td align = center><a style='text-decoration:none;' href = 'print.php?action=paid&contribID=$data[contribID]' target='_blank'>View Paid</a></td>
													 <td align = center><a style='text-decoration:none;' href = 'print.php?action=all&contribID=$data[contribID]' target='_blank'>View All</a></td> ";
													
													/*echo"<form action='paymentfunc.php' method='POST'>";
													echo"<td><input type='submit' name='view' value='View' />";
													echo"</form>"; */
													echo"<tr>";
											}
										echo"</table>";
								}
							?>
							
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