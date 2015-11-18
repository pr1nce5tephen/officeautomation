<?php
  include('../../config/connection.php');
  include('../../config/sy.php');
  require('../../auth.php');
  confirm_logged_in();
  check_level();
if(isset($_REQUEST['add']))
{
  $da=date(Y) + 1;
  $date=date(Y);
    $parent_cat=$_POST['parent_cat'];
    $sub_cat=$_POST['sub_cat'];
    $section=$_POST['section'];
    $sem=$_POST['sem'];

$yr=mysql_query("SELECT * FROM sy WHERE school_yr='$date' AND school_yr2='$da' ");
$syr=mysql_fetch_array($yr);
$sy_id=$syr['sy_id'];

$c=mysql_query("SELECT count(DISTINCT schedules.section_id) FROM schedules WHERE course_id='$parent_cat' AND yrlvl='$sub_cat' AND sem='$sem' AND sy_id='$sy_id' ");
$getc=mysql_fetch_array($c);
$count=$getc[0];

$h=mysql_query("SELECT * FROM course WHERE course_id='$parent_cat'");
$i=mysql_fetch_array($h);
//$count=$getc;
//$co=count($getc);
echo"<center><br/><br/><br/><br/><br/><br/><span style='width:20%;text-align:center; color:red;'>";
  if($count > 0)
  {
    if($count == 1)
    {
      if($section == 1)
      {
        echo"$i[course_code]$sub_cat$sem already have $getc[0] section <br/>are you sure you want to add $section more section for this course?";
      }
      else
      {
        echo"$i[course_code]$sub_cat$sem already have $getc[0] section <br/>are you sure you want to add $section more sections for this course?";
      }
    }
    else
    {
     if($section == 1)
      {
        echo"$i[course_code]$sub_cat$sem already have $getc[0] section <br/>are you sure you want to add $section more section for this course?";
      }
     else
      {
        echo"$i[course_code]$sub_cat$sem already have $getc[0] section <br/>are you sure you want to add $section more sections for this course?";
      } 
    }
    ?>
    <br/><br/>
    <a href="sched2.php?parent_cat=<?php echo $parent_cat ?>&&sub_cat=<?php echo $sub_cat ?>&&section=<?php echo $section ?>&&section2=<?php echo $section ?>&&sem=<?php echo $sem ?>"><button>Yes</button></a>
    <a href="classmenu.php"><button>No</button></a>
    <?php
    echo"</span>";
  }
  else
  {
    echo"<meta http-equiv='refresh' content='0; url=sched.php?parent_cat=$parent_cat&&sub_cat=$sub_cat&&section=$section&&sem=$sem'>";
  }
} 
	 ?>