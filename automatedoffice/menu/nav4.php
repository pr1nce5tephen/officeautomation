<?php
    include('../config/connection.php');
?>
<head> 
			<meta charset="utf-8" />
			<title> Western Leyte College </title>
			<meta name="keywords" content="" />
			<meta name="description" content="" />
			<script language="javascript" src="../subjects/confirmDel.js" type="text/javascript"></script>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="../../style.css" rel="stylesheet" type="text/css" />
			
		</head>
		
		<body>
			<div id="wrapper">
				<div id="callout">
                    <br/>
                    <center>
                        <img src="../images/logo.png" height="50px" width="50px" style ="vertical-align: middle" >
                        WLC-CICTE Office Automation System
                
                
        
					
					
			  </div>
				<br/>
				<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
<script>
$(document).ready(function(){
	$("#nav li").hover(
	function(){
		$(this).children('ul').hide();
		$(this).children('ul').slideDown('fast');
	},
	function () {
		$('ul', this).slideUp('fast');            
	});
});
</script>

</head>

<body>
<ul id="nav">
  <ul>
							<li><a href='instructor_home.php'>Home</a></li>
							<li><a href='instructor_profile.php'>My Profile</a></li>
							<li><a href='instructor_class.php'>My Class</a></li>
							<li><a href='gradeprint.php'>Reports</a></li>
							<li><a href='Logout.php'>Logout</a></li>
                            <h2>
                                <?php
									$instractor_id = $_SESSION['instid'];
									$query = mysql_query("SELECT * FROM faculty WHERE InstID = '$instractor_id' ") or die(mysql_error());
									$instructor = mysql_fetch_assoc($query);
									$complete_name = $instructor['fname']." ".$instructor['mi']." ".$instructor['lname']	;
									echo $complete_name;
								?>
                            </h2>
    
</ul>


