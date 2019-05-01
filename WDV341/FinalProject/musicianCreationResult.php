<?php
include 'connectPDOBANDIT.php';
session_cache_limiter('none');
session_start();


			$user_name = $_SESSION['userName'];
			$user_auth = $_SESSION['userAuth'];
			$user_id = $_SESSION['userId'];
			$m_firstname = $_SESSION['mFirstName'];
	 		$m_lastname = $_SESSION['mLastName'] ;
			$m_instruments = $_SESSION['mInstruments'];

echo "name: " . $user_name;

if(isset($_SESSION['validUser']) && ($_SESSION['validUser'] !== "YES"))
{
	header("Location:banditIndex.php");
}
else if(isset($_POST['submit'])){
			
	
			$venue_id = 1;
			
}else{
	
}

	/*function getMusicianObject() {

		alert("insideGetMusicianObject()");

		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		  if (this.readyState == 4 && this.status == 200) {
			  console.log(this.responseText);
			var myObj = JSON.parse(this.responseText);
			document.getElementById("m_firstname").innerHTML = myObj.firstName;
		  }
		};
		xmlhttp.open("GET", "deliverMusicianProfile.php", true);
		xmlhttp.send();		
		
	}*/


$sql = ("SELECT M_ID, M_FIRSTNAME, M_LASTNAME, M_ISNTRUMENTS, EVENT_DATE, M_BANDID, EVENT_BANDID, M_USER_ID, M_IMAGE FROM BANDIT_EVENT WHERE M_ID = '$m_id'");
$stmt=$conn->prepare($sql);
$stmt->execute();


while ($stmt->fetch(PDO::FETCH_ASSOC))
{

	//$event_description = $userRow['EVENT_DESCRIPTION'];
	//$event_venueid = $userRow['EVENT_VENUEID'];
	//$event_bandid = $userRow['EVENT_BANDID'];


	
	

	$_SESSION['musicianId'] = $m_id;
	$_SESSION['musicianFirstName'] = $m_firstname;
	$_SESSION['musicianLastName'] = $m_lastname;
	$_SESSION['musicianInstruments'] = $m_instruments;
	$_SESSION['musicianBandId'] = $m_bandid;
	$_SESSION['musicianUserId'] =$m_userid;
	$_SESSION['musicianImage'] = $m_image;


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


<span id="displayMusician"></span>


<div class="container">
<table>
<tr>
	<th>ID</th>
	<th>First</th>
	<th>Last</th>
	<th>Instruments</th>	
	<th>Band Id</th>
	<th>User Id</th>
	<th>Image</th>


</tr>
<tr>
	<td ><?php echo $m_id ?></td>
	<td><?php echo $m_firstname ?></td>
	<td><?php echo $m_lastname ?></td>
     <td><?php echo $m_instruments ?></td>
     <td><?php echo $m_bandid ?></td>
     <td><?php echo $m_userid ?></td>
     <td><?php echo $m_image ?></td>
	
	
</tr>
</table>

	<a href="musicianProfile.php?musicianId=$m_id">Home</a>
</div>
</body>
</html>