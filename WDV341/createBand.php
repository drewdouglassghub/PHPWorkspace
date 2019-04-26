<?php
include 'connectPDOBANDIT.php';
session_start();

if(isset($_SESSION['validUser']) && ($_SESSION['validUser'] == "YES"))
{
	$user_name = $_SESSION['userName'];
	$user_auth = $_SESSION['userAuth'];
	$user_id = $_SESSION['userId'];
}
else {
	header("Location:banditIndex.php");
}
		
	//Setup the variables used by the page
		//field data
		$band_id = "";
		$band_name = "";
		$band_image = "";
		$band_description = "";
		$band_style = "";
		$band_events = "";
		$band_userid = "";
		$band_email = "";
		//error messages
		$bandNameErrMsg = "";
		$emailErrMsg = "";
		
		$validForm = false;
				
	if(isset($_POST["createBand"]))
	{	
		
		
		$band_name = $_POST['band_name'];
		$band_description = $_POST['band_description'];
		$band_style = $_POST['band_style'];
		$band_email = $_POST['band_email'];
		$band_userid = $_POST['band_userid'];
			
		
		
		function cannotBeEmpty($inFieldValue){
		
			return empty($inFieldValue);
		
		}
		
		
		function validateEmail($inEmail){
				
			$inEmail = filter_var($inEmail, FILTER_SANITIZE_EMAIL);	//clean it
				
			return filter_var($inEmail,FILTER_VALIDATE_EMAIL);	//validate format
				
		}
		
		//VALIDATE FORM DATA  using functions defined above
		$validForm = true;		//switch for keeping track of any form validation errors
		
		cannotBeEmpty($band_name);
		
		validateEmail($band_email);
		
		
		if($validForm)
		{
			$message = "All good";	
			
			try {
			
				//mysql DATE stores data in a YYYY-MM-DD format
				$todaysDate = date("Y-m-d");		//use today's date as the default input to the date( )
				
				echo $todaysDate;
				
				//Create the SQL command string
				$sql = "INSERT INTO BANDIT_BAND (";
				$sql .= "band_name, ";
				$sql .= "band_description, ";
				$sql .= "band_style, ";
				$sql .= "band_email, "; 
				$sql .= "band_userid ";//Last column does NOT have a comma after it.
				$sql .= ") VALUES (:bandName, :bandDescription, :bandStyle, :bandEmail, :bandUserId)";
				
				//PREPARE the SQL statement
				$stmt = $conn->prepare($sql);
				
				//BIND the values to the input parameters of the prepared statement
				$stmt->bindParam(':bandName', $band_name);
				$stmt->bindParam(':bandDescription', $band_description);		
				$stmt->bindParam(':bandStyle', $band_style);		
				$stmt->bindParam(':bandEmail', $band_email);
				$stmt->bindParam(':bandUserId', $band_userid);			
				
				//EXECUTE the prepared statement
				$stmt->execute();	
				
				$message = "The band " . $band_name . "  has been registered.";
				
				
				
			}
			
			catch(PDOException $e)
			{
				$message = "There has been a problem. The system administrator has been contacted. Please try again later.";
	
				error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
				error_log(var_dump(debug_backtrace()));
			
				//Clean up any variables or connections that have been left hanging by this error.		
			
					//sends control to a User friendly page					
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
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>BandIt Band Creation</title>
	<link href="style.css" rel="stylesheet" style="text/css"/>
</head>

<body>

<div id="container">

	<header>
    	<h1>Band Creation</h1>
    </header>
    
    <main>
    
        <h1>Create a New Band</h1>
		<?php
            //If the form was submitted and valid and properly put into database display the INSERT result message
			if($validForm)
			{
        ?>
            <h1><?php echo $message ?></h1>
        
        <?php
        
        echo "<a href='bandProfile.php?bandId' >Band Profile</a>";
			}
			else	//display form
			{
        ?>
        
        <form id="bandForm" name="bandForm" method="post" action="createBand.php">

        	<fieldset>
              <legend>Add a Band</legend>         
              <p>
                <label for="band_name">Band Name: </label>
                <input type="text" name="band_name" id="band_name" value="<?php echo $band_name;  ?>" /> 
                <span class="errMsg"> <?php echo $bandNameErrMsg; ?></span>
                
                
               
                
                
              </p>
              
              
              <p><a href="profilePictureUpload.php" >Picture Upload</a></p>
              
              <p>
                <label for="band_description">Band Description: </label>  
                <input type="textarea" name="band_description" id="band_description" value="<?php echo $band_description;  ?>" />            
              </p>
                <p>
			        <label for="select">Style: </label>
			        <select name="band_style" id="select">
			          <option value="">Choose Type</option>
			          <option <?php if (isset($band_style) && $band_style=="Rock") echo "selected";?>>Rock</option>
			          <option <?php if (isset($band_style) && $band_style=="Punk") echo "selected";?>>Punk</option>
			          <option <?php if (isset($band_style) && $band_style=="Country") echo "selected";?>>Country</option>
			          <option <?php if (isset($band_style) && $band_style=="Jazz") echo "selected";?>>Jazz</option>
			          <option <?php if (isset($band_style) && $band_style=="Rap") echo "selected";?>>Rap</option>
			        </select>
		      	</p>
		      	<p>
		      	<input type="hidden" name="band_userid" id="band_userid" value="<?php echo $user_id ?>"/> 
		      	</p>
              <p>
                <label for="band_email">Band Email: </label> 
                <input type="text" name="band_email" id="band_email" value="<?php echo $band_email;  ?>"/>
                <span class="errMsg"><?php echo $emailErrMsg; ?></span>                
              </p>            
              
            </fieldset>
            
      
         	<p>
            	<input type="submit" name="createBand" id="createBand" value="Add Band" />
            	<input type="reset" name="button2" id="button2" value="Clear Form" onClick="clearForm()" />
        	</p>  
        </form>
	
        <?php
        
        
        
			}//end else
        ?>    	
     
        
        	
	</main>
    
	<footer>
    	<p>Copyright &copy; <script> var d = new Date(); document.write (d.getFullYear());</script> All Rights Reserved</p>
    
    </footer>

</div>
</body>
</html>