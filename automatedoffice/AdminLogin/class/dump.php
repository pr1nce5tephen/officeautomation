<?php
include('../../config/connection.php');
require('../../auth.php');
confirm_logged_in();

if(isset($_POST['setsched'])){
	mysql_query("INSERT INTO class(`classno`,`sched_id`,`scode`,`course`,`section`,`in`,`out`,`monday`,`tuesday`,`wednesday`,`thursday`,`friday`,`saturday`,`sunday`,`room`,`size`,`Pop`,`sy`,`sem`,`Status`)VALUES('','$_POST[id]','$_POST[subject_id]','$_POST[course_id]','','$_POST[start]','$_POST[end]','$_POST[m]','$_POST[t]','$_POST[w]','$_POST[th]','$_POST[f]','$_POST[s]','$_POST[su]','$_POST[room]','$_POST[size]','0','$_POST[sy]','$_POST[subject_sem]','Not Full') ");
	echo"<script>alert('schedule set')</script>";
}
$section=$_REQUEST['section'];
$subject=$_REQUEST['set'];
		$subject_data=mysql_query("SELECT * FROM subject WHERE subject_id='$subject' ");
		$getsubject_data=mysql_fetch_assoc($subject_data);
		$subject_id=$getsubject_data['subject_id'];
		$subject_sem=$getsubject_data['subject_semester'];

?>
<table rules="all" border="1" width="60%" cellpadding="5" cellspacing="5">
	<tr><th colspan="7">List of All Available Schedules for <?php echo $getsubject_data['subject_code'].'|'.$getsubject_data['subject_desc'] ?></th></tr>
	<tr><th>Time</th><th>Days</th><th>Room</th><th>Capacity</th><th>School Year</th><th>Semester</th><th>Option</th></tr>
	
	<?php 
		
		for($a=1; $a<=$section; $a++){

		$schedules=mysql_query("SELECT * FROM scheds,sy,rooms WHERE scheds.sy=sy.sy_id AND scheds.room=rooms.room_id AND scheds.sem='$subject_sem' ORDER BY start Asc");		
		while($getschedules=mysql_fetch_assoc($schedules)){

			
			
			//$class=mysql_query("SELECT * FROM class WHERE `in`='$getschedules[start]' AND `out`='$getschedules[end]' AND `days`='$getschedules[days]' AND `room`='$getschedules[room]' AND `sy`='$getschedules[sy]' AND `sem`='$getschedules[sem]' ");
		$class=mysql_query("SELECT * FROM class WHERE ('$getschedules[start]' BETWEEN `in` AND `out` OR '$getschedules[end]' BETWEEN `in` AND `out`) AND (`monday`='$getschedules[monday]' AND `tuesday`='$getschedules[tuesday]' AND `wednesday`='$getschedules[wednesday]' AND `thursday`='$getschedules[thursday]' AND `friday`='$getschedules[friday]' AND `saturday`='$getschedules[saturday]' AND `sunday`='$getschedules[sunday]') OR (`monday`='$getschedules[monday]' OR `tuesday`='$getschedules[tuesday]' OR `wednesday`='$getschedules[wednesday]' OR `thursday`='$getschedules[thursday]' OR `friday`='$getschedules[friday]' OR `saturday`='$getschedules[saturday]' OR `sunday`='$getschedules[sunday]')  AND `room`='$getschedules[room]' AND `sy`='$getschedules[sy]' AND `sem`='$getschedules[sem]' ");
		$getclass=mysql_fetch_assoc($class);
		if(mysql_num_rows($class) > 0){

		}else{
//loop section
	


		//for($b=$schedules; $b!=$class; $b++){
 mysql_query("INSERT INTO class(`classno`,`sched_id`,`scode`,`course`,`section`,`in`,`out`,`monday`,`tuesday`,`wednesday`,`thursday`,`friday`,`saturday`,`sunday`,`room`,`size`,`Pop`,`sy`,`sem`,`Status`)VALUES('','$getschedules[sched_id]','$getsubject_data[subject_id]','$getsubject_data[subject_course]','".$a."','$getschedules[start]','$getschedules[end]','$getschedules[monday]','$getschedules[tuesday]','$getschedules[wednesday]','$getschedules[thursday]','$getschedules[friday]','$getschedules[saturday]','$getschedules[sunday]','$getschedules[room]','$getschedules[size]','0','$getschedules[sy]','$getschedules[sem]','Not Full') ");
	//echo"<script>alert('schedule set')</script>";
			
	 ?>
<!--<tr align="center">
<form action="" method="post">
	<input type="hidden" name="subject_id" value="<?php/* echo $getsubject_data['subject_id'] ?>" />
	<input type="hidden" name="course_id" value="<?php echo $getsubject_data['subject_course'] ?>" />
	<input type="hidden" name="subject_sem" value="<?php echo $getsubject_data['subject_semester'] ?>" />
		<input type="hidden" name="id" value="<?php echo $getschedules['sched_id'] ?>" />
		<input type="hidden" name="start" value="<?php echo $getschedules['start'] ?>" />
		<input type="hidden" name="end" value="<?php echo $getschedules['end'] ?>" />
		<input type="hidden" name="m" value="<?php echo $getschedules['monday'] ?>" />
		<input type="hidden" name="t" value="<?php echo $getschedules['tuesday'] ?>" />
		<input type="hidden" name="w" value="<?php echo $getschedules['wednesday'] ?>" />
		<input type="hidden" name="th" value="<?php echo $getschedules['thursday'] ?>" />
		<input type="hidden" name="f" value="<?php echo $getschedules['friday'] ?>" />
		<input type="hidden" name="s" value="<?php echo $getschedules['saturday'] ?>" />
		<input type="hidden" name="su" value="<?php echo $getschedules['sunday'] ?>" />
		<input type="hidden" name="room" value="<?php echo $getschedules['room'] ?>" />
		<input type="hidden" name="size" value="<?php echo $getschedules['size'] ?>" />
		<input type="hidden" name="sy" value="<?php echo $getschedules['sy'] ?>" />
		<input type="hidden" name="sem" value="<?php echo $getschedules['sem'] ?>" />

	 	<td><?php echo $getschedules['start'].'-'. $getschedules['end']  ?></td>	 	
	 	<td><?php echo $getschedules['monday'].' '.$getschedules['tuesday'].' '.$getschedules['wednesday'].' '.$getschedules['thursday'].' '.$getschedules['friday'].' '.$getschedules['saturday'].' '.$getschedules['sunday'] ?></td>
	 	<td><?php echo $getschedules['room_code'].'-'.$getschedules['room_description'] ?></td>
	 	<td><?php echo $getschedules['size'] ?></td>
	 	<td><?php echo  $getschedules['school_yr'].'-'.$getschedules['school_yr2'] ?></td>
	 	<td><?php echo $getschedules['sem'] */?></td>
	 	
	 	<td><input type="submit" name="setsched" value="Select" /></td>
</tr>
</form>-->
	 <?php   } }  }  ?>
<tr align="center">

</tr>
</table><br/>

<a href="createClass.php">BAck</a>