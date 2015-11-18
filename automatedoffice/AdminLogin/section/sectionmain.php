	<?php
	 error_reporting(0);
	 include('../../config/connection.php');
 require('../../auth.php');
 include('../../config/sy.php');
 	confirm_logged_in();
 	check_level();
?>
<!DOCTYPE html>
		<html lang="en">
		<head> 
			<meta charset="utf-8" />
			<title> Western Leyte College </title>
			<meta name="keywords" content="" />
			<meta name="description" content="" />
						<script src="../../filterJavascript/filter.js" type="text/javascript" charset="utf-8"></script>
			<script src="../../filterJavascript/js/application.js" type="text/javascript" charset="utf-8"></script> 
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="../../style.css" rel="stylesheet" type="text/css" />
			
		</head>
		
		<body>
			
      <!--menu-->


       <?php include('../../menu/nav2.php');?>

<br/>
				 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 <label for="filter">Search:</label> <input type="text" name="filter" value="" id="filter" />
<br/><br/><center/>
<table class='menu_tab2' rules="all" width="90%"  border="1">
		 <thead>
							<tr>
								<th> ID </th>
								<th> Course </th>
								<th> Year Level </th>
								<th> Semester </th>
								<th> Section </th>
								<th colspan="2"> Action </th>
							</tr>
		 </thead>
		 <tbody>
	<?php
$result=mysql_query("SELECT * FROM section,course WHERE section.section_course=course.course_id ORDER BY course_id ASC");
while($rows = mysql_fetch_assoc($result)){
		$section_id=$rows['section_id'];
		echo'<tr align="center">';
		echo'<td>'.$rows['section_id'].'</td>';
		echo'<td>'.$rows['course_code'].'</td>';
		echo'<td>'.$rows['section_yrlvl'].'</td>';
		echo'<td>'.$rows['section_sem'].'</td>';
		echo'<td>'.$rows['section_desc'].'</td>';
		echo'<td><a href="updatesection.php?section_id='.$section_id.'"><img src="../images/b_edit.png"></img></a></td>';
		echo'<td><a href="sectiondelete.php?section_id='.$section_id.'"><img src="../images/b_drop.png"></img></a></td>';
		echo'</tr>';
	
		
	}++$i;?>
	 </tbody>
</table>
	  <div align='center'class='menu_nav3'>
						<br/>
							
								<a style="text-decoration:none;" href='sectionadd.php'/><input type="button" value="ADD"/></a>
						
								
			</div>
</center>
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