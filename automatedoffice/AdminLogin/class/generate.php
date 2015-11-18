<?php
include('../../config/connection.php');
	 require('../../auth.php');
 	confirm_logged_in();

 		/*GET SCHOOL YEAR by automation*/
				/*$sem1 = date('Y');
				$sem2 = date('Y')+1;
				$sem = $sem1."-".$sem2;
				
		/*GET SCHOOL SEMESTER by automation*/
				/*for($a=6; $a<=10; $a++)
				{
					if($a == date('m')){
					$getsem = '2';}else {$getsem = '1';}
					
					}*/

 	$type=$_REQUEST['type'];

 	$subject=mysql_query("SELECT * FROM subject WHERE subject_semester='$type' ");
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


 	$trappings=mysql_query("SELECT * FROM schedules WHERE `subject_id`='$getsubject[subject_id]' AND `course_id`='$getsubject[subject_course]' AND `section_id`='$getsection[section_id]' OR ('$gettime[time_in]' BETWEEN  `start` AND `end` OR '$gettime[time_out]' BETWEEN  `start` AND `end` ) AND `monday`='$gettime[monday]' AND `tuesday`='$gettime[tuesday]' AND `wednesday`='$gettime[wednesday]' AND `thursday`='$gettime[thursday]' AND `friday`='$gettime[friday]' AND `saturday`='$gettime[saturday]' AND `sunday`='$gettime[sunday]' AND `room_id`='$getroom[room_id]' AND `size`='$getroomsize[room_size]' AND `sy_id`='$getsy[sy_id]' AND `sem`='$getsubject[subject_semester]' ");
if(mysql_num_rows($trappings) > 0){
echo"<meta http-equiv='refresh' content='0; url=testsched.php'>";
}else{
mysql_query("INSERT INTO schedules(`sched_id`,`subject_id`,`course_id`,`section_id`,`start`,`end`,`monday`,`tuesday`,`wednesday`,`thursday`,`friday`,`saturday`,`sunday`,`room_id`,`size`,`pop`,`sy_id`,`sem`,`status`)VALUES('','$getsubject[subject_id]','$getsubject[subject_course]','$getsection[section_id]','$gettime[time_in]','$gettime[time_out]','$gettime[monday]','$gettime[tuesday]','$gettime[wednesday]','$gettime[thursday]','$gettime[friday]','$gettime[saturday]','$gettime[sunday]','$getroom[room_id]','$getroomsize[room_size]','0','$getsy[sy_id]','$getsubject[subject_semester]','Not Full')");
echo"<meta http-equiv='refresh' content='0; url=testsched.php?type=$type'>";
			}

/*$condition=mysql_query("SELECT * FROM schedules WHERE sem='$type' ");
while($getcondition=mysql_fetch_array($condition)){

	$condition2=mysql_query("SELECT * FROM class WHERE ")

}*/

   		  	}
   		  	}
   		  	}
   		  	}

   		  	?>

