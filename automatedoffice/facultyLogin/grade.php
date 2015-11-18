<?php

require('../initialize.php');

session_start();

global $control_number;

$_SESSION['control_number']= $_POST['hidden'];

if(isset($_SESSION['userid'])){
	$id = $_SESSION['userid'];
}
if(isset($_SESSION['control_number'])){
	$control_number= $_SESSION['control_number'];
	
}if(isset($_SESSION['classno'])){
	$classid = $_SESSION['classno'];
	$query = mysql_query("SELECT * FROM enroll JOIN student WHERE enroll.control_number=student.control_number AND enroll.sched_id='$classid' AND enroll.control_number='$control_number' ") or die(mysql_error());
	$data = mysql_fetch_assoc($query);
}

if(isset($_POST['grade'])){

$prelim = $_POST['pgrade'];
$validpre ="$_POST[pgrade]";
$midterm = $_POST['mgrade'];
$validmid = "$_POST[mgrade]";
$semifi = $_POST['sfgrade'];
$validsemi ="$_POST[sfgrade]";
$finals = $_POST['fgrade'];
$validfinal ="$_POST[fgrade]";

$id = $_POST['hidden'];
$date = $_POST['date'];

$prelim = ($_POST['pgrade'] * 0.2);
$midterm = ($_POST['mgrade'] * 0.2);
$semifinal = ($_POST['sfgrade'] * 0.2);
$finals = ($_POST['fgrade'] * 0.4);
$total = $prelim + $midterm + $semifinal + $finals;
$subgrade = round($total);

//EQUIVALENT
if($validpre == "INC" || $validmid == "INC" || $validsemi == "INC" || $validfinal == "INC"){
	$equiv = "INC";
	$subgrade = "INC";
	//$rem = "INC";
}
else if($prelim == "DROP" || $midterm == "DROP" || $semifi == "DROP" || $finals == "DROP"){
	$equiv = "DROP";
	$subgrade = "DROP";
	//$rem = "DROP";
}

else if($prelim == " " || $midterm == " " || $semifi == " " || $finals == " "){
	$equiv = " ";
	$subgrade = " ";
	//$rem = " ";
}else{

if($subgrade == "99.000" || $subgrade == "100"){
$equiv = 1.0;

}else if($subgrade >= "98.000" && $subgrade <= "98.999"){
$equiv = 1.1;
	
}else if($subgrade >= "97.000" && $subgrade <= "97.999"){
$equiv = 1.2;
	
}else if($subgrade >= "96.000" && $subgrade <= "96.999"){
$equiv = 1.3;

}else if($subgrade >= "95.000" && $subgrade <= "95.999"){
$equiv = 1.4;

}else if(($subgrade >= "93.000" && $subgrade <= "93.999") || ($subgrade >= "94.000" && $subgrade <= "94.999")){
		
$equiv = 1.5;

}else if($subgrade >= "92.000" && $subgrade <= "92.999"){
$equiv = 1.6;

}else if($subgrade >= "91.000" && $subgrade <= "91.999"){
$equiv = 1.7;

}else if($subgrade >= "90.000" && $subgrade <= "90.999"){
$equiv = 1.8;

}else if($subgrade >= "89.000" && $subgrade <= "89.999"){
$equiv = 1.9;

}else if(($subgrade >= "88.000" && $subgrade <= "88.999") || ($subgrade >= "87.000" && $subgrade <= "87.999")){

	$equiv = 2.0;

}else if($subgrade >= "86.000" && $subgrade <= "86.999"){
$equiv = 2.1;

}else if($subgrade >= "85.000" && $subgrade <= "85.999"){
$equiv = 2.2;

}else if($subgrade >= "84.000" && $subgrade <= "84.999"){
$equiv = 2.3;

}else if($subgrade >= "83.000" && $subgrade <= "83.999"){
$equiv = 2.4;

}else if(($subgrade >= "82.000" && $subgrade <= "82.999") ||($subgrade >= "81.000" && $subgrade <= "81.999")){

			$equiv = 2.5;
		
}else if($subgrade >= "80.000" && $subgrade <= "80.999"){
	$equiv = 2.6;
	
}else if($subgrade >= "79.000" && $subgrade <= "79.999"){
	$equiv = 2.7;
	
}else if($subgrade >= "78.000" && $subgrade <= "78.999"){
	$equiv = 2.8;
	
}else if($subgrade >= "77.000" && $subgrade <= "77.999"){
	$equiv = 2.9;
	
}else if(($subgrade >= "76.000" && $subgrade <= "76.999") || ($subgrade >= "75.000" && $subgrade <= "75.999")){

			$equiv = 3.0;
		
}else if($subgrade <= "74.000" AND $subgrade < "75.000"){
	$equiv = 5.0;
}
}
//REMARKS	
	 if($equiv >= 1.0 && $equiv <= 3.0){
		$rem = "PASSED";
	}else if($equiv >= 3.1 && $equiv <= 5.0){
		$rem = "FAILED";
	}else if($equiv == "DROP"){
		$rem = "DROP";
	}else if($equiv == "INC"){
		$rem = "INC";
	}
mysql_query("UPDATE enroll SET pgrade = '$validpre', mgrade='$validmid', sfgrade='$validsemi', fgrade='$validfinal', grade='$subgrade', equiv='$equiv', remark='$rem', `date`='$date' WHERE sched_id = '$classid' AND control_number = '$id' ");
echo"<meta http-equiv='refresh' content='1; url=instructor_viewclass.php?viewstudents=$classid'>";

}

?>

<html>
	<head>
		<title>Submit Grade</title>
		<link href="../../button.css" rel="stylesheet" type="text/css" />
	</head>
	<body>	
	
		
		
						<?php include('../menu/nav3.php');?>
				
		<br/>
		
	
		<center>
				<form action = "grade.php" method = "POST">	
				<table rules="all" border ="1" width="80%" class='menu_tab2' cellspacing='5%'>
				
					<tr>
						<th colspan = "8">Submit Grade of <i><?php echo $data['lname'].", ".$data['fname']." ".$data['microtime()'];?></u></th>
					</tr>	
					
					<tr>
						<td>Prelim Grade: </td>
						<td><input type="text" name = "pgrade" value="<?php echo $data['pgrade'] ?>"/></td>
					
						<td>Midterm Grade: </td>
						<td><input type="text" name = "mgrade" value="<?php echo $data['mgrade']?>"/></td>
					
						<td rowspan='2'>SemiFinal Grade: </td>
						<td><input type="text" name = "sfgrade" value="<?php echo $data['sfgrade'] ?>"/></td>
					
						<td>Final Grade: </td>
						<td>
						<?php 
						if(isset($_POST['hidden'])){
						?>
						<input type='hidden' name='hidden' value ="<?php echo $control_number;?>">
						
						<?php } ?>
							<input type='hidden' name='date' value ='<?php echo date("Y-m-d"); ?>'>
							<input type="text" name = "fgrade" value="<?php echo $data['fgrade'] ?>"/></td>
						
					</tr>
				</table>
			
					<?php 
					if(!empty($subgrade) == true){ ?>
					<table rules='all' width='30%' border='1' class='menu_tab2'>
					<tr>
						<td colspan = "2">Total Average Grade:</td>
						<td><?php echo $subgrade; ?></td>
					</tr>
					
					<tr>
						<td colspan = "2">Equivalent Grade:</td>
						<td><?php echo $equiv; ?></td>
					</tr>
					<tr>
						<td colspan = "2">Remarks:</td> 
						<td><?php echo $rem; ?></td>
					</tr>
				</table>
					<?php
					}
					?>
					
				</table>
				<table>
				<tr align = "center">
					
						<td colspan = "2"><button name="grade">Submit Grade</button><!--<input class="button" type = "submit" name = "grade" value = "Submit">-->
						<input type = "reset" value = "Reset"></td>
					</tr>
				</table>
			
								
					
				</form>	
				<a href="instructor_viewclass.php?viewstudents=<?php echo $classid?>"><button>Back</button></a>
				
					<br/><br/>
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