<?php
session_start();
if(isset($_SESSION['validUser']) && ($_SESSION['validUser'] !== "YES"))
{
	header("Location:banditIndex.php");
}
else{
	include 'connectPDOBANDIT.php';
			$band_id = $_SESSION['bandId'];
			$user_name = $_SESSION['userName'];
			$user_auth = $_SESSION['userAuth'];
			$user_id = $_SESSION['userId'];
			$venue_id = 1;
	
			$sql = ("SELECT EVENT_ID, EVENT_NAME, EVENT_DESCRIPTION, EVENT_BANDID, EVENT_DATE, EVENT_TIME FROM BANDIT_EVENT WHERE EVENT_BANDID = '$band_id'");
			$stmt = $conn->prepare($sql);
			$stmt->execute();

}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Event Creation Results</title>
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
</style>
<link href="style.css" rel="stylesheet" style="text/css"/>
</head>
<body>
	<header>Event Schedule</header>
	<div class="container2">
	<table border='1'>
		<tr>
			<td>ID</td>
			<td>Name</td>
			<td>Description</td>
			<td>BandId</td>
			<td>Date</td>
			<td>Time</td>
		</tr>
		<?php 
			$count = 1;
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{				
				echo "<tr>";
				echo "<td>" . $row['EVENT_ID'] . "</td>";
				echo "<td>" . $row['EVENT_NAME'] . "</td>";
				echo "<td>" . $row['EVENT_DESCRIPTION'] . "</td>";
				echo "<td>" . $row['EVENT_BANDID'] . "</td>";
				echo "<td>" . $row['EVENT_DATE'] . "</td>";
				echo "<td>" . $row['EVENT_TIME'] . "</td>";
				echo "<td><a href='updateBandEvent.php?eventID=" . $row['EVENT_ID'] . "'>Update</a></td>";
				echo "<td><a href='deleteBandEvent.php?eventID=" . $row['EVENT_ID'] . "'>Delete</a></td>";
				echo "</tr>";
			}
			?>
			</table>
			</div>
			
			<div class="container">
			<?php 			
			echo "<h1>No additional events currently scheduled.</h1>";
			echo "<h3>You may add an event here: </h3>";
			?>
			<a href='insertBanditEvent.php'>Add Event</a>
			<a href='bandProfile.php'>Band Home</a>
			<a href='musicianProfile.php'>Player Home</a>
		</div>
	
</body>
</html>