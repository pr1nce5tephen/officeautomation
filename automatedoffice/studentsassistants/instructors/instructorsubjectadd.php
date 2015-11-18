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
				echo"<meta http-equiv = 'refresh' content='0; url=instructorsubjectadd.php?fcode=$inst' />
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
<table class='menu_tab2' rules='all' border='all' width='50%'>
	<tr>
<th colspan="6"><label id = "label"><h2><?php echo $getinst; ?></h2><br/></label></th></tr>
	<th colspan="6"><label id = "label">Add subject<br/></label></th>


	<tr>
	

		
        <?php 
			$getsubj=mysql_query("SELECT * FROM class,subject WHERE subject_specification = '$spec' AND class.scode=subject.subject_id ORDER BY sem");	
	        while($rowsubj = mysql_fetch_assoc($getsubj)){
			
			$resultinssub=mysql_query("SELECT * FROM instructor_subject where classno = '$rowsubj[classno]' order by classno");
			$rowinstsub = mysql_fetch_assoc($resultinssub);
			
			if($rowinstsub['classno'] == $rowsubj['classno']){
				

			} else {
			?>
			</tr>
			<tr>

		
       <form action='instructorsubjectadd.php' action='POST'>
								
								<input type='hidden' name='classno' value="<?php echo $rowsubj['classno']?>">
								
								
								
								<tr align='center'>
										<td><?php echo $rowsubj['subject_code']?></td>
										<td><?php echo $rowsubj['subject_desc']?></td>
										<td><?php echo $rowsubj['days']?></td>
										<td><?php echo $rowsubj['in'] ?></td>
										<td><?php echo$rowsubj['out'] ?></td>
										
										<td><input type='submit' name='load' value='Load Subject'></td>	
									</tr>
		
        <?php } }?>
        
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
<table class='menu_tab2' rules="all" width="50%"  border="1">

		 <thead><tr><th colspan="6"><label id = "label"> <h2>Subject Load</h2> <br/></label></th></tr>
							<tr>
								<th> ID </th>
								<th> Class </th>
								<th> Start </th>
								<th> End </th>
								<th> Days </th>
								
								<th colspan="2"> Action </th>
							</tr>
		 </thead>
		 <tbody>
	<?php
$search=$_POST['search'];
if($_POST['button']){
$result=mysql_query("SELECT * FROM instructor_subject WHERE instsubj_id='$search' and instructor='$inst_id'  ORDER BY instsubj_id");	
}else{
$result=mysql_query("SELECT * FROM instructor_subject where fcode='$inst'");
}
while($rows = mysql_fetch_assoc($result)){
			$instsubj_id=$rows['instsubj_id'];

$resultget=mysql_query("SELECT * FROM class,subject WHERE class.scode=subject.subject_id AND classno='$rows[classno]'");	
	$rowsshow = mysql_fetch_assoc($resultget);
			
		echo'<tr align="center">';
		echo'<td>'.$rows['instsubj_id'].'</td>';
		echo'<td>'.$rowsshow['subject_code'].'|'.$rowsshow['subject_desc'].'</td>';
		echo'<td>'.$rowsshow['in'].'</td>';
		echo'<td>'.$rowsshow['out'].'</td>';
		echo'<td>'.$rowsshow['days'].'</td>';

		
		echo'<td><a href="instructorsubjectdelete.php?instsubj_id='.$instsubj_id.'&fcode='.$inst.'"><button>Remove</button></a></td>';
		echo'</tr>';
	
		
	}?>



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