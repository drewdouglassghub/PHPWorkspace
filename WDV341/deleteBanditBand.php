<?php 
include 'connectPDOBANDIT.php';
session_cache_limiter('none');
session_start();

$bandId = $_GET['bandId'];



if(($_SESSION['validUser']) != "YES")
{
	header("Location:banditLogin.php");
}
else
{
	$stmt = $conn->prepare("DELETE FROM BANDIT_BAND WHERE BAND_ID = '$bandId'");
	$stmt->execute();
	header("Location:viewAllBanditBands.php");
}

?>