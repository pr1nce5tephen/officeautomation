<?php
  require_once('../../auth.php');
  require_once('../../initialize.php');
  include('../../config/sy.php');
  confirm_logged_in();

if(isset($_SESSION['coursename'])){
  $name = $_SESSION['coursename'];
}
?>
<script language="javascript">
	function docprint()
		{ 
		  var disp_setting="toolbar=no,location=no,directories=no,menubar=no, scrollbars=yes,width=1000, height=600, left=100, top=25"; 
		  var content_vlue = document.getElementById("print_content").innerHTML; 
		  
		   var docprint=window.open("","",disp_setting);
		   docprint.document.open(); 
		   docprint.document.write('<html><head><title></title><style>table, td, th{border-collapse: collapse;border: 1px solid gray;padding:5px;margin:10px;text-align:center;}</style><body onLoad="self.print()" style="width: 100%; font-size:12px; font-family:arial;">');          
		   docprint.document.write(content_vlue);          
		   docprint.document.write('</body></html>'); 
		   docprint.document.close(); 
		   docprint.focus();
		}
</script>
<html>
  <head>
    <title>Report Print Preview</title>
  <link href="css/report.css" rel="stylesheet" type="text/css" />  
  </head>
  <body>
<?php
  if(isset($_REQUEST['courseprint'])){
    $checkbox = $_REQUEST['checkbox']; 
    $countCheck = count($_REQUEST['checkbox']);
?> 
<p align="center"><input type="button" onClick=location.href="javascript:docprint()" value="Print"> <a href="../course/coursemain.php"><button>Back</button></a></p>           
<form action="courserepprint.php" method="post">
<div id="container">
 <div id="print_content">
 <center>
 <?php include("header.php"); ?>
<h2><?php echo $name; ?></h2><u><h3>List of Enrolled Students in this Course</h3></u>
 <table cellpadding="1" cellspacing="1" border="1" rules='all' width='60%'>
            <thead>
              <tr>
                <th align = 'center' >Student Control Number</th>
                <th align = 'center' >Student First Name</th>
                <th align = 'center' >Student Middle Name</th>
                <th align = 'center' >Student Last Name</th>
              </tr>
            </thead>
            <tbody>
            <?php
              for($i=0;$i<$countCheck;$i++){
              $studid = $checkbox[$i];
              $getdata = mysql_query("SELECT * FROM student WHERE student_id = '$studid'")or die(mysql_error());
              $row = mysql_fetch_assoc($getdata);

                  echo '<tr>';
                  echo '<td><div align="center">'.$row['control_number'].'</div></td>';
                  echo '<td><div align="center">'.$row['fname'].'</div></td>';
                  echo '<td><div align="center">'.$row['mi'].'</div></td>';
                  echo '<td><div align="center">'.$row['lname'].'</div></td>';
                  echo '</tr>';
                }
              ?> 
            </tbody>
        </table>
		<?php include("footer.php"); ?>
		</center>
</div>
</div>
 <?php
              if(empty($checkbox)){
               echo "<script> alert('Check the box for you to print a record(s)!'); </script>";
               echo"<meta http-equiv = 'refresh' content = '0; url= coursestud.php'/>"; 
               }
          } 
          ?>       

</form>
  </body>
</html>