<?php
 include('connection.php');
//school year automation
$sy=date(Y);
$dd=date(Y)+1;

$query=mysql_query("SELECT * FROM sy WHERE `school_yr`='$sy' AND `school_yr2`='$dd' ");
if(mysql_num_rows($query) > 0)
{

}else{
mysql_query("INSERT INTO sy(`sy_id`,`school_yr`,`school_yr2`,`sy_stat`) VALUES('','$sy','$dd','active')");	
$id=mysql_insert_id();
mysql_query("UPDATE sy SET sy_stat = 'inactive' WHERE sy_id != '$id' ");
}


?>