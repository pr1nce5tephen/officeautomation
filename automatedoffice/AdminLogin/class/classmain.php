<?php
  session_start();
  error_reporting(0);
  mysql_connect('localhost','root',''); 
  mysql_select_db('automated');

  $time2 = array();
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
      <link href="../style.css" rel="stylesheet" type="text/css" />
      
    </head>
    
    <body>

      <?//menu?>


        <?php include('../menu/nav.php');?>

<br/>
    <center>
    <form action="classmain.php" method="POST">
      <?php
        if($_POST["set"]){// Class Form
      ?>
      <table class='menu_tab2' rules="all" width="30%"  border="1"><tr><th>CLASS FORM</th></tr><tr><td>
      <table ><!---Table For Adding Class-->
        <tr><!---row for subject-->
          <td>Subject:</td>
          <td>
            <select name="subject">
              <OPTION>---------</OPTION>
              <?php $q = mysql_query("SELECT * FROM subject order by subject_id");
                        while($r = mysql_fetch_array($q)){
                        $name = $r['subject_code']; 
                        ?>
                        <option value="<?php echo $r['subject_id'];?>"><?php echo $name ?></option>
                        <?php }?>
            </select>
          </td>
        </tr><!---END/row for subject-->
        <tr><!---row for section-->
          <td>Section:</td>
          <td><select name="section">
              <?php $q = mysql_query("SELECT * FROM section order by section_id");
                        while($r = mysql_fetch_array($q)){
                        $name = $r['section_desc']; 
                        ?>
                        <option value="<?php echo $r['section_id'];?>"><?php echo $name ?></option>
                        <?php }?>
            </select>
          </td>
        </tr><!---END/row for section-->
        <tr><!---row for time-->
          <td>Time:</td>
          <td>
            <select name="in">
              <OPTION>---In---</OPTION>
              <?php 
                $hour=7;
                for($x=1;$x<=24;$x++){
                  if($x%2==0){$sec="00";}
                  else{$sec="30";}
                  if($x==10){$a="NN";}
                  else if($x<=9 ){$a="AM";}
                  else if($x<=24){$a="PM";}
                  $time2[$x]=$hour . ":" .$sec . " " .$a;
              ?>
              <OPTION><?php echo $time2[$x]; ?></OPTION>
              <?php 
                if($sec=="30"){$hour++;}
                if($hour==13){$hour=1;}
              }?>
            </select>
            &nbsp to &nbsp
            <select name="out">
              <OPTION>---Out---</OPTION>
              <?php 
                $hour=7;
                for($x=1;$x<=24;$x++){
                  if($x%2==0){$sec="00";}
                  else{$sec="30";}
                  if($x==10){$a="NN";}
                  else if($x<=9 ){$a="AM";}
                  else if($x<=24){$a="PM";}
                  $time2[$x]=$hour . ":" .$sec . " " .$a;
              ?>
              <OPTION><?php echo $time2[$x]; ?></OPTION>
              <?php 
                if($sec=="30"){$hour++;}
                if($hour==13){$hour=1;}
              }?>
            </select>
          </td>
        </tr><!---END/row for time-->
        <tr><!---row for day-->
          <td>Day:</td>
          <td>
            <select name="day">
              <OPTION>------</OPTION>
              <OPTION>MWF</OPTION>
              <OPTION>TTH</OPTION>
              <OPTION>MW</OPTION>
              <OPTION>MF</OPTION>
              <OPTION>WF</OPTION>
            </select>
          </td>
        </tr><!---END/row for day-->
        <tr><!---row for room-->
          <td>Room:</td>
          <td>
            <select name="room">
              <OPTION>-----Select room-----</OPTION>
              <?php $q = mysql_query("SELECT * FROM rooms order by room_id");
                        while($r = mysql_fetch_array($q)){
                        $name = $r['room_code']; 
                        ?>
                        <option value="<?php echo $r['room_id'];?>"><?php echo $name ?></option>
                        <?php }?>
            </select>
          </td>
        </tr><!---END/row for room-->
        <tr><!---row for size-->
          <td>Size:</td>
          <td>
            <select name="size">
              <OPTION>-------</OPTION>
              <OPTION>30</OPTION>
              <OPTION>35</OPTION>
              <OPTION>40</OPTION>
              <OPTION>45</OPTION>
              <OPTION>50</OPTION>
            </select>
          </td>
        </tr><!---END/row for size-->
        <tr><!---row for sy-->
          <td>SY:</td>
          <td><input name="sy" value="<?php echo date(Y) ."-"; echo date(Y)+1;?>"></td>
        </tr><!---END/row for sy-->
        <tr><!---row for sem-->
          <td>Sem:</td>
          <td>
            <select name="sem">
              <OPTION>-------</OPTION>
              <OPTION>1st</OPTION>
              <OPTION>2nd</OPTION>
              <OPTION>Summer</OPTION>
            </select>
          </td>
        </tr><!---END/row for sem-->
        <tr><!---row for instructor-->
          <td>Instructor:</td>
          <td>
            <select name="ins">
              <OPTION>------</OPTION>
              <?php $q = mysql_query("SELECT * FROM faculty WHERE status='active' order by fcode");
                        while($r = mysql_fetch_array($q)){
                        $name = $r['lname']; 
                        ?>
                        <option value="<?php echo $r['fcode'];?>"><?php echo $name ?></option>
                        <?php }?>
            </select>
          </td>
        </tr><!---END/row for instractor-->
      </table><!---END/Table For Adding Class-->
      </td></tr></table><br>
      <input name="add" type="submit" value="ADD">
     
            
              
                <a style="text-decoration:none;" href='classmain.php'/><input type="button" value="Back"/></a>
            
                
      
      <?php
        
      ?>
      <?php   
        }// END/Class Form
        else if($_POST["add"]){// Code for Adding Class
          $subject = $_POST["subject"];
          $section = $_POST["section"];
          $in = $_POST["in"];
          $out = $_POST["out"];
          $day = $_POST["day"];
          $room = $_POST["room"];
          $size = $_POST["size"];
          $sy = $_POST["sy"];
          $sem = $_POST["sem"];
          $ins = $_POST["ins"];
          $status = "Not Full";

          $query1 = mysql_query("SELECT * FROM  `faculty` where `lname`='$ins'");
          $data = mysql_fetch_array($query1);
          $fcode = $data["fcode"];

          $query2 = mysql_query("SELECT count(`scode`) FROM  `class` where (`room`= '$room' and `days`='$day' and `fcode`='$ins') and (`sy`='$sy' and `sem`='$sem') and (`in`='$in' and `out`='$out')");
            
          
          if(mysql_result($query2, 0) != 0){
            echo "Conflict Schedule:";
            echo "$day";
            echo "&nbsp;";
            echo "$in";
            echo "&nbsp;";
            echo "$out";
           
            
            
          $query3 = mysql_query("SELECT * FROM  `class` where (`room`= '$room' and `days`='$day') and (`sy`='$sy' and `sem`='$sem')");
          $data2 = mysql_fetch_array($query3);
          
          $conflict=0;
          $index1=array();
          $index2=array();
          for($x=1;$x<=24;$x++){
            if($time2[$x] == $data2["in"]){
              for($y=0;$y<=24;$y++){
                $index1[$y]=$time2[$x];
                $x++;
                if($time2[$x]== $data2["out"]){
                  break;
                }
              }
            }
          }
          for($x=1;$x<=24;$x++){
            if($time2[$x] == $in){
              for($y=0;$y<=24;$y++){
                $index2[$y]=$time2[$x];
                $x++;
                if($time2[$x]== $out){
                  break;
                }
              }
            }
          }
          for($x=0;$x<=count($index2);$x++){
            for($y=0;$y<=count($index1);$y++){
              if($index2[$x]==$index1[$y]){
                $conflict=1;
              }
            }
          }
        }

          if($conflict != 0){
            echo "<script>alert('Conflict in Schedule!');</script>";
            echo"<meta http-equiv = 'refresh' content = '1; url = classmain.php'/>";
          }else{
            $query = mysql_query("INSERT INTO `class` (`classno`, `scode`, `section`, `in`, `out`, `days`, `room`, `size`, `sy`, `sem`, `fcode`, `status`) VALUES ('', '$subject', '$section', '$in', '$out', '$day', '$room', '$size', '$sy', '$sem', '$ins', '$status')");
            echo "<script>alert('Successfully Added!');</script>";
            echo"<meta http-equiv = 'refresh' content = '1; url = classmain.php'/>";
          }
          
        }// END/Code for Adding Class
        else{ // Main interface
      ?>
      
      <table class='menu_tab2' rules="all" width="100%"><!---Table For List of Classes-->
        <tr align="center"><th colspan="12" ><h2>Class List</h2></th></tr>
        <tr>
          <th>Subject</th>
          <th>Section</th>
          <th>Start</th>
          <th>End</th>
          <th>Days</th>
          <th>Room</th>
          <th>Size</th>
          <th>School Year</th>
          <th>Semester</th>
          <th>Instructor</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        <?php
          $query = mysql_query("SELECT DISTINCT * FROM class as c, rooms as r, subject as s, faculty as f, section as se where f.fcode=c.fcode and s.subject_id=c.scode and r.room_id=c.room and f.status='active'"); 
          while($data = mysql_fetch_array($query)){//loop for getting data in the database(table:class)
        ?>
        <tr>
          <td><?php echo $data["subject_code"]."|".$data["subject_desc"]; ?></td>
          <td><?php echo $data["section_desc"]; ?></td>
          <td><?php echo $data["in"]; ?></td>
          <td><?php echo $data["out"];?></td> 
          <td><?php echo $data["days"]; ?></td>
          <td><?php echo $data["room_code"]." | ".$data["room_description"]; ?></td>
          <td><?php echo $data["Pop"]." / ".$data["size"]; ?></td>
          <td><?php echo $data["sy"];?></td> 
          <td><?php echo $data["sem"]; ?></td>
          <td><?php echo $data["lname"].", ".$data["fname"]."&nbsp;".$data["mi"]; ?></td>
          <td><?php echo $data["status"]; ?></td>
          <td><a href = 'delete.php?delete=<?php echo $data['classno'] ?>'>DELETE</a></td>
        </tr>
        <?php } //END of the loop(table:class)?>
      </table><!---END/Table For List of Classes-->
      <br><input type="submit" name="set" value="Add Class">
      <?php }// END/Main interface ?>     
    </form></center>
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