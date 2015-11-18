<?php
 include('../../config/connection.php');
     
?>
<head> 
			<meta charset="utf-8" />
			<title> Western Leyte College </title>
			<meta name="keywords" content="" />
			<meta name="description" content="" />
			<script language="javascript" src="../subjects/confirmDel.js" type="text/javascript"></script>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="../../style.css" rel="stylesheet" type="text/css" />
			<link href="../../button.css" rel="stylesheet" type="text/css" />
		</head>
		
		<body>
			<div id="wrapper">
				<div id="callout">
                    <br/>
                    <center>
                        <img src="../images/logo.png" height="50px" width="50px" style ="vertical-align: middle" >
                        WLC-CICTE Office Automation System
                
                
        
					<p><a href="#"><b><i>Memo</i></b></a> | <a href="../../logout.php"><b><i>Logout</i></b></a>
					
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
<li class="site-name"><a href="#">HOME</a></li>
    <li class="yahoo"><a href="#">FILE MAINTENANCE</a>
        <ul>
		</li>
       
        <li><a href="../contribution/contribution.php">Contribution</a></li>
        <li><a href="../course/coursemain.php">Course</a></li>
        <li><a href="../instructors/instructormain.php">Instructors</a></li>  
        <li><a href="../rooms/roommain.php">Rooms</a></li>  
        <li><a href="../sy/symain.php">School Year</a></li>        
        <!--<li><a href="../section/sectionmain.php">Section</a></li>-->
        <li><a href="../specification/specificationmain.php">Specification</a></li>
        <li><a href="../student/studentmain.php">Students</a></li>
        <li><a href="../subject/subjectmain.php">Subjects</a></li>
        <!--<li><a href="../time/timemain.php">Time and Days</a></li>-->
        

        </ul>
    </li> 
    <!--<li class="yahoo"><a href="#">USER MAINTENANCE</a>
        <ul>
        </li>
        
        <li><a href="../users/studentassistantmain.php">Student Assistants</a></li>
        <li><a href="../users/facultyusermain.php">Instructor</a></li>

        </ul>
    </li> -->
    <li class="facebook"><a href="#">TRANSACTIONS</a>
        <ul>
        <!--<li><a href="../instructorLoadingSubjects/instructormain.php">Assign Class</a></li>-->
        <li><a href="../aclass/classmenu.php">Class</a></li>
        <li><a href="../contributionpayment/contribution.php">Contribution Payment</a></li>
        <li><a href="../enlistment/enlistment.php">Enlistment</a></li>
        </ul>
    </li>

 <li class="yahoo"><a href="#">UTILITIES</a>
        <ul>
        </li>
        <li><a href="../changepassword/change.php">Change Password</a></li> 
        <li><a href="../users/usermain.php">User</a></li>
        
        </ul>
    </li> 

    <li class="google"><a href="#">REPORTS</a>
        <ul>
        <li><a href="../reports/registeredStudentsPrint.php">Active Students</a></li>
        <li><a href="../reports/reportinstructor.php">Registered Instructors</a></li>
         <!--<li><a href="#">Subject Report</a></li>-->
        <li><a href="../reports/reportEnrolledStudent.php">Enrolled Students</a></li>
         <li><a href='../reports/paymentreport.php'>Payment Report</a></li>
        <li><a href='../reports/paymenthistory.php'>Payment History</a></li>
        <li><a href="../reports/classreport.php">Class Schedules</a></li>
        <li><a href="../reports/gradeinquiry.php">Inquire Grades</a></li>
       
        <li><a href="#">Course Report &raquo;</a>
            <ul>
                <?php
                                                $getdata = mysql_query("SELECT * FROM course");
                                                if(mysql_num_rows($getdata)>0){
                                                  while($row = mysql_fetch_array($getdata)){
                                                     echo"
                                                    <li><a href='../reports/coursestud.php?viewstud=$row[course_id]'>$row[course_code]</a></li>";
                                                  }
                                                }
                                            ?>
            </ul>

        </li>


          <li><a href="#">Prospectus &raquo;</a>
            <ul>
                <?php
                                                $getdata = mysql_query("SELECT * FROM course");
                                                if(mysql_num_rows($getdata)>0){
                                                  while($row = mysql_fetch_array($getdata)){
                                                     echo"
                                                     <li><a href='../reports/prospectus.php?CID=$row[course_id]'>$row[course_code]</a></li>";
                                                  }
                                                }
                                            ?>
            </ul>

        </li>
   
    </li>

        </ul>
    </li>


     
    
</ul>


