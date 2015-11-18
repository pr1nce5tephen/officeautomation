<?php
include('../menu/nav3.php');
if(isset($_SESSION['userid'])){
	$id = $_SESSION['userid'];
}
?>
<html>
	<head>
		<title>
			Instructor Page
		</title>
	<link href="../style.css" rel="stylesheet" type="text/css" />
	<form action='index.php' name='room' method='POST'>
	</head>
	<form action='instructor_home.php' method='POST'>
	<body>
		<div class='header'>
		</div>
	</form>
					
	<br><center/>
		<table class = 'menu_tab2' rules="all" width="90%" border="1">
			<th>Subject</th>
			<th>Schedule</th>
			<th>Sem</th>
			<th>SY</th>
			<th>Room</th>
			<th>Pop/Size</th>
							<th>ACTION</th>
							<?php
								$query = mysql_query("SELECT * FROM instructor_subject,bscheds,subject,sy,rooms WHERE instructor_subject.classno=bscheds.sched_id AND subject.subject_id=bscheds.subject_id AND instructor_subject.fcode = '$id' AND bscheds.sy_id=sy.sy_id AND bscheds.room_id=rooms.room_id ");
									if(mysql_num_rows($query) > 0){
									while($data = mysql_fetch_array($query)){
							?>
							<tr>
								<td align='center'><?php echo $data["subject_code"]." | ".$data["subject_desc"]; ?></td>
								<td align='center'><?php echo $data["in"].'-'.$data["out"].' '.$data["monday"].' '.$data["tuesday"].' '.$data["wednesday"].' '.$data["thursday"].' '.$data["friday"].' '.$data["saturday"].' '.$data["sunday"] ?></td>
								<td align='center'><?php echo $data["sem"]; ?></td>
								<td align='center'><?php echo $data["school_yr"].'-'.$data["school_yr2"]; ?></td>
								<td align='center'><?php echo $data["room_code"]." | ".$data["room_description"]; ?></td>
								<td align='center'><?php echo $data["pop"]; ?>/<?php echo $data["size"]; ?></td>
								<td align='center'><a href = 'instructor_viewclass.php?viewstudents=<?php echo $data['classno']?>'>View Students</a></td>	
							</tr>
							<?php } }else{ ?>
							<tr><td align='center' colspan='8'>No Results!</td></tr>
							<?php } ?>

						</table>
				
	<br/>
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

