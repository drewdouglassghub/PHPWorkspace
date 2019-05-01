<?php
include 'connectPDOBANDIT.php';
session_cache_limiter('none');
session_start();

if(!isset($_SESSION['validUser']) || ($_SESSION['validUser'] != "YES") || ($_SESSION['userAuth'] != "ADMIN"))
{
	header("Location:banditIndex.php");
	
	
}
else 
{
	//$_SESSION['bandId'] = $_GET['bandId'];
	$band_id = $_SESSION['bandId'];
	$user_name = $_SESSION['userName'];
	$user_auth = $_SESSION['userAuth'];
	$user_id = $_SESSION['userId'];



$sql = ("SELECT BAND_ID, BAND_NAME, BAND_STYLE, BAND_IMAGE, BAND_EMAIL FROM BANDIT_BAND");


$stmt=$conn->prepare($sql);


$stmt->execute();

echo "statement executed";
}
?>


<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link href="style.css" rel="stylesheet" style="text/css" />
<title>Event Creation Results</title>
</head>
<body>

<header>Event Schedule</header>
	<div class="container">
	<table border='1'>
		<tr>
			<td>ID</td>
			<td>Name</td>
			<td>Style</td>
			<td>Image</td>
			<td>Email</td>
		</tr>
		<?php 
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{				
				echo "<tr>";
				echo "<td>" . $row['BAND_ID'] . "</td>";
				echo "<td>" . $row['BAND_NAME'] . "</td>";
				echo "<td>" . $row['BAND_STYLE'] . "</td>";
				echo "<td>" . $row['BAND_IMAGE'] . "</td>";
				echo "<td>" . $row['BAND_EMAIL'] . "</td>";
				echo "<td><a href='updateBanditBand.php?bandId=" . $row['BAND_ID'] . "'>Update</a></td>";
				echo "<td><a href='deleteBanditBand.php?bandId=" . $row['BAND_ID'] . "'>Delete</a></td>";
				echo "</tr>";
			}
			?>
			</table>
			</div>
			
<div class="container2">
	<a href="banditAdminPortal.php">Admin Home</a>
	</div>
</div>
</body>
</html>