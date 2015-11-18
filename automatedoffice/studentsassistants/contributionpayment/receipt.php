<?php
	require_once('../../auth.php');
	require_once('../../initialize.php');
	confirm_logged_in();
	check_level();
?>
<link href="style.css" media="screen" rel="stylesheet" type="text/css" />
<script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=800, height=600, left=100, top=25"; 
  var content_vlue = document.getElementById("content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 800px; font-size: 13px; font-family: arial;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>
<a href="javascript:Clickheretoprint()" style="font-size:20px";>Print</a>|<a href="contribution.php" style="font-size:20px";>Back</a>
<br>
<br>

<div class="content" id="content">

	<?php
	$contribID=$_REQUEST['add'];
	$studID = $_REQUEST['studID'];
	$amount = $_REQUEST['amount'];
	 $ss=mysql_query("SELECT * FROM studentcontribution,student WHERE studentcontribution.StudID = student.control_number AND studID ='$studID'");
	 $sss = mysql_fetch_array($ss);
	 $stud = $sss['lname'].','.$sss['fname'].' '.$sss['mi'].'.'; 

	 $or=mysql_query("SELECT * FROM payments WHERE studID='$sss[StudID]' ");
	 $orc=mysql_fetch_array($or);

	$con=mysql_query("SELECT * FROM contribution WHERE contribID='$contribID'");
	 $p=mysql_fetch_array($con);
	?>
	<!--<div style="width: 100%; height: 190px;" >-->
	<!--<div style="width: 459px; float: left;">-->
	<center/>
	<h1><b>Western Leyte College</b></h1>
	A. Bonifacio St., Ormoc City,Leyte<br>
	6541 Philippines<br>
	Tel Nos.: (053)561-5310/2558549<br/><br/> 		
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<div style="color:#CC0033;"> <b>OR No. :<?php echo $orc['ornum'] ?>	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Date:<?php echo $orc['stamp'] ?></b></div><br/>

	

	
<table rules="groups">
	<tr>
		<td>Received From:</td><td>&nbsp;</td><td><?php echo $stud?></td>
	</tr>
	<tr>	
		<td>Address:</td><td>&nbsp;</td><td><?php echo $sss['address'] ?></td>
	</tr>
	<tr>
		<td>The Amount of:</td><td>&nbsp;</td><td><?php echo $p['contribAmount'] ?></td>
	</tr>
	<tr>
		<td>As full payment of:</td><td>&nbsp;</td><td><?php echo $p['contribDesc'] ?></td>
	</tr>
	<tr>
		<td>Contact No:</td><td>&nbsp;</td><td><?php echo $sss['contact_number'] ?></td>
	</tr>
	
	
		
</table>
<?php include('footer.php');?>	
	</div>
	
		
	
<br/>
	 
					 
					 
				
			
	
	
	<div class="clearfix"></div>
	

	<div style="width: 100%">
		
	<!--<table cellspacing="0" style="font-size: 20px;text-align:left;" width="100%">
		<thead>
			<tr> 
				<td> Contribution: <?php //echo $p['contribDesc'] ?></td>
			</tr>
		</thead>
		<tbody>
			
				<tr>
					<td colspan="5" style="font-size: 20px; color: #222222;">Amount:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php //echo $p['contribAmount'] ?></td>
					 
					 
					</strong></td>
				</tr>
			
				
			
		</tbody>-->

	
	</div>
	
<!--<div style="text-align: right; margin-top: 13px;">Cashier : <?php //echo $cashier ?></div>-->
</div>
</div>






