<?php 
include('FormValidation.php');
include 'connectPDO2.php';
$formValidations = new validations();
session_cache_limiter('none');			//This prevents a Chrome error when using the back button to return to this page.
session_start();

	$loginErrMessage = "Invalid user name or password";
	$clearMsg = "";
	$loginID = "wdv341";
	$PassWord = "wdv341";

	if (isset($_SESSION['validUser']) && ($_SESSION['validUser'] == "yes"))
		{
		
			$message = "Login successful";
		}
		
		if (isset($_POST['reset']))
		{
			$loginErrMessage = " ";
		}
		
		
		if (isset($_POST['submitLogin']) )
		{
				$inUsername = $_POST['loginUsername'];
				$inPassword = $_POST['loginPassword'];
		
		
		
		$sql = "SELECT username, password FROM event_user WHERE username = :userName AND password = :passWord";
		$stmt = $conn->prepare($sql);//prepare the query
		
		
		$stmt->bindParam(":userName", $inUsername);
		$stmt->bindParam(":passWord", $inPassword);
		
		
		$stmt->execute();
		$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
		
		
			if ($userRow != "")
			{
				$_SESSION['loginUserName'] = $inUsername;
				$_SESSION['validUser'] = "yes";
				$message = "Login successful.  Welcome back " . $inUsername;
				$_SESSION['currentUser'] = $inUsername;
	
			}
			else
			{
				//error in processing login.  Logon Not Found...
				$_SESSION['validUser'] = "no";
				$message = "Sorry, there was a problem with your username or password. Please try again.";
			}

		}//end if submitted
		else
		{
				
		
		}//end else submitted

		
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Event Admin Login</title>

<!--  User Login Page
            
if user is valid (Session variable - already logged on)
	display admin options
else
    if form has been submitted
        Get input from $_POST
        Create SELECT QUERY
        Run SELECT to determine if they are valid username/password
        if user if valid
            set Session variable to true
            display admin options
        else
            display error message
            display login form
    else
    display login form
         
-->
<link href="style.css" rel="stylesheet" style="text/css"/>
</head>

<body >

<header>Events Admin System Example</header>

<div class="info">
<h3><?php echo $message?></h3>

</div>

<?php

	if ($_SESSION['validUser'] == "yes")	//This is a valid user.  Show them the Administrator Page
	{
		
//turn off PHP and turn on HTML
?>
	<div class="container">
		<h3 id="info">Events Administrator Options</h3>
        <p><a href="insertEvent.php" class="link">Input New Event</a></p>
        <p><a href="presentersSelectView.php" class="link">List of Events</a></p>
        <p><a href="presenterLogout.php" class="link">Logout of Events Admin System</a></p>	
      </div>  					
<?php
	}
	else									//The user needs to log in.  Display the Login Form
	{
?>
			<div class="container">
			<h2>Please login to the Administrator System</h2>
			<h3>You may access the administrator functions of this site with the following credentials: </h3>
				<h3>User name: <?php echo $loginID; ?></h3>
				<h3>Password: <?php echo $PassWord; ?></h3>
                <form method="post" name="loginForm" action="presenterLogin.php" >
               <p>Username: <input name="loginUsername" type="text" />
               <span class="errMsg" > <?php if(isset($_POST['loginUsername'])) {echo $loginErrMessage;} ?></span>
               </p>
                  <p>Password: <input name="loginPassword" type="password" />
                    <span class="errMsg" > <?php if(isset($_POST['loginPassword'])) {echo $loginErrMessage;} ?></span></p>
                  <p><input name="submitLogin" id="submitLogin" value="Login" type="submit" class="button"/> <input type="reset" name="reset" id="reset" value="Reset" class="button">&nbsp;</p>
                </form>
              </div>  
<?php //turn off HTML and turn on PHP
	}//end of checking for a valid user
	
	$conn = null;
	$stmt = null;
//turn off PHP and begin HTML			
?>

<p>Return to <a href='#'>www.presentationstogo.com</a></p>

</body>
</html>