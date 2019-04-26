<?php
session_cache_limiter('none');
session_start();
include 'connectPDO2.php';
echo "Events Results Page: ";
$eventId = $_POST['event_id'];
echo $eventId;
$sql = ("SELECT EVENT_ID, EVENT_NAME, EVENT_DESCRIPTION, EVENT_PRESENTER, EVENT_DATE, EVENT_TIME FROM WDV_EVENT WHERE EVENT_ID = '$eventId'");
$stmt=$conn->prepare($sql);
$stmt->execute();
?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link href="style.css" rel="stylesheet" style="text/css" />
<title>Event Creation Results</title>
</head>
<body>

<header>Event Updated</header>

<div class="container">
<table>
<tr>
	<th>Name</th>
	<th>Description</th>
	<th>Presenter</th>
	<th>Date</th>
	<th>Time</th>
</tr>
<tr>
	<td><?php echo $event_name ?></td>
	<td><?php echo $event_description ?></td>
	<td><?php echo $event_presenter ?></td>
	<td><?php echo $event_date ?></td>
	<td><?php echo $event_time ?></td>
</tr>
</table>

	<a href="selectEvents.php">Event List</a>
</div>
</body>
</html>