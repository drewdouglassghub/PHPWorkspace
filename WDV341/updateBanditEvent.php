<?php
session_cache_limiter('none');
session_start();
include 'connectPDOBANDIT.php';
$event_userid = $_SESSION['userId'];
$user_name = $_SESSION['userName'];
$user_auth = $_SESSION['userAuth'];
$user_id = $_SESSION['userId'];
$event_id = $_GET['eventId'];
$_SESSION['eventId'] = $event_id;
$event_userid = $user_id;


$stmt = $conn->prepare("SELECT EVENT_ID, EVENT_NAME, EVENT_DESCRIPTION, EVENT_USERID, EVENT_DATE, EVENT_TIME, EVENT_VENUEID, EVENT_BANDID FROM BANDIT_EVENT WHERE EVENT_ID = :eventId");

$stmt->bindParam(':eventId', $event_id);
$stmt->execute();


if(($_SESSION['validUser']) != "YES")
{
	header("Location:banditIndex.php");
}
else{
	$event_name = "";
	$event_description = "";
	$event_date = "";
	$event_time = "";
	$event_address = "";
	$event_venueid = "";
	$event_bandid = "";
	$eventIdErrMsg = "";
	$eventFieldErrMsg = "";
	$eventDescriptionErrMsg = "";
	$eventUserIdErrMsg = "";
	$eventDateErrMsg = "";
	$eventTimeErrMsg = "";
	$eventVenueIdErrMsg = "";
	$eventBandIdErrMsg = "";
	$eventAddressErrMsg = "";
	$validForm = false;
	
	$band_id = $_SESSION['bandId'];
	

	if(isset($_POST["submit"]))
	{
		//The form has been submitted and needs to be processed
		//Validate the form data here!
		//Get the name value pairs from the $_POST variable into PHP variables
		//This example uses PHP variables with the same name as the name atribute from the HTML form
		$event_id = $_POST['event_id'];
		$event_name = $_POST['event_name'];
		$event_description = $_POST['event_description'];
		$event_userid = $_POST['event_userid'];
		$event_date = $_POST['event_date'];
		$event_time = $_POST['event_time'];
		$event_venueid = $_POST['event_venueid'];
		$event_bandid = $_POST['event_bandid'];
		$event_address = $_POST['event_address'];
		
		$band_id = $_POST['event_bandid'];
		
		/*function validateMustBeFilled($inValue)
		{
			global $validForm, $eventFieldErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
			$eventNameErrMsg = "";
			if($inValue == "")
			{
				$validForm = false;
				$eventFieldErrMsg = "Field must be completed.";
			}
		}//end validateName()
		function validateAddress($inAddress)
		{
			global $validForm, $eventAddressErrMsg;
			$eventAddressErrMsg = "";
			if($inAddress !== "")
			{
				echo "Error.  Please resubmit the form.";
				$validForm = false;
			}
		}
			
		function validateDate($inDate)
		{
			if (preg_match("^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$", $inDate))
			{
				return true;
			}else{
				return false;
			}
		}
		//VALIDATE FORM DATA  using functions defined above
		$validForm = true;		//switch for keeping track of any form validation errors
		validateMustBeFilled($event_name);
		validateMustBeFilled($event_description);
		validateMustBeFilled($event_presenter);
		validateDate($event_date);
		validateAddress($event_address);*/
		

		$validForm = true;
		if($validForm)
		{
			$message = "";
	
			try {
				include 'connectPDOBANDIT.php';

				//mysql DATE stores data in a YYYY-MM-DD format
				$todaysDate = date("Y-m-d");		//use today's date as the default input to the date( )

				date_format($event_date,"Y/m/d");
				$event_time = date('H:i:s', strtotime($event_time));
				
				
				
				
				//Create the SQL command string
				$sqlu = "UPDATE BANDIT_EVENT SET EVENT_NAME = :name, EVENT_DESCRIPTION = :description, EVENT_USERID = :userId, EVENT_DATE = :date, EVENT_VENUEID = :venueId, EVENT_BANDID =  :bandId, EVENT_TIME = :time WHERE EVENT_ID = :eventId";
				echo "id: " . $event_id;
				echo "name: " . $event_name;
				echo "desc: " . $event_description;
				echo "user: " . $event_userid;
				echo "date: " . $event_date;
				echo "venue: " . $event_venueid;
				echo "band: " . $event_bandid;
				echo "time: " . $event_time;
	
				//PREPARE the SQL statement
				$stmtu = $conn->prepare($sqlu);
				//BIND the values to the input parameters of the prepared statement

				
				
				$stmtu->bindParam(':eventId', $event_id);
				$stmtu->bindParam(':name', $event_name);
				$stmtu->bindParam(':description', $event_description);		
				$stmtu->bindParam(':userId', $event_userid);	
				$stmtu->bindParam(':date', $event_date);			
				$stmtu->bindParam(':venueId', $event_venueid);
				$stmtu->bindParam(':bandId', $event_bandid);
				$stmtu->bindParam(':time', $event_time);
				
				echo "id: " . $event_id;
				echo "name: " . $event_name;
				echo "desc: " . $event_description;
				echo "user: " . $event_userid;
				echo "date: " . $event_date;
				echo "venue: " . $event_venueid;
				echo "band: " . $event_bandid;
				echo "time: " . $event_time; 

				echo "connection parameterized";
				//EXECUTE the prepared statement
				$stmtu->execute($sqlu);
				echo "executed";
				
				$_SESSION['$eventId'] = $event_id;
				include 'eventResults.php';
				
	
			}
			catch(PDOException $e)
			{
				$message = "There has been a problem. The system administrator has been contacted. Please try again later.";
				error_log($e->getMessage());
				error_log($e->getLine());
				error_log(var_dump(debug_backtrace()));
			}
		}
		else
		{
			$message = "Something went wrong";
		}//ends check for valid form
	}
	else
	{
				
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				$row=$stmt->fetch(PDO::FETCH_ASSOC);
				
				$event_id=$row['EVENT_ID'];
				$event_name=$row['EVENT_NAME'];
				$event_description=$row['EVENT_DESCRIPTION'];
				$event_date=$row['EVENT_DATE'];				
				$event_venueid=$row['EVENT_VENUEID'];
				$event_bandid=$row['EVENT_BANDID'];
				$event_time=$row['EVENT_TIME'];

						//Form has not been seen by the user.  display the form
	}// ends if submit
}
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
<link href="style.css" rel="stylesheet" style="text/css" />
</head>
<body>


	<div class="container">

		<h2 style="text-align: left; margin-left: 2em;">Update your event:</h2>
		<form name="form1" method="post" id="event_creation"
			action="updateBanditEvent.php">
			<?php
			//If the form was submitted and valid and properly put into database display the INSERT result message
			if($validForm)
			{
				?>
			<h1>
				<?php echo $message ?>
			</h1>

			<?php
			}
			else	//display form
			{
				?>

			<p>
				<input type="hidden" name="event_address" id="event_address">
				<?php //HONEYPOT FIELD ?>
			</p>
			
			<p>
			<input type="hidden" name="event_id" id="event_id" value="<?php echo $event_id; ?>" />
				<?php //ID FIELD?>
			</p>
			<p>
				<label for="event_name">Name:</label> <input type="text" size="45"
					name="event_name" id="event_name"
					value="<?php echo $event_name;  ?>"> <span class="errMsg"> <?php echo $eventFieldErrMsg; ?>
				</span>
			</p>

			<p>
				<label for="event_date">Event Date:</label> <input type="text"
					name="event_date" id="event_date"
					value="<?php echo $event_date;  ?>"> <span class="errMsg"> <?php echo $eventDateErrMsg; ?>
				</span>
			</p>
			<p>
				<label for="event_time">Event Time: </label> <input type="time"
					name="event_time" id="event_time"
					value="<?php echo $event_time;  ?>"> <span class="errMsg"> <?php echo $eventTimeErrMsg; ?>
				</span>
			</p>
			<p>
				<label for="event_description">Event Description:</label>
				<textarea type="text" rows="2" cols="45" name="event_description" id="event_description"><?php echo $event_description;  ?></textarea>
				<span class="errMsg"> <?php echo $eventFieldErrMsg; ?>
				</span>
			</p>
			<p>
				<input type="hidden" name="event_venueid" id="event_venueid" value="<?php echo $event_venueid;  ?>"> 
				<span class="errMsg"> <?php echo $eventFieldErrMsg; ?></span>
			</p>
			<p>
				<input type="hidden" name="event_userid" id="event_userid" value="<?php echo $event_userid;  ?>"> 
				<span class="errMsg"> <?php echo $eventFieldErrMsg; ?></span>
			</p>
			<p>
				<input type="hidden" name="event_bandid" id="event_bandid" value="<?php echo $event_bandid;  ?>"> 
				<span class="errMsg"> <?php echo $eventFieldErrMsg; ?></span>
			</p>
			<p>
				<input type="submit" name="submit" id="submit" value="Submit"
					class="button"> <input type="reset" name="btnReset" id="reset"
					value="Reset" class="button">
			</p>
		</form>
		<?php
			}//end else
			?>

	</div>
</body>
</html>