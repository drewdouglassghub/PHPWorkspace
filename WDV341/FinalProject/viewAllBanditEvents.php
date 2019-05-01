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



$sql = ("SELECT EVENT_ID, EVENT_NAME, EVENT_DESCRIPTION, EVENT_USERID, EVENT_DATE, EVENT_TIME, EVENT_BANDID FROM BANDIT_EVENT");


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
			<td>Description</td>
			<td>User ID</td>
			<td>Date</td>
			<td>Time</td>
			<td>Band ID</td>
		</tr>
		<?php 
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{				
				echo "<tr>";
				echo "<td>" . $row['EVENT_ID'] . "</td>";
				echo "<td>" . $row['EVENT_NAME'] . "</td>";
				echo "<td>" . $row['EVENT_DESCRIPTION'] . "</td>";
				echo "<td>" . $row['EVENT_USERID'] . "</td>";
				echo "<td>" . $row['EVENT_DATE'] . "</td>";
				echo "<td>" . $row['EVENT_TIME'] . "</td>";
				echo "<td>" . $row['EVENT_BANDID'] . "</td>";
				echo "<td><a href='updateBanditEvent.php?eventId=" . $row['EVENT_ID'] . "'>Update</a></td>";
				echo "<td><a href='deleteBanditEvent.php?eventId=" . $row['EVENT_ID'] . "'>Delete</a></td>";
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