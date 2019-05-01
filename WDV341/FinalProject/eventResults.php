<?php
include 'connectPDOBANDIT.php';
session_cache_limiter('none');
session_start();
$event_id = $_POST['event_id'];
$event_userid = $_POST['event_userid'];
$user_name = $_SESSION['userName'];
$user_auth = $_SESSION['userAuth'];
$user_id = $_SESSION['userId'];
echo "id: " . $event_id;

if(isset($_SESSION['validUser']) && ($_SESSION['validUser'] !== "YES"))
{
	header("Location:banditIndex.php");
}
else if(isset($_SESSION['bandId'])){
			
	
			$venue_id = 1;
			
}else{
	
}

$sql = ("SELECT EVENT_ID, EVENT_NAME, EVENT_DESCRIPTION, EVENT_USERID, EVENT_DATE, EVENT_VENUEID, EVENT_BANDID, EVENT_TIME FROM BANDIT_EVENT WHERE EVENT_ID = '$event_id'");
$stmt=$conn->prepare($sql);
$stmt->execute();


while ($stmt->fetch(PDO::FETCH_ASSOC))
{

	//$event_description = $userRow['EVENT_DESCRIPTION'];
	$event_venueid = $userRow['EVENT_VENUEID'];
	$event_bandid = $userRow['EVENT_BANDID'];


	
	

	/*$m_id = $_SESSION['musicianId'];
	$m_firstname = $_SESSION['musicianFirstName'];
	$m_lastname = $_SESSION['musicianLastName'];
	$m_instruments = $_SESSION['musicianInstruments'];
	$m_bandid = $_SESSION['musicianBandId'];
	$m_userid =$_SESSION['musicianUserId'];
	$m_image = $_SESSION['musicianImage'];*/


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

<header>Event Updated</header>

<div class="container">
<table>
<tr>
	<th>ID</th>
	<th>Name</th>
	<th>Description</th>
	<th>User</th>	
	<th>Date</th>
	<th>Venue</th>
	<th>Band</th>
	<th>Time</th>

</tr>
<tr>
	<td><?php echo $event_id ?></td>
	<td><?php echo $event_name ?></td>
	<td><?php echo $event_description ?></td>
     <td><?php echo $event_userid ?></td>
     <td><?php echo $event_date ?></td>
     <td><?php echo $event_venueid ?></td>
     <td><?php echo $band_id ?></td>
	<td><?php echo $event_time ?></td>
	
	
</tr>
</table>

	<a href="bandProfile.php?$bandId=$band_id">Home</a>
</div>
</body>
</html>