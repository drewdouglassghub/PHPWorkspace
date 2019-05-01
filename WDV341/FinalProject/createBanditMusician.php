<?php
include('FormValidation.php');
$formValidations = new validations();
include 'connectPDOBANDIT.php';
session_start();
		
	//Setup the variables used by the page
		//field data
		$user_id = "";
		$user_name = "";
		$user_password = "";
		$user_auth = "";
		$m_id = "";
		$m_firstname = "";
		$m_lastname = "";
		$m_instruments = "";
		$m_bandid = "";
		$m_userid = "";
		$m_image = "";
		//error messages
		$message = "";
		
		
		$validForm = false;
				
	if(isset($_POST["submit"]))
	{	
		echo "post";
		$user_name = $_POST['user_name'];
		$user_password = $_POST['user_password'];
		$user_auth = "MUSICIAN";
		$m_firstname = $_POST['m_firstname'];
		$m_lastname = $_POST['m_lastname'];
		$m_instruments = $_POST['m_instruments'];
		

			
		

		
		//VALIDATE FORM DATA  using functions defined above
				//switch for keeping track of any form validation errors
		$validForm = true;
		$formValidations->cannotBeEmpty($user_name);
		$formValidations->cannotBeEmpty($user_password);
		$formValidations->cannotBeEmpty($m_firstname);
		$formValidations->cannotBeEmpty($m_lastname);
		$formValidations->cannotBeEmpty($m_instruments);
		
		
		if($validForm)
		{
			$message = "All good";	
			$_SESSION['userName'] = $user_name;
			$_SESSION['userAuth'] = $user_auth;
			$_SESSION['mFirstName'] = $m_firstname;
			$_SESSION['mLastName'] = $m_lastname ;
			$_SESSION['mInstruments'] = $m_instruments;
			$_SESSION['validUser'] == "YES";
			
			try {
			
				//mysql DATE stores data in a YYYY-MM-DD format
				$todaysDate = date("Y-m-d");		//use today's date as the default input to the date( )
				$validUser = true;
				echo $todaysDate;
				
				//Create the SQL command string
				$sql = "INSERT INTO BANDIT_USER (";
				$sql .= "USER_NAME, ";
				$sql .= "USER_PASSWORD, ";
				$sql .= "USER_AUTH ";
				$sql .= ") VALUES (:userName, :userPassword, :userAuth)";
				
				echo "inserted";
				
				
				
				//PREPARE the SQL statement
				$stmt = $conn->prepare($sql);
				
				echo "prepared";
				
				//BIND the values to the input parameters of the prepared statement
				$stmt->bindParam(':userName', $user_name);
				$stmt->bindParam(':userPassword', $user_password);		
				$stmt->bindParam(':userAuth', $user_auth);
				
				//EXECUTE the prepared statement
				$stmt->execute();	
				
				echo "executed";
				
				
				
				$sql = ("SELECT USER_ID, USER_NAME, USER_AUTH FROM BANDIT_USER WHERE USER_NAME = '$user_name'");
				echo $sql;
				
				echo "selected2";
				$stmts = $conn->prepare($sql);
				
				echo "prepared2";
				$stmts->bindParam(':userName', $user_name);
				echo "bound2";
				$stmts->execute();
				echo "executed";
				
				while ($row = $stmts->fetch(PDO::FETCH_ASSOC)){
								
					$user_id = $row['USER_ID'];
					$_SESSION['userId'] = $user_id;
					$m_userid = $user_id;
					$user_name= $row['USER_NAME'];
					$user_auth = $row['USER_AUTH'];
				}
				 echo "userid: " . $user_id;
				 echo "user_name: " . $user_name;
				
				$sql = "INSERT INTO BANDIT_MUSICIAN (";
				$sql .= "M_FIRSTNAME, ";
				$sql .= "M_LASTNAME, ";				
				$sql .= "M_INSTRUMENTS, ";
				$sql .= "M_USER_ID ";	//Last column does NOT have a comma after it.
				$sql .= ") VALUES (:mFirstName, :mLastName, :mInstruments, :mUserId)";
				echo "inserted 3";
				$stmtm = $conn->prepare($sql);
				echo "prepared 3";
				$stmtm->bindParam(':mFirstName', $m_firstname);
				$stmtm->bindParam(':mLastName', $m_lastname);
				$stmtm->bindParam(':mInstruments', $m_instruments);
				$stmtm->bindParam(':mUserId', $m_userid);
				echo "bound 3";
				$stmtm->execute();
				echo "executed 3";
				
				$m_id  = $row['M_ID'];
				$sql = ("SELECT M_ID FROM BANDIT_MUSICIAN WHERE M_USER_ID = :userId");
				$stmt = $conn->prepare($sql);
				
				$stmt->bindParam(':userId', $user_id);
				$stmt->execute();
				
				echo "executed4";
				while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
					$m_id = $row['M_ID'];
				}
			
				
				$_SESSION['validUser'] = true;
				$message = "The user " . $user_name . "  has been registered as a musician on BandIt.";
				
				
			}
			
			catch(PDOException $e)
			{
				$message = "There has been a problem. The system administrator has been contacted. Please try again later.";
	
				/*error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
				error_log(var_dump(debug_backtrace()));*/
			
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
	<title>BandIt User Creation</title>
	<link href="style.css" rel="stylesheet" style="text/css"/>
</head>

<body>

<div id="container">

	<header>
    	User Creation
    </header>
    
    <main>
    
        <h1>Create a New User</h1>
		<?php
            //If the form was submitted and valid and properly put into database display the INSERT result message
			if($validForm)
			{
        ?>
            <h1><?php echo $message ?></h1>
        
        <?php
        
       	 echo "<a href='musicianProfile.php?mId=$m_id'>Login</a>";
			}
			else	//display form
			{
        ?>
        
        <form id=userForm" name="userForm" method="post" action="createBanditMusician.php">

        	<fieldset>
              <legend>Add a User</legend>         
              <p>
                <label for="user_name">User Name: </label>
                <input type="text" name="user_name" id="user_name" value="<?php echo $user_name;  ?>" /> 
                <span class="errMsg"> <?php echo $emptyErrMsg; ?></span>                 
              </p>
              
               <p>
                <label for="user_password">Password: </label>
                <input type="text" name="user_password" id="user_password" value="<?php echo $user_password;  ?>" /> 
                <span class="errMsg"> <?php echo $emptyErrMsg; ?></span>           
              </p>
              
              <p>
               
                <input type="hidden" name="user_auth" id="user_auth" value="MUSICIAN" /> 
                          
              </p>
              
               <p>
                <label for="m_firstname">First Name: </label>
                <input type="text" name="m_firstname" id="m_firstname" value="<?php echo $m_firstname;  ?>" /> 
                <span class="errMsg"> <?php echo $emptyErrMsg; ?></span>            
              </p>
              
               <p>
                <label for="m_lastname">Last Name: </label>
                <input type="text" name="m_lastname" id="m_lastname" value="<?php echo $m_lastname;  ?>" /> 
                <span class="errMsg"> <?php echo $emptyErrMsg; ?></span>      
              </p>
              
              <p>
                <label for="m_lastname">Instruments played: </label>
                <input type="textarea" name="m_instruments" id="m_instruments" value="<?php echo $m_instruments;  ?>" /> 
                <span class="errMsg"> <?php echo $emptyErrMsg; ?></span>          
              </p>
              
              <p><a href="profilePictureUpload.php" >Picture Upload</a></p>
              
            </fieldset>
            
      
         	<p>
            	<input type="submit" name="submit" id="submit" value="Add Musician" />
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