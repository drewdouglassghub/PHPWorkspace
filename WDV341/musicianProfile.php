<?php
include 'connectPDOBANDIT.php';
session_cache_limiter('none');
session_start();

if(isset($_SESSION['validUser']) && ($_SESSION['validUser'] == "YES"))
{
	$user_name = $_SESSION['userName'];
	$user_auth = $_SESSION['userAuth'];
	$user_id = $_SESSION['userId'];
}
else {
	header("Location:banditIndex.php");
}

$sql = "SELECT M_ID, M_FIRSTNAME, M_LASTNAME, M_INSTRUMENTS, M_BANDID, M_USER_ID, M_IMAGE FROM BANDIT_MUSICIAN WHERE M_USER_ID = :userId";
$stmt = $conn->prepare($sql);//prepare the query


$stmt->bindParam(":userId", $user_id);

echo $sql;

$stmt->execute();

$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

if ($userRow != "")
{

	
	
	$_SESSION['musicianId'] = $userRow['M_ID'];
	$_SESSION['musicianFirstName'] = $userRow['M_FIRSTNAME'];
	$_SESSION['musicianLastName'] = $userRow['M_LASTNAME'];
	$_SESSION['musicianInstruments'] = $userRow['M_INSTRUMENTS'];
	$_SESSION['musicianBandId'] = $userRow['M_BANDID'];
	$_SESSION['musicianUserId'] = $userRow['M_USER_ID'];
	$_SESSION['musicianImage'] = $userRow['M_IMAGE'];

	echo $_SESSION['musicianImage'];
	
	$m_id = $_SESSION['musicianId'];
	$m_firstname = $_SESSION['musicianFirstName'];
	$m_lastname = $_SESSION['musicianLastName'];
	$m_instruments = $_SESSION['musicianInstruments'];
	$m_bandid = $_SESSION['musicianBandId'];
	$m_userid =$_SESSION['musicianUserId'];
	$m_image = $_SESSION['musicianImage'];
	
	
	
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
<title>Band Page</title>
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