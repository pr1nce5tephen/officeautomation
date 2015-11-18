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
<a href="javascript:Clickheretoprint()" style="font-size:20px";>Print</a>|<a href="paymentfunc.php" style="font-size:20px";>Back</a>
<br>
<br>

<div class="content" id="content">
<div style="margin: 0 auto; padding: 20px; width: 700px; font-weight: normal;">
	<div style="width: 100%; height: 190px;" >
	<div style="width: 459px; float: left;">
	<h2><i>Western Leyte College</i></h2><br/>
	Street Address<br>
	Brgy<br>
	TIN:<br>
	Contact No : <br>
	Email Add : <br>
	<div>

	<?php
	$contribID=$_REQUEST['add'];
	$studID = $_REQUEST['studID'];
	$amount = $_REQUEST['amount'];
	 $ss=mysql_query("SELECT * FROM studentcontribution,student WHERE studentcontribution.StudID = student.control_number AND studID ='$studID'");
	 $sss = mysql_fetch_assoc($ss);
	 $stud = $sss['lname'].','.$sss['fname']; 
	?>

	<table border="1" cellpadding="4" cellspacing="0" style="font-family: arial; font-size: 12px;text-align:left;width : 100%;">
		<tr>
			<td width="25%">Received From : </td>
			<td width="75%"><?php echo $stud?></td>
		</tr>
		<tr>
			<td width="25%">Address : </td>
			<td width="75%"><?php echo $stud ?></td>
		</tr>
		<tr>
			<td width="25%">Contact No : </td>
			<td width="75%"><?php echo $contact ?></td>
		</tr>
	</table>
	</div>
	</div>
	<div style="width: 236px; float: right; height: 178px;">
		<br/><br/><br/>
	<table border="0" cellpadding="4" cellspacing="0" style="font-family: arial; font-size: 12px;text-align:left;width : 100%;">
		<tr>
			<td colspan="2"><div style="text-align: center; font-weight: bold;">
			
			<?php
			 
			?>
			</div></td>
		</tr>
		<br/><br/><br/>
		<tr>
			<td>OR No.</td>
			<td><?php echo $invoice ?></td>
		</tr>
		<tr>
			<td>Date</td>
			<td><?php echo $date ?></td>
		</tr>
		 
	</table>
	
	</div>
	<div class="clearfix"></div>
	</div>

	<div style="width: 100%">
		<br/><br/><br/><br/>
	<table border="1" cellpadding="2" cellspacing="0" style="font-family: arial; font-size: 12px;text-align:left;" width="100%">
		<thead>
			<tr> 
				<th> Contribution Name:</th>
				<th> Amount </th>
			</tr>
		</thead>
		<tbody>
			
				<tr>
					<td colspan="5"><strong style="font-size: 12px; color: #222222;">Total:</strong></td>
					 
					 
					</strong></td>
				</tr>
				 
				<tr>
					<td colspan="5"><strong style="font-size: 12px; color: #222222;">Cash Tendered:</strong></td>
					 
					 
					</strong></td>
				</tr>
				 
				
			
		</tbody>
	</table>
	</div>
	
<div style="text-align: right; margin-top: 13px;">Cashier : <?php echo $cashier ?></div>
</div>
</div>



<?php include('footer.php');?>


