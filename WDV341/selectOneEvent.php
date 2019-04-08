<?php
include 'connectPDO2.php';
session_start();
$stmt = $conn->prepare("SELECT EVENT_ID, EVENT_NAME, EVENT_DESCRIPTION, EVENT_PRESENTER, EVENT_DATE, EVENT_TIME FROM WDV_EVENT WHERE EVENT_ID = 23");
$stmt->execute();
echo "executed";
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Select One Event</title>
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
</head>
<body>
	<h1>Your Event</h1>
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
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{				
				echo "<tr>";
				echo "<td>" . $row['EVENT_ID'] . "</td>";
				echo "<td>" . $row['EVENT_NAME'] . "</td>";
				echo "<td>" . $row['EVENT_DESCRIPTION'] . "</td>";
				echo "<td>" . $row['EVENT_PRESENTER'] . "</td>";
				echo "<td>" . $row['EVENT_DATE'] . "</td>";
				echo "<td>" . $row['EVENT_TIME'] . "</td>";
				echo "</tr>";
			}
			?>
			</table>
			
			<?php 
			echo "<h1>No additional events currently scheduled.</h1>";
			echo "<h3>You may add an event here: </h3>";
			echo "<a href='eventsForm.php'>Add Event</a>";
			?>
	
</body>
</html>