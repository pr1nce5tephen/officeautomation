<?php
 $test=mysql_query("SELECT * FROM time ORDER BY time_id ASC ");
 while($h=mysql_fetch_array($test)){
    $m=$h['monday'];
    $t=$h['tuesday'];
    $w=$h['wednesday'];
    $th=$h['thursday'];
    $f=$h['friday'];
    $s=$h['saturday'];
    $su=$h['sunday'];
  if(empty($m) != true){
    $mv=1;
  }
  else{
    $mv=0;
  }
  if(empty($t) != true){
    $tv=1;
  }
  else{
    $tv=0;
  }
  if(empty($w) != true){
    $wv=1;
  }
  else{
    $wv=0;
  }
  if(empty($th) != true){
    $thv=1;
  }
  else{
    $thv=0;
  }
   if(empty($f) != true){
    $fv=1;
  }
  else{
    $fv=0;
  }
  if(empty($s) != true){
    $sv=1;
  }
  else{
    $sv=0;
  }
  if(empty($su) != true){
    $suv=1;
  }
  else{
    $suv=0;
  }

//Time
//8
  if($h['time_in'] == 8 OR $h['time_out'] == 8 )
  { 
//time in is 8 
    if($h['time_in'] == 8 AND $h['time_out'] == 1 )
    { 
      $tt = 5;
    }
    else if($h['time_in'] == 8 AND $h['time_out'] == 2 )
    {
       $tt = 6;
    }
    else if($h['time_in'] == 8 AND $h['time_out'] == 3 )
    {
       $tt = 7;
    }
    else if($h['time_in'] == 8 AND $h['time_out'] == 4 )
    {
       $tt = 8;
    }
     else if($h['time_in'] == 8 AND $h['time_out'] == 5 )
    {
       $tt = 9;
    }
     else if($h['time_in'] == 8 AND $h['time_out'] == 6 )
    {
       $tt = 10;
    }
     else if($h['time_in'] == 8 AND $h['time_out'] == 7 )
    {
       $tt = 11;
    }
     else if($h['time_in'] == 8 AND $h['time_out'] == 9 )
    {
       $tt = 1;
    }
     else if($h['time_in'] == 8 AND $h['time_out'] == 10 )
    {
       $tt = 2;
    }
    else if($h['time_in'] == 8 AND $h['time_out'] == 11 )
    {
       $tt = 3;
    }
    else if($h['time_in'] == 8 AND $h['time_out'] == 12 )
    {
       $tt = 4;
    }
//end of time in is 8 

//time out is 8
    if($h['time_in'] == 1 AND $h['time_out'] == 8 )
    {
       $tt = 7;
    }
     else if($h['time_in'] == 2 AND $h['time_out'] == 8 )
    {
       $tt = 6;
    } 
     else if($h['time_in'] == 3 AND $h['time_out'] == 8 )
    {
       $tt = 5;
    }
     else if($h['time_in'] == 4 AND $h['time_out'] == 8 )
    {
       $tt = 4;
    }
     else if($h['time_in'] == 5 AND $h['time_out'] == 8 )
    {
       $tt = 3;
    }
     else if($h['time_in'] == 6 AND $h['time_out'] == 8 )
    {
       $tt = 2;
    }
     else if($h['time_in'] == 7 AND $h['time_out'] == 8 )
    {
       $tt = 1;
    }     

  } 
  //end of time out is 8 
  //9
  //time in is 9
else if($h['time_in'] == 9 OR $h['time_out'] == 9 )
  { 
    if($h['time_in'] == 9 AND $h['time_out'] == 1 )
    { 
      $tt = 4;
    }
    else if($h['time_in'] == 9 AND $h['time_out'] == 2 )
    {
       $tt = 5;
    }
    else if($h['time_in'] == 9 AND $h['time_out'] == 3 )
    {
       $tt = 6;
    }
    else if($h['time_in'] == 9 AND $h['time_out'] == 4 )
    {
       $tt = 7;
    }
     else if($h['time_in'] == 9 AND $h['time_out'] == 5 )
    {
       $tt = 8;
    }
     else if($h['time_in'] == 9 AND $h['time_out'] == 6 )
    {
       $tt = 9;
    }
     else if($h['time_in'] == 9 AND $h['time_out'] == 7 )
    {
       $tt = 10;
    }
     else if($h['time_in'] == 9 AND $h['time_out'] == 10 )
    {
       $tt = 1;
    }
     else if($h['time_in'] == 9 AND $h['time_out'] == 11 )
    {
       $tt = 2;
    }
     else if($h['time_in'] == 9 AND $h['time_out'] == 12 )
    {
       $tt = 3;
    }
//end of time in is 9
//time out is 9
  if($h['time_in'] == 1 AND $h['time_out'] == 9 )
    {
       $tt = 8;
    }
     else if($h['time_in'] == 2 AND $h['time_out'] == 9 )
    {
       $tt = 7;
    } 
     else if($h['time_in'] == 3 AND $h['time_out'] == 9 )
    {
       $tt = 6;
    }
     else if($h['time_in'] == 4 AND $h['time_out'] == 9 )
    {
       $tt = 5;
    }
     else if($h['time_in'] == 5 AND $h['time_out'] == 9 )
    {
       $tt = 4;
    }
     else if($h['time_in'] == 6 AND $h['time_out'] == 9 )
    {
       $tt = 3;
    }
     else if($h['time_in'] == 7 AND $h['time_out'] == 9 )
    {
       $tt = 2;
    } 
    else if($h['time_in'] == 8 AND $h['time_out'] == 9 )
    {
       $tt = 1;
    }
  }
  //end of time in is 9   
//10
else if($h['time_in'] == 10 OR $h['time_out'] == 10 )
  { 
//time in is 10 
    if($h['time_in'] == 10 AND $h['time_out'] == 1 )
    { 
      $tt = 3;
    }
    else if($h['time_in'] == 10 AND $h['time_out'] == 2 )
    {
       $tt = 4;
    }
    else if($h['time_in'] == 10 AND $h['time_out'] == 3 )
    {
       $tt = 5;
    }
    else if($h['time_in'] == 10 AND $h['time_out'] == 4 )
    {
       $tt = 6;
    }
     else if($h['time_in'] == 10 AND $h['time_out'] == 5 )
    {
       $tt = 7;
    }
     else if($h['time_in'] == 10 AND $h['time_out'] == 6 )
    {
       $tt = 8;
    }
     else if($h['time_in'] == 10 AND $h['time_out'] == 7 )
    {
       $tt = 9;
    }
     else if($h['time_in'] == 10 AND $h['time_out'] == 11 )
    {
       $tt = 1;
    }
     else if($h['time_in'] == 10 AND $h['time_out'] == 12 )
    {
       $tt = 2;
    }
//end of time in is 10 

//time out is 10
    if($h['time_in'] == 1 AND $h['time_out'] == 10 )
    {
       $tt = 9;
    }
     else if($h['time_in'] == 2 AND $h['time_out'] == 10 )
    {
       $tt = 8;
    } 
     else if($h['time_in'] == 3 AND $h['time_out'] == 10 )
    {
       $tt = 7;
    }
     else if($h['time_in'] == 4 AND $h['time_out'] == 10 )
    {
       $tt = 6;
    }
     else if($h['time_in'] == 5 AND $h['time_out'] == 10 )
    {
       $tt = 5;
    }
     else if($h['time_in'] == 6 AND $h['time_out'] == 10 )
    {
       $tt = 4;
    }
     else if($h['time_in'] == 7 AND $h['time_out'] == 10 )
    {
       $tt = 3;
    } 
    else if($h['time_in'] == 8 AND $h['time_out'] == 10 )
    {
       $tt = 2;
    }
    else if($h['time_in'] == 9 AND $h['time_out'] == 10 )
    {
       $tt = 1;
    }
  } 
  //end of time out is 10 
//11

else if($h['time_in'] == 11 OR $h['time_out'] == 11 )
  {
//time in is 11
    if($h['time_in'] == 11 AND $h['time_out'] == 1 )
    { 
      $tt = 2;
    }
    else if($h['time_in'] == 11 AND $h['time_out'] == 2 )
    {
       $tt = 3;
    }
    else if($h['time_in'] == 11 AND $h['time_out'] == 3 )
    {
       $tt = 4;
    }
    else if($h['time_in'] == 11 AND $h['time_out'] == 4 )
    {
       $tt = 5;
    }
     else if($h['time_in'] == 11 AND $h['time_out'] == 5 )
    {
       $tt = 6;
    }
     else if($h['time_in'] == 11 AND $h['time_out'] == 6 )
    {
       $tt = 7;
    }
     else if($h['time_in'] == 11 AND $h['time_out'] == 7 )
    {
       $tt = 8;
    }
     else if($h['time_in'] == 11 AND $h['time_out'] == 8 )
    {
       $tt = 9;
    }
     else if($h['time_in'] == 11 AND $h['time_out'] == 9 )
    {
       $tt = 10;
    }
     else if($h['time_in'] == 11 AND $h['time_out'] == 10 )
    {
       $tt = 11;
    }
     else if($h['time_in'] == 11 AND $h['time_out'] == 12 )
    {
       $tt = 1;
    }
//end of time in is 11

//time out is 11
    if($h['time_in'] == 1 AND $h['time_out'] == 11 )
    {
       $tt = 10;
    }
     else if($h['time_in'] == 2 AND $h['time_out'] == 11 )
    {
       $tt = 9;
    } 
     else if($h['time_in'] == 3 AND $h['time_out'] == 11 )
    {
       $tt = 8;
    }
     else if($h['time_in'] == 4 AND $h['time_out'] == 11 )
    {
       $tt = 7;
    }
     else if($h['time_in'] == 5 AND $h['time_out'] == 11 )
    {
       $tt = 6;
    }
     else if($h['time_in'] == 6 AND $h['time_out'] == 11 )
    {
       $tt = 5;
    }
     else if($h['time_in'] == 7 AND $h['time_out'] == 11 )
    {
       $tt = 4;
    } 
    else if($h['time_in'] == 8 AND $h['time_out'] == 11 )
    {
       $tt = 3;
    }
    else if($h['time_in'] == 9 AND $h['time_out'] == 11 )
    {
       $tt = 2;
    }
    else if($h['time_in'] == 10 AND $h['time_out'] == 11 )
    {
       $tt = 1;
    }
  }
//End of time in is 11
  //12
else if($h['time_in'] == 12 OR $h['time_out'] == 12 )
  {
//time in is 12
    if($h['time_in'] == 12 AND $h['time_out'] == 1 )
    { 
      $tt = 1;
    }
    else if($h['time_in'] == 12 AND $h['time_out'] == 2 )
    {
       $tt = 2;
    }
    else if($h['time_in'] == 12 AND $h['time_out'] == 3 )
    {
       $tt = 3;
    }
    else if($h['time_in'] == 12 AND $h['time_out'] == 4 )
    {
       $tt = 4;
    }
     else if($h['time_in'] == 12 AND $h['time_out'] == 5 )
    {
       $tt = 5;
    }
     else if($h['time_in'] == 12 AND $h['time_out'] == 6 )
    {
       $tt = 6;
    }
     else if($h['time_in'] == 12 AND $h['time_out'] == 7 )
    {
       $tt = 7;
    }
     else if($h['time_in'] == 12 AND $h['time_out'] == 8 )
    {
       $tt = 8;
    }
     else if($h['time_in'] == 12 AND $h['time_out'] == 9 )
    {
       $tt = 9;
    }
     else if($h['time_in'] == 12 AND $h['time_out'] == 10 )
    {
       $tt = 10;
    }
//end of time in is 12

//time out is 12
    if($h['time_in'] == 1 AND $h['time_out'] == 12 )
    {
       $tt = 11;
    }
     else if($h['time_in'] == 2 AND $h['time_out'] == 12 )
    {
       $tt = 10;
    } 
     else if($h['time_in'] == 3 AND $h['time_out'] == 12 )
    {
       $tt = 9;
    }
     else if($h['time_in'] == 4 AND $h['time_out'] == 12 )
    {
       $tt = 8;
    }
     else if($h['time_in'] == 5 AND $h['time_out'] == 12 )
    {
       $tt = 7;
    }
     else if($h['time_in'] == 6 AND $h['time_out'] == 12 )
    {
       $tt = 6;
    }
     else if($h['time_in'] == 7 AND $h['time_out'] == 12 )
    {
       $tt = 5;
    } 
    else if($h['time_in'] == 8 AND $h['time_out'] == 12 )
    {
       $tt = 4;
    }
    else if($h['time_in'] == 9 AND $h['time_out'] == 12 )
    {
       $tt = 3;
    }
    else if($h['time_in'] == 10 AND $h['time_out'] == 12 )
    {
       $tt = 2;
    }
     else if($h['time_in'] == 11 AND $h['time_out'] == 12 )
    {
       $tt = 1;
    }
//End of time in is 12
    //if non of the choices above
  }else
  {
    if($h['time_in'] < $h['time_out'])
    {
        $tt = $h['time_out'] - $h['time_in'];
    }
    else
    {
        $tt = $h['time_in'] - $h['time_out'];
    }

    }
   

$td=$mv + $tv + $wv + $thv + $fv + $sv + $suv;
$ft=$tt * $td;
/*echo $tt ."<br/>"; 
echo $td;*/
$s=mysql_query("SELECT * FROM ctime WHERE time_id='$h[time_id]'");
if(mysql_num_rows($s) > 0){
        echo"<meta http-equiv='refresh' content='0; url=timemain.php'>"; 
}else{
mysql_query("INSERT INTO ctime(`ctime_id`,`time_id`,`units`)VALUES('','$h[time_id]','$ft')");
        echo"<meta http-equiv='refresh' content='0; url=timemain.php'>"; 
 }
 } ?>