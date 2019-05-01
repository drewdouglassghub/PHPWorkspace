<?php 
//include('FormValidation.php');
include 'connectPDOBANDIT.php';
//$formValidations = new validations();
session_cache_limiter('none');
session_start();
$user_name = $_SESSION['userName'];
$user_auth = $_SESSION['userAuth'];
$user_id = $_SESSION['userId'];
$band_id = $_SESSION['bandId'];

if(isset($_SESSION['validUser']) && ($_SESSION['validUser'] !== "YES"))
{	
	header("Location:banditIndex.php");
}
else{
	
	$event_id = "";
	$event_name = "";
	$event_description = "";
	$event_userid ="";
	$event_date = "";
	$event_time = "";
	$event_address = "";
	$event_venueid = "";
	
	$eventIdErrMsg = "";
	$eventFieldErrMsg = "";
	$eventDescriptionErrMsg = "";
	$eventUserIdErrMsg = "";
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
		$event_userid = $user_id;
		$event_date = $_POST['event_date'];
		$event_time = $_POST['event_time'];
		$event_address = $_POST['event_address'];
		$event_venueid = 1;
		
		
	function clearForm()
	{
		$event_name = "";
		$event_description = "";
		$event_date = "";
		$event_time = "";
	}
		
	function validateMustBeFilled($inValue)
			{
				global $validForm, $eventFieldErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$eventNameErrMsg = "";
				
				
				
				if($inValue == "")
				{
					echo "validated empty";
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
			if (preg_match("^-[0-1][0-9]/[0-3][0-9]/[0-9]{4}$", $inDate))
			{
				echo "date valid";
				return true;
			}else{
				return false;
			}
		}

		//VALIDATE FORM DATA  using functions defined above
		$validForm = true;		//switch for keeping track of any form validation errors
		
		
		
		validateMustBeFilled($event_name);
		validateMustBeFilled($event_description);
		validateMustBeFilled($event_userid);		
		validateDate($event_date);
		validateAddress($event_address);
		
		if($validForm)
		{
			
			
			
			$_SESSION['name'] = $event_name;
			$_SESSION['description'] = $event_description;			
			$_SESSION['venueid'] = $event_venueid;
		    $_SESSION['date'] = $event_date;
			$_SESSION['time'] = $event_time;
			
				echo $band_id;
			try {
		
				
				//mysql DATE stores data in a YYYY-MM-DD format
				$todaysDate = date("Y-m-d");		//use today's date as the default input to the date( )
				
				date_format($event_date,"Y/m/d");		
				$event_time = date('H:i:s', strtotime($event_time));
				
				$sql ="INSERT INTO BANDIT_EVENT (EVENT_NAME, EVENT_DESCRIPTION, EVENT_USERID, EVENT_DATE, EVENT_VENUEID, EVENT_BANDID, EVENT_TIME) VALUES(:name, :description, :userid, :date, :venueid, :bandid, :time)";
				echo $sql;
				//PREPARE the SQL statement
				$stmt = $conn->prepare($sql);
				echo "connection prepared";
				//BIND the values to the input parameters of the prepared statement
				$stmt->bindParam(':name', $event_name);
				$stmt->bindParam(':description', $event_description);
				$stmt->bindParam(':userid', $event_userid);
				$stmt->bindParam(':date', $event_date);
				$stmt->bindParam(':venueid', $event_venueid);
				$stmt->bindParam(':bandid', $band_id);
				$stmt->bindParam(':time', $event_time);
				
				//EXECUTE the prepared statement
				$stmt->execute();
				
				$message = "The event has been created.";
				include('eventResults.php');
			}
				
			catch(PDOException $e)
			{
				$message = "There has been a problem. The system administrator has been contacted. Please try again later.";
		
				
			}
		
		}
		else
		{
			$message = "Something went wrong";
			
		}//ends check for valid form
		
		}
		else
		{
			//Form has not been seen by the user.  display the form
		}// ends if submit
	}
		?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Event Form</title>
<link href="style.css" rel="stylesheet" style="text/css"/>
</head>
<body>
<p>&nbsp;</p>

<header>Event Registration Form</header>

<div class="container">
<h2 style="text-align:left; margin-left:2em;">Create your event:</h2>
<form name="form1" method="post" id="event_creation" action="insertBanditEvent.php">
  <?php
            //If the form was submitted and valid and properly put into database display the INSERT result message
			if($validForm)
			{
        ?>
            <h1><?php echo $message ?></h1>
        
        <?php
			}
			else	//display form
			{
        ?>
        
        <p>
        <input type="hidden" name="event_address" id="textfield">  <?php //HONEYPOT FIELD ?>
        </p>
  
      <p>
        <label for="textfield1">Name:</label>
        <input type="text" name="event_name" id="textfield1" value="<?php echo $event_name;  ?>">
         <span class="errMsg"> <?php echo $eventFieldErrMsg; ?></span>
      </p>
      <p>
        <label for="textfield2">Event Description:</label>
        <input type="text" name="event_description" id="textfield2" value="<?php echo $event_description;  ?>">
        <span class="errMsg"> <?php echo $eventFieldErrMsg; ?></span>
      </p>
      <p>
        <input type="hidden" name="event_userid" id="event_userid" value="<?php echo $event_userid;  ?>">       
      </p>

      <p>
        <input type="hidden" name="event_venueid" id="event_venueid" value="<?php echo $event_venueid;  ?>">       
      </p>
      
       <p>
        <label for="textfield4">Event Date:</label>
        <input type="date" name="event_date" id="textfield4" value="<?php echo $event_date;  ?>">
        <span class="errMsg"> <?php echo $eventDateErrMsg; ?></span>
      </p>
     <p>
        <label for="textfield5">Event Time: </label>
        <input type="time" name="event_time" id="textfield5" value="<?php echo $event_time;  ?>">
        <span class="errMsg"> <?php echo $eventTimeErrMsg; ?></span>
      </p>
   
  <p>
    <input type="submit" name="submit" id="submit" value="Submit" class="button">
    <input type="reset" name="btnReset" id="reset" value="Reset" class="button">
  </p>
</form>
<?php
			}//end else
        ?>    	
<a href='selectBanditEvents.php'>View Band Events</a>        
</div>

</body>
</html>