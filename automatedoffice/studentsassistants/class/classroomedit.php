<?php
  include('../../config/connection.php');
 include('../../config/sy.php');
   require('../../auth.php');
  confirm_logged_in();
  check_level();
  $sched_id=$_REQUEST['sched_id'];
  $rid=$_REQUEST['rid'];
  $tid=$_REQUEST['tid'];


  $room=mysql_query("SELECT * FROM rooms,specification WHERE rooms.room_specification=specification.specification_id AND room_id='$rid'");
  $getroom=mysql_fetch_array($room);

if(isset($_POST['save']))
{
      /*$check=mysql_query("SELECT * FROM schedules WHERE time_id='$tid' AND room_id='$rid'");
    if(mysql_num_rows($check) > 0)
      {
        echo"<script>alert('room not available')</script>";
      }else{*/
        mysql_query("UPDATE schedules SET room_id='$_POST[rid]' WHERE sched_id='$sched_id'");
        echo"<meta http-equiv='refresh' content='0; url=classmenu.php'><script>alert('class room has been updated')</script>";
      //}
}
?>

<!DOCTYPE html>
    <html lang="en">
    <head> 
      <meta charset="utf-8" />
      <title> Western Leyte College </title>
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <script language="javascript" src="../subjects/confirmDel.js" type="text/javascript"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="../../style.css" rel="stylesheet" type="text/css" />
      <script language="javascript" src="../../restriction.js" type="text/javascript"></script>
      
    </head>
    
    <body>
      
      <?//menu?>


       <?php include('../../menu/nav2.php');?>

<header>
          <br/>

<center>
<form action="" method="post">
<table class='menu_tab2' rules="all" width="30%"  border="1">
  <th colspan="2"><label id = "label">Edit Class Room</label></th>
  <tr>
    <td>Rooms:</td>
    <td>
      <select name="rid">
        <option value="<?php echo $getroom['room_id']?>"><?php echo $getroom['room_code'].'|'.$getroom['room_description'].' / '.$getroom['specification']?></option>
        <?php 
          $r=mysql_query("SELECT * FROM rooms,specification WHERE NOT EXISTS(SELECT * FROM schedules WHERE rooms.room_id=schedules.room_id)AND rooms.room_specification=specification.specification_id AND room_id != '$getroom[room_id]'");
          while($getr=mysql_fetch_array($r)){
        ?>
        <option value="<?php echo $getr['room_id']?>"><?php echo $getr['room_code'].'|'.$getr['room_description'].'|'.$getr['specification']?></option>
        <?php } ?>
      </select>
    </td>
  </tr>
  
<tr></tr>
  <tr>
    <td>&nbsp;</td><td><input type="submit" name="save" value="save"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="reset"/></td>
    
  </tr>
  
  
  
</table>
</form>
</center>

  </header>
  
<div align='center'class='menu_nav3'>
            
              
                <a style="text-decoration:none;" href='classmenu.php'/><input type="button" value="Back"/></a>
            
                
      </div>

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