<?php
include 'connectPDOBANDIT.php';
session_cache_limiter('none');
session_start();

if(isset($_SESSION['validUser']) && ($_SESSION['validUser'] == "YES"))
{
	$m_image = $_SESSION['mImage'];
	$user_name = $_SESSION['userName'];
	$user_auth = $_SESSION['userAuth'];
	$user_id = $_SESSION['userId'];
	$m_id = $_GET['mId'];
	
}
else {
	header("Location:banditIndex.php");
}

$sql = "SELECT M_ID, M_FIRSTNAME, M_LASTNAME, M_INSTRUMENTS, M_BANDID, M_USER_ID, M_IMAGE FROM BANDIT_MUSICIAN WHERE M_USER_ID = '$user_id'";
$stmt = $conn->prepare($sql);//prepare the query


$stmt->bindParam(":userId", $user_id);

echo $sql;

$stmt->execute();

$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

if ($userRow != "")
{

	$_SESSION['mId'] = $userRow['M_ID'];
	$_SESSION['mFirstName'] = $userRow['M_FIRSTNAME'];
	$_SESSION['mLastName'] = $userRow['M_LASTNAME'];
	$_SESSION['mInstruments'] = $userRow['M_INSTRUMENTS'];
	$_SESSION['mBandId'] = $userRow['M_BANDID'];
	$_SESSION['mUserId'] = $userRow['M_USER_ID'];
	$_SESSION['mImage'] = $userRow['M_IMAGE'];

	
	$m_id = $_SESSION['mId'];
	$m_firstname = $_SESSION['mFirstName'];
	$m_lastname = $_SESSION['mLastName'];
	$m_instruments = $_SESSION['mInstruments'];
	$m_bandid = $_SESSION['mBandId'];
	$m_userid =$_SESSION['userId'];
	$m_image = $_SESSION['mImage'];
	
	echo "image: " . $m_image;
	
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
<title>Musician Profile</title>
<link href="style.css" rel="stylesheet" style="text/css"/>
</head>
<body>

<h1>Welcome <?php echo $m_firstname; ?></h1>

<div class="piccontainer" id="profilePic" name="profilePic">


<?php 
echo '<br><img src="'. $m_image .'">';

?>
</div>
<div class="container">
		<h2><a href="profilePictureUpload.php" >Picture Upload</a></h2>

	<p>First Name: <?php echo $m_firstname; ?></p>
	<p>Last Name: <?php echo $m_lastname; ?></p>
	<p>Instruments: <?php echo $m_instruments; ?> </p>
</div>

<div class="container2">
<a href='createBand.php'>Create a Band</a>
<a href='viewUserBands.php'>View My Bands</a>
<a href="BanditLogout.php">BandIt Logout</a>
</div>
</body>
</html>