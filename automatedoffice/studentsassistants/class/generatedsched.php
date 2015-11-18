<?php
include('../../config/connection.php');
require('../../auth.php');
confirm_logged_in();

/*
$section=$_REQUEST['section'];
$subject=$_REQUEST['set'];
		$subject_data=mysql_query("SELECT * FROM subject WHERE subject_id='$subject' ");
		$getsubject_data=mysql_fetch_assoc($subject_data);
		$subject_id=$getsubject_data['subject_id'];
		$subject_sem=$getsubject_data['subject_semester'];*/

//automate 
		$type=$_REQUEST['set'];

  $subject=mysql_query("SELECT * FROM subject WHERE subject_id='$type' ");
 	while($getsubject=mysql_fetch_array($subject)){

 	$section=mysql_query("SELECT * FROM section WHERE `section_sem` = '$getsubject[subject_semester]' AND `section_course`='$getsubject[subject_course]' AND `section_yrlvl`='$getsubject[subject_yrlvl]' ");
	while($getsection=mysql_fetch_array($section)){

 	$room=mysql_query("SELECT * FROM rooms WHERE room_stat='Available' AND room_specification='$getsubject[subject_specification]' ");
 	while($getroom=mysql_fetch_array($room)){

  $roomsize=mysql_query("SELECT * FROM room_sizes WHERE room_id='$getroom[room_id]' ");
  $getroomsize=mysql_fetch_array($roomsize);

  $time=mysql_query("SELECT * FROM time");
  while($gettime=mysql_fetch_array($time)){

  $sy=mysql_query("SELECT * FROM sy");
  $getsy=mysql_fetch_array($sy);


  $trappings=mysql_query("SELECT * FROM schedules WHERE `subject_id`='$getsubject[subject_id]'AND `course_id`='$getsubject[subject_course]' AND `section_id`='$getsection[section_id]' OR ('$gettime[time_in]' BETWEEN  `start` AND `end` OR '$gettime[time_out]' BETWEEN  `start` AND `end` OR `start`='$gettime[time_in]' AND `end`='$gettime[time_out]' ) AND `monday`='$gettime[monday]' AND `tuesday`='$gettime[tuesday]' AND `wednesday`='$gettime[wednesday]' AND `thursday`='$gettime[thursday]' AND `friday`='$gettime[friday]' AND `saturday`='$gettime[saturday]' AND `sunday`='$gettime[sunday]' AND `room_id`='$getroom[room_id]' AND `size`='$getroomsize[room_size]' AND `sy_id`='$getsy[sy_id]' AND `sem`='$getsubject[subject_semester]'");

//if already on db, link directly
if(mysql_num_rows($trappings) > 0){
echo"<meta http-equiv='refresh' content='0; url=createClass.php'>";
}
//if not, execute the ff:
else
{
    $trappings2=mysql_query("SELECT * FROM schedules WHERE `subject_id`='$getsubject[subject_id]' OR `section_id`='$getsection[section_id]' AND ('$gettime[time_in]' BETWEEN  `start` AND `end` OR '$gettime[time_out]' BETWEEN  `start` AND `end` OR `start`='$gettime[time_in]' AND `end`='$gettime[time_out]' ) AND (`monday`='$gettime[monday]' AND `wednesday`='$gettime[wednesday]' AND `friday`='$gettime[friday]') AND (`tuesday`='$gettime[tuesday]' AND `thursday`='$gettime[thursday]') AND (`monday`='$gettime[monday]' AND `friday`='$gettime[friday]') AND `room_id`='$getroom[room_id]' AND `sy_id`='$getsy[sy_id]' AND `sem`='$getsubject[subject_semester]'");   
    $gettrappings2=mysql_fetch_array($trappings2);

    //if conflict occurs 
    if(mysql_num_rows($trappings2) > 0)
    {
      //choose another room 
      $roomtraps=mysql_query("SELECT * FROM rooms WHERE `room_id` != '$gettrappings2[room_id]' AND `room_specification`='$getsubject[subject_specification]' AND  room_stat='Available'");
      $getroomtraps=mysql_fetch_array($roomtraps);

      $roomtraps2=mysql_query("SELECT * FROM rooms WHERE `room_id` != '$getroomtraps2[room_id]' AND `room_specification`='$getsubject[subject_specification]' AND  room_stat='Available'");
      $getroomtraps2=mysql_fetch_array($roomtraps2);

    //then add
    mysql_query("INSERT INTO schedules(`sched_id`,`subject_id`,`course_id`,`section_id`,`start`,`end`,`monday`,`tuesday`,`wednesday`,`thursday`,`friday`,`saturday`,`sunday`,`room_id`,`size`,`pop`,`sy_id`,`sem`,`status`)VALUES('','$getsubject[subject_id]','$getsubject[subject_course]','$getsection[section_id]','$gettime[time_in]','$gettime[time_out]','$gettime[monday]','$gettime[tuesday]','$gettime[wednesday]','$gettime[thursday]','$gettime[friday]','$gettime[saturday]','$gettime[sunday]','$getroomtraps2[room_id]','$getroomsize[room_size]','0','$getsy[sy_id]','$getsubject[subject_semester]','Not Full')");
    echo"<meta http-equiv='refresh' content='0; url=createClass.php'>";
    }
    else
    {
     mysql_query("INSERT INTO schedules(`sched_id`,`subject_id`,`course_id`,`section_id`,`start`,`end`,`monday`,`tuesday`,`wednesday`,`thursday`,`friday`,`saturday`,`sunday`,`room_id`,`size`,`pop`,`sy_id`,`sem`,`status`)VALUES('','$getsubject[subject_id]','$getsubject[subject_course]','$getsection[section_id]','$gettime[time_in]','$gettime[time_out]','$gettime[monday]','$gettime[tuesday]','$gettime[wednesday]','$gettime[thursday]','$gettime[friday]','$gettime[saturday]','$gettime[sunday]','$getroom[room_id]','$getroomsize[room_size]','0','$getsy[sy_id]','$getsubject[subject_semester]','Not Full')");
    echo"<meta http-equiv='refresh' content='0; url=createClass.php'>";
              }
            }
   		  	}
   		  }
   		}
   	}

	 ?>
