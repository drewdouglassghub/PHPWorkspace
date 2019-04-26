<?php
include 'connectPDOBANDIT.php';
session_start();

if(isset($_SESSION['validUser']) && ($_SESSION['validUser'] !== "YES"))
{
header("Location:banditIndex.php");

}
else if(isset($_SESSION['bandId'])){
	$band_id = $_SESSION['bandId'];
	$user_name = $_SESSION['userName'];
	$user_auth = $_SESSION['userAuth'];
	$user_id = $_SESSION['userId'];
	}	
else
	{
	$user_name = $_SESSION['userName'];
	$user_auth = $_SESSION['userAuth'];
	$user_id = $_SESSION['userId'];
	$band_id = $_GET['bandId'];

}
	echo $band_id;

$sql = "SELECT BAND_ID, BAND_NAME, BAND_STYLE, BAND_IMAGE, BAND_EMAIL FROM BANDIT_BAND WHERE BAND_ID = :bandId AND BAND_USERID = :userId";
$stmt = $conn->prepare($sql);//prepare the query

echo $sql;

$stmt->bindParam(":userId", $user_id);
$stmt->bindParam(":bandId", $band_id);

$stmt->execute();
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

if ($userRow != "")
{


	$_SESSION['bandId'] = $userRow['BAND_ID'];
	$_SESSION['bandName'] = $userRow['BAND_NAME'];
	$_SESSION['bandStyle'] = $userRow['BAND_STYLE'];
	$_SESSION['bandImage'] = $userRow['BAND_IMAGE'];
	$_SESSION['bandEmail'] = $userRow['BAND_EMAIL'];
	
	$band_id = $_SESSION['bandId'];
	$band_name = $_SESSION['bandName'];
	$band_style = $_SESSION['bandStyle'];
	$band_email = $_SESSION['bandEmail'];
	$band_image = "KCCLogo.jpg";
	
}
else
{
	//error in processing login.  Logon Not Found...
	$_SESSION['validUser'] = "NO";
	$message = "Sorry, there was a problem with your username or password. Please try again.";
}


?>

<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset=utf-8 />
<title>Band Page</title>
<link href="style.css" rel="stylesheet" style="text/css"/>
</head>
<body>

<h1>Welcome <?php echo $band_name ?></h1>



	<input type="image" src="images/<?php echo $band_image; ?>" alt="Submit"  width="450" height="300">



		<h2><a href="profilePictureUpload.php" >Picture Upload</a></h2>


	<h3>Name: <?php echo $band_name; ?></h3>
	<h3>Style: <?php echo $band_style; ?></h3>
	<h3>Email: <?php echo $band_email; ?></h3>
	
	



</table>
<a href='selectBandEvents.php'>View Band Events</a>
<a href="BanditLogout.php">BandIt Logout</a>
</body>
</html>