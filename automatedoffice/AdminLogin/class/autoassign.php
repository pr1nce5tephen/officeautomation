<?php
include('../../config/connection.php');
	 require('../../auth.php');
 	confirm_logged_in();

 	
?>
<center/><br/>
<?php

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

 	$id=$_REQUEST['set'];
 	$query=mysql_query("SELECT * FROM subject WHERE subject_id='$id' ");
 	$getquery=mysql_fetch_array($query);
 	$subject_id=$getquery['subject_id'];

 	$room=mysql_query("SELECT * FROM rooms WHERE room_stat='Available' ");
 	while($getroom=mysql_fetch_array($room)){
    $room_data=$getroom['room_id'];

   $roomsize=mysql_query("SELECT * FROM room_sizes WHERE room_id='$room_data' ");
   $getroomsize=mysql_fetch_array($roomsize);

	$time=mysql_query("SELECT * FROM time");
	while($gettime=mysql_fetch_array($time)){

   	$sy=mysql_query("SELECT * FROM sy");
   	$getsy=mysql_fetch_array($sy);

 	/*if(isset($_POST['generate'])){
 		mysql_query("INSERT INTO scheds(`sched_id`,`start`,`end`,`days`,`room`,`size`,`sy`,`sem`)VALUES('','$gettime[time_in]','$gettime[time_out]','$getdays[day]','$room_data','$getroomsize[room_size]','$getsy[school_yr]','$getsem')");
 	echo"<meta http-equiv='refresh' content='0; url=generatedsched.php'>";
 	}*/
 	$trappings=mysql_query("SELECT * FROM scheds WHERE ('$gettime[time_in]' BETWEEN  `start` AND `end` OR '$gettime[time_out]' BETWEEN  `start` AND `end` ) AND `monday`='$gettime[monday]' AND `tuesday`='$gettime[tuesday]' AND `wednesday`='$gettime[wednesday]' AND `thursday`='$gettime[thursday]' AND `friday`='$gettime[friday]' AND `saturday`='$gettime[saturday]' AND `sunday`='$gettime[sunday]' AND `room`='$room_data' AND `size`='$getroomsize[room_size]' AND `sy`='$getsy[sy_id]' AND `sem`='$getquery[subject_semester]' ");
if(mysql_num_rows($trappings) > 0){
//echo"<meta http-equiv='refresh' content='0; url=generatedsched.php?set=$id'>";
}else{
	mysql_query("INSERT INTO scheds(`sched_id`,`start`,`end`,`monday`,`tuesday`,`wednesday`,`thursday`,`friday`,`saturday`,`sunday`,`room`,`size`,`sy`,`sem`)VALUES('','$gettime[time_in]','$gettime[time_out]','$gettime[monday]','$gettime[tuesday]','$gettime[wednesday]','$gettime[thursday]','$gettime[friday]','$gettime[saturday]','$gettime[sunday]','$room_data','$getroomsize[room_size]','$getsy[sy_id]','$getquery[subject_semester]')");
	//echo"<meta http-equiv='refresh' content='0; url=generatedsched.php?set=$id'>";
}
 
 ?><!--
<tr>
 	<td><?php/* echo $gettime['time_in'].'-'.$gettime['time_out'] ?></td>
 	<td><?php echo $getdays['day'] ?></td>
 	<td><?php echo $room_data ?></td>
 	<td><?php echo $getroomsize['room_size'] ?></td>
 	<td><?php echo $getsy['school_yr']?></td>
 	<td><?php echo $getsem */?></td>
 	<td><a href="#">Set sched</td>
</tr>-->
	<?php  } } ?><br/><br/>
	<fieldset style="width:20%; text-align:left;">
		<legend align="left">Create Sections:</legend>
	<form action="generatedsched.php" method="post" >
		<center>
		<input type="hidden" name="set" value="<?php echo $id?>">
		<input type="text" size="2" maxlength="2" name="section"><br/><br/>
		<input type="submit" name="button" value="Create">
	</form>
	</fieldset>
	<!--<form action="" method="post">
<input type="submit" name="generate" value="Generate" />

</form>-->


<br/><br/>

