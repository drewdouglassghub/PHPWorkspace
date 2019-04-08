<?php
include 'FormValidation.php';
include 'connectPDO2.php';
$formValidations = new validations();
session_cache_limiter('none');
session_start();

$eventId = $_GET['eventID'];

$stmt = $conn->prepare("SELECT EVENT_ID, EVENT_NAME, EVENT_DESCRIPTION, EVENT_PRESENTER, EVENT_DATE, EVENT_TIME FROM WDV_EVENT WHERE EVENT_ID = '$eventId'");
$stmt->execute();



if(($_SESSION['validUser']) != "yes")
{
	header("Location:presenterLogin.php");
}
else{
	$event_id = "";
	$event_name = "";
	$event_description = "";
	$event_presenter="";
	$event_date = "";
	$event_time = "";
	$event_address = "";

	$eventIdErrMsg = "";
	$eventFieldErrMsg = "";
	$eventDescriptionErrMsg = "";
	$eventPresenterErrMsg = "";
	$eventDateErrMsg = "";
	$eventTimeErrMsg = "";
	$eventAddressErrMsg = "";

	$validForm = false;

	if(isset($_POST["submit"]))
	{
		//The form has been submitted and needs to be processed


		//Validate the form data here!

		//Get the name value pairs from the $_POST variable into PHP variables
		//This example uses PHP variables with the same name as the name atribute from the HTML form
		
		$event_name = $_POST['event_name'];
		$event_description = $_POST['event_description'];
		$event_presenter = $_POST['event_presenter'];
		$event_date = $_POST['event_date'];
		$event_time = $_POST['event_time'];
		$event_address = $_POST['event_address'];


		function clearForm()
		{
			$event_name = "";
			$event_description = "";
			$event_presenter = "";
			$event_date = "";
			$event_time = "";
		}

		function validateMustBeFilled($inValue)
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
		validateAddress($event_address);

		if($validForm)
		{
			$message = "";

			echo "valid";

			echo $event_id;

			try {

				require 'connectPDO2.php';	//CONNECT to the database

				
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//mysql DATE stores data in a YYYY-MM-DD format
				$todaysDate = date("Y-m-d");		//use today's date as the default input to the date( )
				echo $todaysDate;
				//Create the SQL command string
				$sqlu = "UPDATE WDV_EVENT SET EVENT_NAME = :name, EVENT_PRESENTER = :presenter, EVENT_DATE = :date, EVENT_TIME = :time, EVENT_DESCRIPTION = :description WHERE EVENT_ID = '$event_id'";
				
				echo "UPDATE SUCCESS";
				//PREPARE the SQL statement
				$stmtu = $conn->prepare($sqlu);
				echo "connection prepared";
				//BIND the values to the input parameters of the prepared statement
				//$stmtu->bindParam(':id', $event_id);
				$stmtu->bindParam(':name', $event_name);			
				$stmtu->bindParam(':presenter', $event_presenter);
				$stmtu->bindParam(':date', $event_date);
				$stmtu->bindParam(':time', $event_time);
				$stmtu->bindParam(':description', $event_description);
					
				echo "connection parameterized";

				//EXECUTE the prepared statement
				$stmtu->execute($sqlu);
				echo "executed";
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
				
				$event_name=$row['EVENT_NAME'];
				$event_description=$row['EVENT_DESCRIPTION'];
				$event_date=$row['EVENT_DATE'];
				$event_time=$row['EVENT_TIME'];
				$event_presenter=$row['EVENT_PRESENTER'];
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
			action="updateEvent.php">
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
				<input type="hidden" name="event_address" id="textfield">
				<?php //HONEYPOT FIELD ?>
			</p>
			
			<p>
			<input type="hidden" name="event_id" id="event_id" value="<?php echo $event_id; ?>" />
				<?php //ID FIELD?>
			</p>
			<p>
				<label for="textfield1">Name:</label> <input type="text" size="45"
					name="event_name" id="textfield1"
					value="<?php echo $event_name;  ?>"> <span class="errMsg"> <?php echo $eventFieldErrMsg; ?>
				</span>
			</p>

			<p>
				<label for="textfield3">Event Presenter: </label> <input type="text"
					name="event_presenter" id="textfield3"
					value="<?php echo $event_presenter;  ?>"> <span class="errMsg"> <?php echo $eventFieldErrMsg; ?>
				</span>
			</p>

			<p>
				<label for="textfield4">Event Date:</label> <input type="text"
					name="event_date" id="textfield4"
					value="<?php echo $event_date;  ?>"> <span class="errMsg"> <?php echo $eventDateErrMsg; ?>
				</span>
			</p>
			<p>
				<label for="textfield5">Event Time: </label> <input type="text"
					name="event_time" id="textfield5"
					value="<?php echo $event_time;  ?>"> <span class="errMsg"> <?php echo $eventTimeErrMsg; ?>
				</span>
			</p>
			<p>
				<label for="textfield2">Event Description:</label>
				<textarea type="text" rows="2" cols="45" name="event_description"
					id="textfield2"><?php echo $event_description;  ?></textarea>
				<span class="errMsg"> <?php echo $eventFieldErrMsg; ?>
				</span>
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
