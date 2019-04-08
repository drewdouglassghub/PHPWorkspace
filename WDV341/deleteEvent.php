<?php 
include 'connectPDO2.php';
session_cache_limiter('none');
session_start();

$eventId = $_GET['eventID'];



if(($_SESSION['validUser']) != "yes")
{
	header("Location:presenterLogin.php");
}
else
{
	$stmt = $conn->prepare("DELETE FROM WDV_EVENT WHERE EVENT_ID = '$eventId'");
	$stmt->execute();
	header("Location:selectEvents.php");
}

?>