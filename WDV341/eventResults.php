<?php
session_cache_limiter('none');
session_start();
//include 'connectPDOBANDIT.php';
if(isset($_SESSION['validUser']) && ($_SESSION['validUser'] !== "YES"))
{
	header("Location:banditIndex.php");
}
else{
			
			$event_name = $_SESSION['name'];
			$event_description = $_SESSION['description'];
			$event_userid = $_SESSION['userid'];
			$event_date = $_SESSION['date'];
			$event_time = $_SESSION['time'];		
			$band_id = $_SESSION['bandId'];
			$user_name = $_SESSION['userName'];
			$user_auth = $_SESSION['userAuth'];
			$user_id = $_SESSION['userId'];
			$venue_id = 1;

}

//$sql = ("SELECT EVENT_ID, EVENT_NAME, EVENT_DESCRIPTION, EVENT_USERID, EVENT_DATE, EVENT_TIME FROM BANDIT_EVENT WHERE EVENT_ID = '$eventId'");


	
	
	
//$stmt=$conn->prepare($sql);
//$stmt->execute();

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
	<th>User</th>
	<th>Band</th>
	<th>Venue</th>
	<th>Date</th>
	<th>Time</th>

</tr>
<tr>
	<td><?php echo $event_name ?></td>
	<td><?php echo $event_description ?></td>
     <td><?php echo $event_userid ?></td>
     <td><?php echo $band_id ?></td>
	<td><?php echo $event_venueid ?></td>
	<td><?php echo $event_date ?></td>
	<td><?php echo $event_time ?></td>
	
	
</tr>
</table>

	<a href="selectBandEvents.php">Event List</a>
</div>
</body>
</html>