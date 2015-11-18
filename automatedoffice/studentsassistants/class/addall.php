<?php 
 include('../../config/connection.php');
 include('../../config/sy.php');
 require('../../auth.php');
confirm_logged_in();
check_level();


$addall=mysql_query("INSERT INTO subject_time(`subject_id`,`subject_units`,`no_hrs`,`no_day_week`,`per_day`) SELECT subject_id, subject_units, subject_units, subject_units, subject_units/subject_units FROM subject WHERE NOT EXISTS (SELECT * FROM subject_time WHERE subject_time.subject_id=subject.subject_id)");

?>