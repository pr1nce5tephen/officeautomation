<?php 
	require_once('../../auth.php');
	require_once('../../initialize.php');
	include('../../config/sy.php');
	confirm_logged_in();
?>
<!DOCTYPE html>
	<head>
		<title>Registered Students Report</title>
		<!--<link href="css/report.css" rel="stylesheet" type="text/css" />-->
	</head>
	<script language="javascript">
		function docprint()
		{ 
		  var disp_setting="toolbar=no,location=no,directories=no,menubar=no, scrollbars=yes,width=1000, height=600, left=100, top=25"; 
		  var content_vlue = document.getElementById("container").innerHTML; 
		  
		   var docprint=window.open("","",disp_setting);
		   docprint.document.open(); 
		   docprint.document.write('<html><head><title></title><style>table, td, th{border-collapse: collapse;border: 2px solid gray;padding:5px;margin:10px;text-align:center;}</style><body onLoad="self.print()" style="width: 100%; font-size:12px; font-family:arial;">');          
		   docprint.document.write(content_vlue);          
		   docprint.document.write('</body></html>'); 
		   docprint.document.close(); 
		   docprint.focus();
		}
	</script>
<body >
	<center><input type="button" onClick=location.href="javascript:docprint()" value="Print"><a style="text-decoration:none;" href="../course/coursemain.php">&nbsp;<button>Back</button></a></p></center>
	<div id="container">
		
		<div id="print_content">
		
			<?php
			echo'<center/>';
				include ('header.php');
				include ('registeredStudents.php');
				include ('footer.php');
			?>
		</div>
	</div>
</body>