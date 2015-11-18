<?php
 include('../config/sy.php');
include('../menu/nav3.php');


 $id=$_SESSION['userid'];

 $query=mysql_query("SELECT * FROM faculty WHERE fcode='$id' ");
 $count=mysql_fetch_assoc($query);
 $name=$count['lname'].', '.$count['fname'].' '.$count['mi'];
 ?>


<html>

<body>
	<center/>
<h2>Welcome <?php echo $name?></h2>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

	<footer>
			<div class="section">
				<p>
				</p>
			</div>
			
			
			
		</footer>	
	
		<p style="text-align: center; padding: 0px;"></p>
</body>

</html> 



