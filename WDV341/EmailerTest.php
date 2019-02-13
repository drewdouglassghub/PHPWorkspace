<?php

include ("Emailer.php");


$testEmail = new Emailer();


$testEmail->setSenderAddress("form1234@drewdouglass.net");		//creating instances of variables
$testEmail->setSendToAddress("walrusdodges@hotmail.com");
$testEmail->setSubjectLine("Hello from WDV 341 - PHP");
$testEmail->setMessageBody("This is a test email from Drew Douglass in your WDV341 class on Monday nights.");

$clientEmail = new Emailer();  //create 2nd email instance

$clientEmail->setSenderAddress("form1234@drewdouglass.net");
$clientEmail->setSendToAddress("walrusdodges@hotmail.com");
$clientEmail->setSubjectLine("Emailer test");
$clientEmail->setMessageBody("This is a test of my emailer.");

$clientEmail->sendNewMessage();	//test sending email

$testEmail->sendNewMessage();  //test the email

?>



<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Emailer test</title>
<link href="style.css" rel="stylesheet" style="text/css"/>
</head>

<body>
	<form id="Emailer" method="post" action="EmailerTest.php">
	
	<input type="submit" value="Send another" />
	
	</form>

	<p>Senders Name:  <?php echo $testEmail->getSenderAddress(); ?></p><br>
	<p>Recipient's Address: <?php echo $testEmail->getSendToAddress();  ?></p><br>
	<p>Subject: <?php echo $testEmail->getSubjectLine(); ?></p><br>	
	<p>Message: <?php echo $testEmail->getMessageBody();  ?></p><br>
	
	<a href="http://drewdouglass.net/WDV341/WDV341.php">PHP Home</a>
</body>
</html>
