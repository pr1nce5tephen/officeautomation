	<?php
 error_reporting(0);
	 include('../../config/connection.php');
	 require('../../auth.php');
	 include('../../config/sy.php');
 	confirm_logged_in();
 	check_level();
	 ?>
	 <script src="../../filterJavascript/filter.js" type="text/javascript" charset="utf-8"></script>
			<script src="../../filterJavascript/js/application.js" type="text/javascript" charset="utf-8"></script> 
	<body>
		
		<!--//menu-->


			 <?php include('../../menu/nav.php');?>
<!--<style>#trans{text-transform:uppercase;}#tran{text-transform:capitalize;}</style>-->
				<br/>
				 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 <label for="filter">Search:</label> <input type="text" name="filter" value="" id="filter" />
					<br/>	<br/>
					<center>
		
			<div style="width: 90%; height: 250px; overflow: auto;">	


<table class='menu_tab2' rules="all" width="90%"  border="1">	
		<tr>
								<th> Course Code </th>
								<th> Course Description </th>
								<th> Duration </th>
								<th> Status </th>
								<th colspan="2"> Action </th>
							</tr>
	<?php

$result=mysql_query("select * from course");

while($rows=mysql_fetch_array($result))	{
		$get = $rows['course_stat']; 
		$stat = $get == 'Offered' ? 'Offered' : 'Not Offered';
		$course_id=$rows['course_id'];
		echo'<tr align="center">';
		echo'<td id="trans" >'.$rows['course_code'].'</td>';
		echo'<td id="tran" >'.$rows['course_desc'].'</td>';

if($rows['years'] != null && $rows['months'] != null)
		{
			if($rows['years'] >= 2 && $rows['months'] >= 2)
			{
				echo'<td>'.$rows['years'].' '.years.' and '.$rows['months'].' '.months.'</td>';
			}
			else if($rows['years'] == 1 && $rows['months'] <= 1)
			{
				echo'<td>'.$rows['years'].' '.year.' and '.$rows['months'].' '.month.'</td>';
			}
			else if($rows['years'] >=2 && $rows['months'] <=1 )
			{
				echo'<td>'.$rows['years'].' '.years.' and '.$rows['months'].' '.month.'</td>';
			}
			else 
			{
				echo'<td>'.$rows['years'].' '.year.' and '.$rows['months'].' '.months.'</td>';
			}

		}
		
		else if($rows['years'] == null && $rows['months'] != null)
		{
			if($rows['months'] > 1)
			{
				echo'<td>'.$rows['months'].' '.months.'</td>';
			}
			else
			{
				echo'<td>'.$rows['months'].' '.month.'</td>';
			}
					
		}
		else
		{
			if($rows['years'] > 1)
			{
				echo'<td>'.$rows['years'].' '.years.'</td>';
			}
			else
			{
				echo'<td>'.$rows['years'].' '.year.'</td>';
			}
		
		}
		
		if($stat == 'Offered'){
										echo "<form action='process.php' method='POST' >
											<input type='hidden' name='course_id' value='$rows[course_id]' />
											<input type='hidden' name='status' value='Not Offered' />
											<td><input type='submit' name='course_stat' value='$stat' /></td>
											</form>";
									}
									else{
										echo "<form action='process.php' method='POST' >
											<input type='hidden' name='course_id' value='$rows[course_id]' />
											<input type='hidden' name='status' value='Offered' />
											<td><input type='submit' name='course_stat' value='$stat' /></td>
											</form>";
									}?>
<td><a href="updatecourse.php?course_id=<?php echo $course_id?>"><img src="../images/b_edit.png"></img></a></td>
<td><a href="deletecourse.php?course_id=<?php echo $course_id?>" onclick="return confirm('are you sure you want to delete this data?')"><img src="../images/b_drop.png"></img></a></td>
</tr>
<?php
	 ++$i;
	}
	?>
</center>

</table>
		
	</div>	
			
	  
	
	  <div align='center'class='menu_nav3'>
						
							
								<a style="text-decoration:none;" href='courseadd.php'/><input type="button" value="ADD"/></a>
						
								
			</div>
	  
	  
			
		<p><h2>&nbsp;</h2> 
		</p>
		
		<footer>
			<div class="section">
				<p>
				</p>
			</div>
		
			
			
		</footer>	
	
		<p style="text-align: center; padding: 0px;"></p>
</body>

