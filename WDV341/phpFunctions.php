
<!DOCTYPE html>
<html>
<head>
<meta charset = "utf-8">
<script src="modernizr-2.js"></script>
<!--
My WDV341 Homework
Author: Drew Douglass
Date: 1/20/19
-->
<title>PHP Homework</title>
<link href="style.css" rel="stylesheet" style="text/css"/>
</head>
<body>


<?php

if (isset($_POST['submit']))
{
	dateFormat();
	internationalDate();
	stringMod();
	formatNumber();
	formatCurrency();
}

function internationalDate(){
	
	
	$date = $_POST["submit"];
	$date = strtotime($date);
	echo "The date you entered is: " . date("d/m/Y", $date) . "<br>";
	
}


function dateFormat(){
	
	$date = $_POST["submit"];
	$date = strtotime($date);
	echo "Your date is: " . date("m/d/Y", $date) . "<br>";
	
}

function stringMod(){
	
	$school = 'dmacc';
	
	$date = $_POST["submit"];
	$date = trim($date);
	$date = strtolower($date); 
	echo $date . "<br>";
	echo "The length of your string is: " . strlen($date). "<br>";
	
	if (strpos($date, $school) == true){
		
		echo "True". "<br>";
	}
	else{
		echo "False" . "<br>";
	}
	
	
}

function formatNumber(){
	
	$number = 1234567890;
	echo number_format($number,2). "<br>";
}

function formatCurrency(){
	
	
	$money = 123456;
	echo "$". number_format($money, 2). "<br>";
}

?>

<form action="phpFunctions.php" method="post">
Date: <input type="text" name="submit"><br>
<input type="submit" >
</form>



</body>
</html>