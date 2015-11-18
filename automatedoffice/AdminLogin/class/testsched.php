<?php
include('../../config/connection.php');
	 require('../../auth.php');
 	confirm_logged_in();

?>
<table border="1" rules="all" cellpadding="5">
<tr>			   <th>Subject</th> 
                   <th>Course</th>
                   <th>Section</th> 
                   <th>Start</th>
                   <th>End</th> 
                   <th>Days</th>
                   <th>Room</th> 
                   <th>Population</th>
                   <th>School Year</th> 
                   <th>Semester</th> 
                   <th>Status</th>
            
</tr>
<?php 

 $schedules=mysql_query("SELECT * FROM schedules,rooms,section,course,subject,sy WHERE schedules.subject_id=subject.subject_id AND schedules.room_id=rooms.room_id AND schedules.section_id=section.section_id AND schedules.course_id=course.course_id AND schedules.sy_id=sy.sy_id ");
 while($getschedules=mysql_fetch_array($schedules)){

?>
<tr align="center">
	<td><?php echo $getschedules['subject_code'] ?></td>
	<td><?php echo $getschedules['course_code'] ?></td>	
	<td><?php echo $getschedules['section_desc'] ?></td>
	<td><?php echo $getschedules['start'] ?></td>
	<td><?php echo $getschedules['end'] ?></td>
	<td><?php echo $getschedules['monday'].' '.$getschedules['tuesday'].' '.$getschedules['wednesday'].' '.$getschedules['thursday'].' '.$getschedules['friday'].' '.$getschedules['saturday'].' '.$getschedules['sunday']?></td>

	<td><?php echo $getschedules['room_description'] ?></td>
	<td><?php echo $getschedules['pop'].'/'.$getschedules['size'] ?></td>

	<td><?php echo $getschedules['school_yr'].'-'.$getschedules['school_yr2'] ?></td>
	<td><?php echo $getschedules['sem'] ?></td>
	<td><?php echo $getschedules['status'] ?></td>
</tr>

<?php 
}
?>

</table>
<a href="classmenu.php">back</a>