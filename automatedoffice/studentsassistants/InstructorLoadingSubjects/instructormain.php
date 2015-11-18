	<?php
 error_reporting(0);
	  include('../../config/connection.php');
	 require('../../auth.php');
	 include('../../config/sy.php');
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
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="../../style.css" rel="stylesheet" type="text/css" />
			<script src="../../filterJavascript/filter.js" type="text/javascript" charset="utf-8"></script>
			<script src="../../filterJavascript/js/application.js" type="text/javascript" charset="utf-8"></script> 
			
		</head>
		
		<body>
			
      <!---menu-->


      <?php include('../../menu/nav2.php');?>

				<br/>
			 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;				
        <label for="filter">Search</label> <input type="text" name="filter" value="" id="filter" />
			</center>
				<header>
					<br/>
					<center>
					<table class='menu_tab2' rules="all" width="90%"  border="1" id="resultTable">
							<tr>

								<th> Name </th>
								<th> Address </th>
								<th> Gender </th>
								<th> Contact Number </th>
								<!--<th> Rate </th>-->
								<th> Position </th>
								<th> Option </th>
								<th> Teaching Type </th>
								
							</tr>
					
							<?php
							$query = mysql_query("SELECT * FROM faculty,specification WHERE faculty.teaching_type=specification.specification_id order by lname") or die(mysql_error());
									if(mysql_num_rows($query)>0){ 
										while($data = mysql_fetch_array($query)) {
										$status = $data['status'];
										$msg = $status == 'active' ? 'Active' : 'Inactive';
							?>
							<tbody>
								<tr>
									 
									<td align='center'><?php echo $data["lname"].", ".$data["fname"]." ".$data["mi"] ?> </td>
									<td align='center'><?php echo $data["address"] ?></td>
									<td align='center'><?php echo $data["gender"] ?></td>
									<td align='center'><?php echo $data["contactno"] ?></td>
									<!--<td align='center'><?php// echo $data["rate"] ?></td>-->
									<td align='center'><?php echo $data["position"] ?></td>
									<td align='center'><a style="text-decoration:none;" href = 'instructorsubjectadd.php?fcode=<?php echo $data['fcode'] ?>'>Assign Class</a></td>
									<td align='center'><?php echo $data["specification"] ?></td>
									
									</td>
									
									<!--<td align='center'>Edit</td>-->
									
								</tr>
							
									</td>
									
								</tr>
							</tbody>
							<?php
										}	
									}
										++$i;
							?>

</center>
	</table>
	</header>

		
		
			
	  
	
	  <div align='center'class='menu_nav3'>
						
							
								
						
								
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