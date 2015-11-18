<?php
  session_start();
  error_reporting(0);
  mysql_connect('localhost','root',''); 
  mysql_select_db('automated');
  
   require('../../auth.php');
  confirm_logged_in();

  $time2 = array();
?>
<?php 
  if($_POST["add"]){// Code for Adding Class
           $id = $_REQUEST['set'];
          $subject = $_POST["subject"];
          $subject_course = $_POST["subject_course"];
          $section = $_POST["section"];
          $in = $_POST["in"];
          $out = $_POST["out"];
          $day = $_POST["day"];
          $room = $_POST["parent_cat"];
          $size = $_POST["sub_cat"];
          $sy = $_POST["sy"];
          $sem = $_POST["sem"];
          $status = "Not Full";

         
      $query=mysql_query("SELECT * FROM class WHERE ('$in' BETWEEN `in` AND `out` OR '$out' BETWEEN `in` AND `out`) AND '$day'=`days` AND '$room'=`room` AND '$sem'=`sem` AND '$sy'=`sy` ");
      if($section=='---Section--' OR $in=='---In---' OR $out=='---Out---' OR $day=='----Days----' OR $room=='---Room---' OR $size=='Size' OR $sem=='----Semester----'){
        echo"<meta http-equiv = 'refresh' content = '0; url = classadd.php?set=$subject'/><script>alert('Cannot Create Class Please Choose Correct Data');</script>";
      }

      else if($in==$out){
        echo"<meta http-equiv = 'refresh' content = '0; url = classadd.php?set=$subject'/><script>alert('time error choose another time!');</script>";
      }
          else if(mysql_num_rows($query) > 0){
          echo"<meta http-equiv = 'refresh' content = '0; url = classadd.php?set=$subject'/><script>alert('Schedule not available Choose another Schedule!');</script>";
          }else{
            $query = mysql_query("INSERT INTO `class` (`classno`, `scode`, `course`, `section`, `in`, `out`, `days`, `room`, `size`, `sy`, `sem`, `status`) VALUES ('', '$subject', '$subject_course', '$section', '$in', '$out', '$day', '$room', '$size', '$sy', '$sem', '$status')");
            echo "<script>alert('Successfully Added!');</script>";
            echo"<meta http-equiv = 'refresh' content = '1; url = classadd.php?set=$subject'/>";
          }
          
        }
if(isset($_REQUEST['set'])) {
  $set = $_REQUEST['set'];
  $uid = mysql_query("SELECT * FROM subject WHERE subject.subject_id = '$set' ");
  $data = mysql_fetch_assoc($uid);
  $subject_id=$data['subject_id'];
  $spec = $data['subject_specification'];
  $yrlvl = $data['subject_yrlvl'];
  $course = $data['subject_course'];
  $pop = $data['Pop'];
  $sem = $data['subject_semester'];
  //$disabled = $pop > 0 ? 'disabled' : '';
 }
?>
<!DOCTYPE html>
    <html lang="en">
   
      <meta charset="utf-8" />
      <title> Western Leyte College </title>
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <script language="javascript" src="../subjects/confirmDel.js" type="text/javascript"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="../../style.css" rel="stylesheet" type="text/css" />      
   <script language="javascript" src="../../restriction.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    
  $("#parent_cat").change(function() {
    //$(this).after('<div id="loader"><img src="img/loading.gif" alt="loading subcategory" /></div>');
    $.get('loadsubcat.php?parent_cat=' + $(this).val(), function(data) {
      $("#sub_cat").html(data);
      $('#loader').slideUp(200, function() {
        $(this).remove();
      });
    }); 
    });

});
</script>
    
    <body>

        <?php include('../../menu/nav.php');?>

<br/>
    <center>
    <form action="classadd.php" method="POST">   
    <table class='menu_tab2' rules="all" width="30%"  border="1"><tr><th><?php echo $data['subject_code'].'|'.$data['subject_desc'] ?></th></tr><tr>
      <input type = "hidden" name = "classno" value = "<?php echo $data['classno']; ?>">
      <input type = "hidden" name = "size" value = "<?php echo $data['size']; ?>">
      <input type = "hidden" name = "subject" value = "<?php echo $data['subject_id'] ?>" />
      <input type = "hidden" name = "subject_course" value = "<?php echo $data['subject_course'] ?>" />
        <td>
      <table >
        <tr> 
          <td><input type="hidden" name="subject" value="<?php echo $data['subject_id'] ?>"/></td>         
        </tr>
        <tr>       
          <td><input type="hidden" name="subject_course" value="<?php echo $data['subject_course'] ?>"/></td>       
        </tr>
        <tr><!---row for section-->
          <td>Section:</td>
          <td><select name="section">
            <option>---Section--</option>
              <?php $q = mysql_query("SELECT * FROM section,course WHERE section.section_course=course.course_id AND section_course='$course' AND section_yrlvl='$yrlvl' AND section_sem='$sem' order by section_id");
                        while($r = mysql_fetch_array($q)){
                        $name = $r['course_code'].''.$r['section_yrlvl'].''.$r['section_sem'].''.$r['section_desc']; 
                        ?>
                        <option value="<?php echo $r['section_id'];?>"><?php echo $name ?></option>
                        <?php }?>
            </select>
          </td>
        </tr>
        <tr>
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
                if($hour=="13"){$hour="1";}
              }?>
            </select>
            &nbsp; to &nbsp;
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
                if($hour=="13"){$hour="1";}
              }?>
            </select>
          </td>
        </tr><!---END/row for time-->
        <tr><!---row for day-->
          <td>Day:</td>
          <td>
            <select name="day">
              <OPTION>----Days----</OPTION>
              <OPTION>Monday</OPTION>
              <OPTION>Tuesday</OPTION>
              <OPTION>Wednesday</OPTION>
              <OPTION>Thursday</OPTION>
              <OPTION>Friday</OPTION>
                          </select>
          </td>
        </tr><!---END/row for day-->
        <tr>
        <td><label for="category">Room</label></td>
          <td>

            <select name="parent_cat" id="parent_cat">
        <option>---Room---</option>
        <?php $q = mysql_query("SELECT * FROM rooms WHERE room_specification = '$spec' ORDER BY room_id asc");
        while($r = mysql_fetch_array($q)){
        $name = $r['room_code']; 
        ?>
        <option value="<?php echo $r['room_id'];?>"><?php echo $name ?></option>
        <?php }?>
        </select>
    
   </tr><!---END/row for room-->
        <tr><!---row for size-->
          <td>Size:</td>
    <td><select name="sub_cat" id="sub_cat" readonly><option>Size</option></select></td>
        </tr><!---END/row for size-->
        <tr><!---row for sy-->
          <td>SY:</td>
          <td><label><?php echo date(Y) ."-"; echo date(Y)+1;?></label></td>
          <td><input type='hidden' name="sy" value="<?php echo date(Y) ."-"; echo date(Y)+1;?>"></td>
        </tr><!---END/row for sy-->
        <tr><!---row for sem-->
          <td>Sem:</td>
          <td>
            <select name="sem">
              <OPTION>----Semester----</OPTION>
              <OPTION value="1">1st</OPTION>
              <OPTION value="2">2nd</OPTION>
              <OPTION value="Summer">Summer</OPTION>
            </select>
          </td>
        </tr>
      </table>
      </td></tr></table><br>
      <input name="add" type="submit" value="Create" />
     
 <a style="text-decoration:none;" href='createClass.php'/><input type="button" value="Back"/></a>
            
                
      
    


    </form></center>
  <p><h2>&nbsp;</h2> 
    </p>
    
    <footer>
      <div class="section">
        <p>
        </p>
      </div>
      
      
      
    </footer> 

    <p style="text-align: center; padding: 0px;"></p>
</body>

</html>