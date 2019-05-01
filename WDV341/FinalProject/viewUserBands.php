<?php
include 'connectPDOBANDIT.php';
session_start();
$event_userid = $_SESSION['userid'];
$user_name = $_SESSION['userName'];
$user_auth = $_SESSION['userAuth'];
$user_id = $_SESSION['userId'];
if(isset($_SESSION['validUser']) && ($_SESSION['validUser'] == "YES"))
{
	
	$user_name = $_SESSION['userName'];
	$user_auth = $_SESSION['userAuth'];
	$user_id = $_SESSION['userId'];

}
else {
	header("Location:banditIndex.php");
}

$sql = "SELECT BAND_ID, BAND_NAME, BAND_STYLE, BAND_IMAGE, BAND_DESCRIPTION, BAND_EMAIL FROM BANDIT_BAND WHERE BAND_USERID = :userId";
$stmt = $conn->prepare($sql);

$stmt->bindParam(":userId", $user_id);

$stmt->execute();



?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Bands</title>
<link href="style.css" rel="stylesheet" style="text/css" />
<style>
.eventBlock {
	width: 500px;
	margin-left: auto;
	margin-right: auto;
	background-color: #CCC;
}

.displayEvent {
	text_align: left;
	font-size: 18px;
}

.displayDescription {
	margin-left: 100px;
}
<link href="style.css" rel="stylesheet" style="text/css" />
</style>
</head>
<body>
	<h1>Your Bands</h1>
	<table border='1'>
		<tr>
			<td>ID</td>
			<td>Name</td>
			<td>Image</td>
			<td>Description</td>
			<td>Style</td>
			<td>Email</td>
		</tr>
		<?php 
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{				
				echo "<tr>";
				echo "<td>" . $row['BAND_ID'] . "</td>";
				echo "<td>" . $row['BAND_NAME'] . "</td>";
				echo "<td>" . $row['BAND_IMAGE'] . "</td>";
				echo "<td>" . $row['BAND_DESCRIPTION'] . "</td>";
				echo "<td>" . $row['BAND_STYLE'] . "</td>";
				echo "<td>" . $row['BAND_EMAIL'] . "</td>";
				echo "<td><a href='updateBand.php?bandId=" . $row['BAND_ID'] . "'>Update</a></td>";
				echo "<td><a href='deleteBand.php?bandId=" . $row['BAND_ID'] . "'>Delete</a></td>";
				echo "<td><a href='bandProfile.php?bandId=" . $row['BAND_ID'] . "'>Band Profile</a></td>";
				echo "<td><a href='selectBandEvents.php?bandId=" . $row['BAND_ID'] . "'>View Events</a></td>";
				echo "</tr>";
			}
			?>
			</table>
			
		<div class="container2">
			<a href='musicianProfile.php'>Home</a>
		</div>
</body>
</html>