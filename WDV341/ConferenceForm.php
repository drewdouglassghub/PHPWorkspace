<?php 
session_start();


include("FormValidation.php");
$formValidations = new validations();

	$customer_id = "";
	$customer_name = "";
	$customer_phone="";
	$customer_email = "";
	$customer_role = "";
	$customer_badge = "";
	$customer_meals = "";
	$customer_requests = "";
	$customer_address = "";

	
	$customerNameErrMsg = "";
	$customerPhoneErrMsg = "";
	$customerEmailErrMsg = "";
	$customerRoleErrMsg = "";
	$customerBadgeErrMsg = "";
	$customerMealsErrMsg = "";
	$customerRequestsErrMsg = "";
	$customerAddressErrMsg = "";

	$validForm = false;
	
	if(isset($_POST['submit']))
	{	
		//The form has been submitted and needs to be processed	
		//Validate the form data here!	
		//Get the name value pairs from the $_POST variable into PHP variables
		//This example uses PHP variables with the same name as the name atribute from the HTML form
		$customer_id = $_POST['customer_id'];
		$customer_name = $_POST['customer_name'];
		$customer_phone = $_POST['customer_phone'];
		$customer_email = $_POST['customer_email'];
		$customer_role = $_POST['customer_role'];
		$customer_badge = $_POST['customer_badge'];
		$customer_meals = $_POST['customer_meals'];
		$customer_requests = $_POST['customer_requests'];
		$customer_address = $_POST['customer_address'];
		
	
		
	function clearForm()
	{
		$customer_name = "";
		$customer_phone = "";
		$customer_email = "";
		$customer_role = "";
		$customer_badge = "";
		$customer_meals = "";
		$customer_requests = "";
	}
		

	//VALIDATE FORM DATA  using functions defined above
	$validForm = true;		//switch for keeping track of any form validation errors

	$formValidations->validateNameStringChars($customer_name);
	$formValidations->validateAddress($customer_address);
	$formValidations->validateRequestStringChars($customer_requests);
	$formValidations->cannotBeEmpty($customer_name);
	$formValidations->validatePhone($customer_phone);
	$formValidations->validateEmail($customer_email);
	$formValidations->mustBeCheckedRole($customer_role);
	$formValidations->mustBeCheckedBadge($customer_badge);
	$formValidations->checkRequestLength($customer_requests);
	
		if($validForm)
		{
			$message = "All good";
			
			
			$_SESSION['name'] = $customer_name;
			$_SESSION['phone'] = $customer_phone;
			$_SESSION['email'] = $customer_email;
			$_SESSION['badge'] = $customer_badge;
			$_SESSION['meals'] = $customer_meals;
			$_SESSION['role'] = $customer_role;
			$_SESSION['requests'] = $customer_requests;
			
				
			try {
		
				require 'connectPDO.php';	//CONNECT to the database

				//mysql DATE stores data in a YYYY-MM-DD format
				$todaysDate = date("Y-m-d");		//use today's date as the default input to the date( )
				//Create the SQL command string
				$sql = "INSERT INTO CUSTOMERS (";
				$sql .= "NAME, ";
				$sql .= "PHONE, ";
				$sql .= "EMAIL, ";
				$sql .= "ROLE, ";
				$sql .= "BADGE, ";
				$sql .= "MEALS, ";
				$sql .= "REQUESTS, ";
				$sql .= "DATEADDED"; //Last column does NOT have a comma after it.
				$sql .= ") VALUES (:name, :phone, :email, :role, :badge, :meals, :requests, :dateAdded)";
		
				//PREPARE the SQL statement
				$stmt = $conn->prepare($sql);

				//BIND the values to the input parameters of the prepared statement
				$stmt->bindParam(':name', $customer_name);
				$stmt->bindParam(':phone', $customer_phone);
				$stmt->bindParam(':email', $customer_email);
				$stmt->bindParam(':role', $customer_role);
				$stmt->bindParam(':badge', $customer_badge);
				$stmt->bindParam(':meals', $customer_meals);
				$stmt->bindParam(':requests', $customer_requests);
				$stmt->bindParam(':dateAdded', $todaysDate);
		
				
				//EXECUTE the prepared statement
				$stmt->execute();
				echo "executed";
				$message = "The customer has been registered.";
				include('results.php');
			}
				
			catch(PDOException $e)
			{
				$message = "There has been a problem. The system administrator has been contacted. Please try again later.";
		
				error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
				error_log(var_dump(debug_backtrace()));
					
				//Clean up any variables or connections that have been left hanging by this error.
					
				header('Location: ConferenceForm.php');	//sends control to a User friendly page
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
		?>
		
		
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - Self Posting Form</title>
<style>

#orderArea	{
	width:600px;
	border:thin solid black;
	margin: auto auto;
	padding-left: 20px;
}

#orderArea h3	{
	text-align:center;	
}
.errMsg	{
	color:red;
	font-style:italic;	
}

</style>
</head>

<body>
<h1>WDV341 Intro PHP</h1>
<h2>Unit-5 and Unit-6 Self Posting - Form Validation Assignment


</h2>
<p>&nbsp;</p>


<div id="orderArea">
<form name="form3" method="post" id="customer_registration" action="ConferenceForm.php">
  <h3>Customer Registration Form</h3>

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
        <input type="hidden" name="customer_address" id="textfield">  <?php //HONEYPOT FIELD ?>
        </p>
  
      <p>
        <label for="textfield">Name:</label>
        <input type="text" name="customer_name" id="textfield" value="<?php echo $customer_name;  ?>">
         <span class="errMsg"> <?php echo $customerNameErrMsg; ?></span>
      </p>
      <p>
        <label for="textfield2">Phone Number:</label>
        <input type="text" name="customer_phone" id="textfield2" value="<?php echo $customer_phone;  ?>">
        <span class="errMsg"> <?php echo $customerPhoneErrMsg; ?></span>
      </p>
      <p>
        <label for="textfield3">Email Address: </label>
        <input type="text" name="customer_email" id="textfield3" value="<?php echo $customer_email;  ?>">
        <span class="errMsg"> <?php echo $customerEmailErrMsg; ?></span>
      </p>
      <p>
        <label for="select">Registration: </label>
        <select name="customer_role" id="select">
          <option value="">Choose Type</option>
          <option <?php if (isset($customer_role) && $customer_role=="Attendee") echo "selected";?>>Attendee</option>
          <option <?php if (isset($customer_role) && $customer_role=="Presenter") echo "selected";?>>Presenter</option>
          <option <?php if (isset($customer_role) && $customer_role=="Volunteer") echo "selected";?>>Volunteer</option>
          <option <?php if (isset($customer_role) && $customer_role=="Guest") echo "selected";?>>Guest</option>
        </select>
        <span class="errMsg"> <?php echo $customerRoleErrMsg; ?></span>
      </p>
      <p>Badge Holder:</p>
      <p>
        <input type="radio" name="customer_badge" id="radio" value="Clip"<?php echo ($_POST['customer_badge'] == 'Clip' ? 'checked' : '')?>>
        <label for="radio">Clip</label> <br>
        <input type="radio" name="customer_badge" id="radio2" value="Lanyard"<?php echo ($_POST['customer_badge'] == 'Lanyard' ? 'checked' : '')?>>
        <label for="radio2">Lanyard</label> <br>
        <input type="radio" name="customer_badge" id="radio3" value="Magnet"<?php echo ($_POST['customer_badge'] == 'Magnet' ? 'checked' : '')?>>
        <label for="radio3">Magnet</label>
         <span class="errMsg"> <?php echo $customerBadgeErrMsg; ?></span>
      </p>
      <p>Provided Meals (Select all that apply):</p>
      <p>
        <input type="checkbox" name="customer_meals" id="checkbox" value="Friday Dinner"<?php echo ($_POST['customer_meals'] == 'Friday Dinner' ? 'checked' : '')?>>
        <label for="checkbox">Friday Dinner</label><br>
        <input type="checkbox" name="customer_meals" id="checkbox2" value="Saturday Lunch"<?php echo ($_POST['customer_meals'] == 'Saturday Lunch' ? 'checked' : '')?>>
        <label for="checkbox2">Saturday Lunch</label><br>
        <input type="checkbox" name="customer_meals" id="checkbox3" value="Sunday Award Brunch"<?php echo ($_POST['customer_meals'] == 'Sunday Award Brunch' ? 'checked' : '')?>>
        <label for="checkbox3">Sunday Award Brunch</label>
      </p>
      <p>
        <label for="textarea">Special Requests/Requirements: (Limit 200 characters)<br>
        </label>
        <textarea name="customer_requests" cols="40" rows="5" id="textarea"> <?php echo htmlspecialchars($customer_requests);?></textarea>
          <span class="errMsg"> <?php echo $customerRequestsErrMsg; ?></span>
      </p>
   
  <p>
    <input type="submit" name="submit" id="submit" value="Submit">
    <input type="reset" name="btnReset" id="reset" value="Reset" onClick="clearForm()">
  </p>
</form>
<?php
			}//end else
        ?>    	
        
</div>

</body>
</html>