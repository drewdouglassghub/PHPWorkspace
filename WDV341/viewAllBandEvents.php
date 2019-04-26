<?php
include 'connectPDOBANDIT.php';
session_cache_limiter('none');
session_start();

if(isset($_SESSION['validUser']) && ($_SESSION['validUser'] == "YES"))
{
	$_SESSION['bandId'] = $_GET['bandId'];
	$band_id = $_SESSION['bandId'];
	$user_name = $_SESSION['userName'];
	$user_auth = $_SESSION['userAuth'];
	$user_id = $_SESSION['userId'];
	
}
else 
{
	header("Location:banditIndex.php");
}


$sql = ("SELECT EVENT_ID, EVENT_NAME, EVENT_DESCRIPTION, EVENT_USERID, EVENT_DATE, EVENT_TIME, EVENT_BANDID, BAND_NAME FROM BANDIT_EVENT WHERE EVENT_USERID = :userId AND EVENT_BANDID = :bandId");


$stmt=$conn->prepare($sql);


$stmt->bindParam(":userId", $user_id);
$stmt->bindParam(":bandId", $band_id);


echo $sql;
echo "USERID: " . $user_id;
echo "BANDID: " . $band_id;

$stmt->execute();

echo "statement executed";

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
	<th>UserID</th>
	<th>Date</th>
	<th>Time</th>
	<th>BandID</th>
</tr>
<tr>
<?php
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
	echo "<tr>";
	echo "<td>" . $row['EVENT_ID'] . "</td>";
	echo "<td>" . $row['EVENT_NAME'] . "</td>";
	echo "<td>" . $row['EVENT_DESCRIPTION'] . "</td>";
	echo "<td>" . $row['EVENT_USERID'] . "</td>";
	echo "<td>" . $row['EVENT_DATE'] . "</td>";
	echo "<td>" . $row['EVENT_TIME'] . "</td>";
	echo "<td>" . $row['EVENT_BANDID'] . "</td>";
	
}
?>
</tr>
</table>

	<a href="selectEvents.php">Event List</a>
</div>
</body>
</html>