<?php
include 'connectPDO2.php';
session_start();
$stmt = $conn->prepare("SELECT EVENT_ID, EVENT_NAME, EVENT_DESCRIPTION, EVENT_PRESENTER, EVENT_DATE, EVENT_TIME FROM WDV_EVENT");
$stmt->execute();
echo "executed";

if(($_SESSION['validUser']) != "yes")
{
	header("Location:presenterLogin.php");
}
else{

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
			<td>Presenter</td>
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
				echo "<td>" . $row['EVENT_PRESENTER'] . "</td>";
				echo "<td>" . $row['EVENT_DATE'] . "</td>";
				echo "<td>" . $row['EVENT_TIME'] . "</td>";
				echo "<td><a href='updateEvent.php?eventID=" . $row['EVENT_ID'] . "'>Update</a></td>";
				echo "<td><a href='deleteEvent.php?eventID=" . $row['EVENT_ID'] . "'>Delete</a></td>";
				echo "</tr>";
			}
			?>
			</table>
			</div>
			
			<div class="container">
			<?php 
			
			echo "<h1>No additional events currently scheduled.</h1>";
			echo "<h3>You may add an event here: </h3>";
			echo "<a href='insertEvent.php'>Add Event</a>";

			?>
		
		</div>
	
</body>
</html>
