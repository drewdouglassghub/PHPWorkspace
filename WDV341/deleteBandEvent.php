<?php 
include 'connectPDOBANDIT.php';
session_cache_limiter('none');
session_start();

$eventId = $_GET['eventID'];



if(($_SESSION['validUser']) != "YES")
{
	header("banditLogin.php");
}
else
{
	$stmt = $conn->prepare("DELETE FROM BANDIT_EVENT WHERE EVENT_ID = '$eventId'");
	$stmt->execute();
	header("Location:bandProfile.php");
}

?>