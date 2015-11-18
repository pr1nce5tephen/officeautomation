<?php
	require_once('../../auth.php');
	require_once('../../initialize.php');
	include('../../config/sy.php');
	confirm_logged_in();
	check_level();
?>
<body>
	
		
		
		
				<?php include('../../menu/nav2.php');?>
					<center/>
					<br>
					
						<center>
						<form action='contributionedit.php' method='POST'>
							<td>
								<select name = "search">
									<option value="none">-Select-</option>
									<option value="contribDesc">Description</option>
									<option value="contribYear">Year</option>
								</select>
							</td>
							<input type='text' name='search_input' placeholder='Search Contribution...' required />
							
							<input type='submit' name="submitSearch" value='Search' />
						</form>
						</center>
						<br />
						<table class='menu_tab2' rules="all" width="90%"  border="1">
							<tr>
								<th width='20%'>
									Contribution Description
								</th>
								<th width='15%'>
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
								<th  colspan='1' width='15%'>
									Action
								</th>
							</tr>
							<?php
								$query = mysql_query("SELECT * FROM contribution");
								$url = $_SERVER['PHP_SELF'];
								while($data = mysql_fetch_assoc($query)) {
									$check=mysql_query("SELECT * from payments where contribID='$data[contribID]'");
									if(mysql_num_rows($check)>0){
										if($data['status']==0){
											mysql_query("UPDATE contribution set status=1")or die(mysql_error());
											echo"<meta http-equiv = 'refresh' content='0; url=$url' />";
										}
									}

									
									
									echo "<tr>
									
										  <td align = center>$data[contribDesc]</td>
										  <td align = center>$data[contribAmount]</td>
										  <td align = center>$data[contribSem]</td>
										  <td align = center>$data[contribYear]</td>";
											  if($data['status'] == '0'){
												echo"<td align = center>Available</td>";
												}
											else if($data['status'] == '1'){
												echo"<td align = center>Active</td>";
												}
											  else{
												echo"<td align = center>Onhold</td>";
												}
										 echo"		
										 <td align = center><a href = 'contributionedit.php?edit=$data[contribID]' title = 'Edit Contribution'><button>Edit</button></a></td>";
										//echo"<td align = center><a style='text-decoration:none;' href = 'paymentfunc.php?view=$data[contribID]' title = 'Edit Contribution'><button>Paid</button></a></td>";
										
										/*echo"<form action='paymentfunc.php' method='POST'>";
										echo"<td><input type='submit' name='view' value='View' />";
										echo"</form>"; */
										echo"<tr>";
								}
								echo"</table>";
							?>
						</table>
					<center/>
						<ul>
							<li>
								<a href='contributionedit.php?add'><button>Add</button></a>
							</li>
						</ul><br/>
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
