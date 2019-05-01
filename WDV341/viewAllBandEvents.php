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


$sql = ("SELECT EVENT_ID, EVENT_NAME, EVENT_DESCRIPTION, EVENT_USERID, EVENT_DATE, EVENT_TIME, EVENT_BANDID, EVENT_VENUEID FROM BANDIT_EVENT WHERE EVENT_USERID = :userId AND EVENT_BANDID = :bandId");


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

<header>Band Events</header>

<div class="container">

<?php
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
	echo "<p>
        <div class='eventBlock'>	
            <div>";
			$date = explode('/', $row['EVENT_DATE']);
			
			$year = $date[2];
			$month = $date[0];
			
			echo "year: " . $year;
			echo "month: " . $month;
			
           if ($month == date("m")){
           	
           	echo "<span class='displayEvent'style='font-style:italic; font-weight:bold; color: red'>Event: "  . $row['EVENT_NAME'] . "</span></br>
           	</div>
           		<div>
                <span class='displayVenue'>Venue: "  . $row['EVENT_VENUEID'] . "</span>
            </div>
           		<div>
           			<span class='displayDescription'>Description: " . $row['EVENT_DESCRIPTION'] . "</span>
           		</div>
           	<div>
           	<span class='displayDate'>Date: " . $row['EVENT_DATE'] . "</span>
           	</div>
           	<div>
           	<span class='displayTime'>Time: " . $row['EVENT_TIME'] . "</span>
           	</div>
           	<div>
            	<span class='displayBand'>Band: " . $row['EVENT_BANDID'] . "</span>
            </div>
            <div>
            <a href='updateEvent.php?eventID=" . $row['EVENT_ID'] . "'>Update</a>
            </div>
           	</div>
           	</p>";
           }
           	else if ($month > date("m") && ($year >= date("Y"))){
           	echo "<span class='displayEvent' style='font-style:italic'>Event: "  . $row['EVENT_NAME'] . "</span></br>
           		
            </div>
            <div>
                <span class='displayVenue'>Venue: "  . $row['EVENT_VENUEID'] . "</span>
            </div>
            <div>
            	<span class='displayDescription'>Description: " . $row['EVENT_DESCRIPTION'] . "</span>
            </div>
            <div>
            	<span class='displayDate'>Date: " . $row['EVENT_DATE'] . "</span>
            </div>
            <div>
            	<span class='displayTime'>Time: " . $row['EVENT_TIME'] . "</span>
            </div>
            <div>
            	<span class='displayBand'>Band: " . $row['EVENT_BANDID'] . "</span>
            </div>
            <div>
            <a href='updateEvent.php?eventID=" . $row['EVENT_ID'] . "'>Update</a>
            </div>
        	</div>
    		</p>";
  			}
  			else{
  				echo "<span class='displayEvent'>Event: "  . $row['EVENT_NAME'] . "</span></br>
  				 
  				</div>
  				<div>
                <span class='displayVenue'>Venue: "  . $row['EVENT_VENUEID'] . "</span>
            </div>
  				<div>
  				<span class='displayDescription'>Description: " . $row['EVENT_DESCRIPTION'] . "</span>
  				</div>
  				<div>
  				<span class='displayDate'>Date: " . $row['EVENT_DATE'] . "</span>
  				</div>
  				<div>
  				<span class='displayTime'>Time: " . $row['EVENT_TIME'] . "</span>
  				</div>
  				<div>
            	<span class='displayBand'>Band: " . $row['EVENT_BANDID'] . "</span>
            </div>
            <div>
            <a href='updateEvent.php?eventID=" . $row['EVENT_ID'] . "'>Update</a>
            </div>
  				</div>
  				</p>";
	
}
?>


	<a href="banditAdminPortal.php">Admin Home</a>
</div>
</body>
</html>