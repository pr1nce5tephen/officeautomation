<?php
	 error_reporting(0);
	  include('../../config/connection.php');
	 require('../../auth.php');
	 include('../../config/sy.php');
 	confirm_logged_in();
check_level();
 	$room_code=$_REQUEST['room_code'];
 	 $queryroom = mysql_query("SELECT * FROM rooms,room_sizes WHERE rooms.room_id=room_sizes.room_id AND room_code = '$room_code'");
	$getroom = mysql_fetch_array($queryroom);

	/*$size=mysql_query("SELECT * FROM room_sizes WHERE room_id=$getroom[room_id] ");
	$getsize=mysql_fetch_array($size);*/


if(isset($_POST['save'])){
$room_id=$_POST['room_id'];
$room_size=$_POST['room_size'];

	mysql_query("DELETE FROM room_sizes WHERE room_id='$room_id' ");
	mysql_query("INSERT INTO room_sizes(`id`,`room_id`,`room_size`) VALUES('','$room_id','$room_size')");
 	mysql_query("UPDATE class SET size='$room_size' WHERE room='$room_id' ");
 	echo"<meta http-equiv='refresh' content='0; url=roommain.php'><script>alert('Saved!')</script>";
 	}
 	
 	?>
 	<!DOCTYPE html>
		
<head> 
			<meta charset="utf-8" />
			<title> Western Leyte College </title>
			<meta name="keywords" content="" />
			<meta name="description" content="" />			
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="../../style.css" rel="stylesheet" type="text/css" />
			<script language="javascript" src="../../restriction.js" type="text/javascript"></script>
			
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
 	<table class="menu_tab2" width="10%" rules='all' border="1">
 		<tr><th>Set the Room Size</th></tr>
 		<input type="hidden" name="room_id" value="<?php echo $getroom['room_id'];?>" />
 	<tr><td><input type="text" name="room_size" value="<?php echo $getroom['room_size'] ?>" placeholder="input room size" onkeyup="checkInput2(this)"  /></td></tr>

 	<tr><td><input type="submit" name="save" value="Save"/></td></tr>
 	</table>


 </form>

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
