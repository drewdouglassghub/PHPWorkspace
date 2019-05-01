<?php 
include 'connectPDOBANDIT.php';
session_cache_limiter('none');
session_start();

$event_id = $_GET['eventId'];
$band_id = $_SESSION['bandId'];


if(($_SESSION['validUser']) != "YES")
{
	header("banditIndex.php");
}
else
{
	$stmt = $conn->prepare("DELETE FROM BANDIT_EVENT WHERE EVENT_ID = '$event_id'");
	$stmt->execute();
	header("Location:selectBandEvents.php?bandId='$band_id'");
}

?>