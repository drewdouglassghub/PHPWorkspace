<?php

$event_name = $_SESSION['name'];
$event_description = $_SESSION['description'];
$event_presenter = $_SESSION['presenter'];
$event_date = $_SESSION['date'];
$event_time = $_SESSION['time'];


?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Event Creation Results</title>
</head>
<body>

<h1>Event Created</h1>

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

</body>
</html>