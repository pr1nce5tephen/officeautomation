	<?php
	  error_reporting(0);
	  include('../../config/connection.php');
	 require('../../auth.php');
	 include('../../config/sy.php');
 	confirm_logged_in();
	check_level();
		 $submit=$_POST['btnsave'];
		 $class=$_POST['class'];
	
		 $inst=$_REQUEST['fcode'];
$resultint=mysql_query("SELECT * FROM faculty WHERE fcode='$inst'");	
$rowsinst = mysql_fetch_assoc($resultint);
$getinst = $rowsinst['lname'].','.$rowsinst['fname'].' '.$rowsinst['mi'];;
$instructor_id = $rowsinst['fcode'];
$spec = $rowsinst['teaching_type'];
//echo"<center/>";
 
	if(isset($_REQUEST['load']))
	{
		$class	= $_REQUEST['classno'];
				mysql_query("insert into instructor_subject values('','" .$instructor_id. "','" .$class. "')");
				echo"<meta http-equiv = 'refresh' content='0; url=instructorsubjectadd.php?fcode=$instructor_id' />
											<script type='text/javascript'>
											alert('Record Added');
											</script>";

				/****/
			}
		else
			{
				echo"<meta-http='refresh' content='0; url=timemain.php' />
				<script>alert(An Error Occured!);
				</script>";
			}
			
	
	 
	?>
<!--menu-->
		<?php include('../../menu/nav2.php');?>
<center>
	
<br/>
<form action="" method="post">
<table class='menu_tab2' rules='all' border='all' width='80%'>
	<tr>
<th colspan="6"><label id = "label"><h2><?php echo $getinst; ?></h2><br/></label></th></tr>
	<th colspan="6"><label id = "label">Add subject<br/></label></th>


	<tr>
	

		
        <?php 
			$getsubj=mysql_query("SELECT * FROM bscheds,subject WHERE NOT EXISTS(SELECT * FROM instructor_subject WHERE bscheds.sched_id=instructor_subject.classno) AND bscheds.subject_id=subject.subject_id AND subject.subject_specification='$spec'");	
	        
	        while($rowsubj = mysql_fetch_assoc($getsubj)){
			if(!$getsubj){

			}else{
	
			?>
			</tr>
			<tr>

		
       <form action='instructorsubjectadd.php' action='POST'>
								
								<input type='hidden' name='classno' value="<?php echo $rowsubj['sched_id']?>">
								<input type='hidden' name='instructor' value="<?php echo $instructor_id?>">
								
								
								
								<tr align='center'>
										<td><?php echo $rowsubj['subject_code']?></td>
										<td><?php echo $rowsubj['subject_desc']?></td>
										<td><?php echo $rowsubj['monday'].' '.$rowsubj['tuesday'].' '.$rowsubj['wednesday'].' '.$rowsubj['thursday'].' '.$rowsubj['friday']?></td>
										<td><?php echo $rowsubj['in'].''.$rowsubj['type']  ?></td>
										<td><?php echo $rowsubj['out'].''.$rowsubj['type'] ?></td>
										
										<td><input type='submit' name='load' value='Assign Class'></td>	
									</tr>
		</form>
		
        <?php } } ?>
        
	</tr>
	
	

	

	<!--<tr>
		<td>&nbsp;</td><td><center/><input type="submit" name="btnsave" value="add"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="reset"/></td>
		
	</tr>-->
</table>
</form>
</center>


<?php 
echo'<h2>';
$inst=$_REQUEST['fcode'];
$resultint=mysql_query("SELECT * FROM faculty WHERE fcode='$inst'");	
$rowsinst = mysql_fetch_assoc($resultint);
$instfull =  $rowsinst['lname'].','.$rowsinst['fname'];
//$inst_id = $rowsinst['fcode'];
//echo $rowsinst['lname'].','.$rowsinst['fname'];
echo'</h2>';
?>


<hr width="90%"/>

				<center/>
<table class='menu_tab2' rules="all" width="80%"  border="1">

		 <thead><tr><th colspan="5"><label id = "label"> <h2>Subject Load</h2> <br/></label></th></tr>
							<tr>
								<th> ID </th>
								<th> Class </th>
								<th colspan=""> Time </th>
								<th> Days </th>
								
								<th colspan="2"> Action </th>
							</tr>
		 </thead>
		 <tbody>
	<?php

$getsubj=mysql_query("SELECT * FROM instructor_subject,bscheds,subject WHERE instructor_subject.classno=bscheds.sched_id AND bscheds.subject_id=subject.subject_id AND instructor_subject.fcode='$instructor_id'");	
	if(mysql_num_rows($getsubj) > 0){       
	        while($rowsubj = mysql_fetch_assoc($getsubj)){
		
		echo'<tr align="center">';
		echo'<td>'.$rowsubj['instsubj_id'].'</td>';
		echo'<td>'.$rowsubj['subject_code'].'|'.$rowsubj['subject_desc'].'</td>';
		echo'<td>'.$rowsubj['in'].'-'.$rowsubj['out'].' '.$rowsubj['type'].'</td>';
		echo'<td>'.$rowsubj['monday'].' '.$rowsubj['tuesday'].' '.$rowsubj['wednesday'].' '.$rowsubj['thursday'].' '.$rowsubj['friday'].'</td>';

		
		echo'<td><a href="instructorsubjectdelete.php?instsubj_id='.$rowsubj['instsubj_id'].'&fcode='.$inst.'"><button>Remove</button></a></td>';
		echo'</tr>';
	
		
	} }else{   ?>

	<td colspan="6" align="center">no results found</td>
<?php } ?>
</tbody>
</table>
			
								<a style="text-decoration:none;" href='instructormain.php'/><input type="button" value="Back"/></a>
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