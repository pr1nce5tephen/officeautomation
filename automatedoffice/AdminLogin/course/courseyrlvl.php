<?php
error_reporting(0);
	 include('../../config/connection.php');
	 require('../../auth.php');
	 include('../../config/sy.php');
 	confirm_logged_in();
 	check_level();	 
$id=$_REQUEST['course'];
 $querycourse = mysql_query("SELECT * FROM course where course_code = '$id'");
	$getcourse = mysql_fetch_array($querycourse);	
  //$submit=$_POST['btnsave'];
$years=$_REQUEST['years'];	
		for($b=1; $b<=$years; $b++){
				mysql_query("insert into course_yrlvl values('','" .$id. "','" .$b. "')");
	/****/
		}	
		echo"<meta http-equiv = 'refresh' content='0; url=coursemain.php' />";

?>
<!--	
<!DOCTYPE html>
		
<head> 
			<meta charset="utf-8" />
			<title> Western Leyte College </title>
			<meta name="keywords" content="" />
			<meta name="description" content="" />
			<script language="javascript" src="../subjects/confirmDel.js" type="text/javascript"></script>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="../../style.css" rel="stylesheet" type="text/css" />
			
		</head>
		
		<body>
			<div id="wrapper">
				<div id="callout">
                    <br/>
                    <center>
                        
                        <b>Office Automation System for Western Leyte College, Ormoc City

                    <p>
                    
              </div>
				<br/>
        <center>
        <form method="post" action="">
        	<table class="menu_tab2" width="40%" rules='all' border="1">
      	<tr><th>Course</th><th>Year Levels</th></tr>
        <?php for($a=1; $a<=$getcourse['years']; $a++) { ?>
      
          <tr align="center">
          	<td>
			
			<input type="hidden" name="years" value="<?php echo $getcourse['years'];?>">
			<input type="hidden" name="course" value="<?php echo $getcourse['course_id'];?>">
            <input type="hidden" name="yr" value="<?php echo $a;?>">
			<?php echo $getcourse['course_code']."|".$getcourse['course_desc'];?></td>
            <td><?php echo $a;?></td>
            
         
          </tr>
        
		<?php }?>
</table>
        <table width="30%" border="0">
  <tr align="center">
    <td><input type="submit" name="btnsave" value="SAVE"/></td>
    
  </tr>
</table>

        </form>
        


        </center>
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
</body>-->
