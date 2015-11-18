<?php
	require_once('../../auth.php');
	require_once('../../initialize.php');
	include('../../config/sy.php');
	confirm_logged_in();
?>
<head>
		<title>Payment History</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="report.css" rel="stylesheet" type="text/css" />
		
		
<style>
	table, td, th {
		border-collapse: collapse;
		border: 2px solid gray;
		padding:5px;
		margin:10px;
		text-align: center;
	}
</style>
</head>

<script language="javascript">
function docprint()
{ 
  var disp_setting="toolbar=no,location=no,directories=no,menubar=no, scrollbars=yes,width=1000, height=600, left=100, top=25"; 
  var content_vlue = document.getElementById("print_content").innerHTML; 
  
   var docprint=window.open("","",disp_setting);
   docprint.document.open(); 
   docprint.document.write('<html><head><title></title><style>table, td, th{border-collapse: collapse;border: 2px solid gray;padding:5px;margin:10px;text-align:center;}</style><body onLoad="self.print()" style="width: 100%; font-size:12px; font-family:arial;">');          
   docprint.document.write(content_vlue);          
   docprint.document.write('</body></html>'); 
   docprint.document.close(); 
   docprint.focus();
}
</script>

<!DOCTYPE html>



<div id="container" >
	<p align = center><input type="button" onClick=location.href="javascript:docprint()" value="Print"></p>

	<div id="print_content">

			<?php
				include("header.php");
					
				echo "<center>";
		        if(isset($_REQUEST['view'])){
		        	$studID = $_REQUEST['view'];
		        	$lname = $_REQUEST['lname'];
		        	$fname = $_REQUEST['fname'];
		        	$mi = $_REQUEST['mi'];
		       

		        	echo"
		        	
		        		<h3> Payment history for student $lname, $fname $mi </th>
		        		<table>
		        			<tr>
		        				<th>Contribution</th>
		        				<th>Amount</th>
		        				<th>Semester</th>
		        				<th>Year</th>
		        				<th>Status</th>
		        				<th>Date Paid</th>
		        			</tr>";
		        	$contribution = mysql_query("SELECT * from studentcontribution inner join contribution on studentcontribution.contribID=contribution.contribID where StudID='$studID'");
		        	while($fetchcontrib = mysql_fetch_assoc($contribution)){
		        		$payment = mysql_query("SELECT * from payments where studID='$studID' and contribID = '$fetchcontrib[contribID]'");
		        		echo "
	        				<tr>
	        					<td>$fetchcontrib[contribDesc]</td>
	        					<td>$fetchcontrib[contribAmount]</td>
	        					<td>$fetchcontrib[contribSem]</td>
	        					<td>$fetchcontrib[contribYear]</td>

	        					";
	        					if($fetchpayment=mysql_fetch_assoc($payment)){
	        						echo "
	        							<td>Paid</td>
	        							<td>$fetchpayment[stamp]</td>
	        						";
	        					}
	        					else{
	        						echo "
	        							<td>Unpaid</td>
	        							<td>-</td>
	        						";
	        					}
		        						
		        	}
		        	echo"			
	        				</tr>
	        			</table>
		        	";
		        }  
				
				echo "</center>";
				include("footer.php");
			?>
		<center>
	</div>
</div>
