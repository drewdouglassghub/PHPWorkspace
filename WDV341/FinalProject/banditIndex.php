<?php 
include('FormValidation.php');																																																					
include 'connectPDOBANDIT.php';
$formValidations = new validations();
session_cache_limiter('none');			//This prevents a Chrome error when using the back button to return to this page.
session_start();

	$loginErrMessage = "Invalid user name or password";
	$clearMsg = "";
	$loginID = "wdv341";
	$PassWord = "wdv341";

	if (isset($_SESSION['validUser']) && ($_SESSION['validUser'] == "YES"))
		{ 
		
			$message = "Login successful";
		}
		
		if (isset($_POST['reset']))
		{
			$loginErrMessage = " ";
		}
		
		
		if($validForm)
		
		
		
		
		
		if (isset($_POST['submitLogin']) && ($validForm))
		{
				$inUsername = $_POST['loginUsername'];
				$inPassword = $_POST['loginPassword'];
				$inUserAuth = "";
		
		
		$sql = "SELECT USER_ID, USER_NAME, USER_PASSWORD, USER_AUTH FROM BANDIT_USER WHERE USER_NAME = :userName AND USER_PASSWORD = :passWord";
		$stmt = $conn->prepare($sql);//prepare the query
		
		echo "SQL: " . $sql;
		
		$stmt->bindParam(":userName", $inUsername);		
		$stmt->bindParam(":passWord", $inPassword);

		$stmt->execute();
		
		$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
	
			if ($userRow != "")
			{
				
				$_SESSION['userName'] = $inUsername;
				$_SESSION['validUser'] = "YES";			
				$_SESSION['currentUser'] = $inUsername;
				$_SESSION['userAuth'] = $userRow['USER_AUTH'];					
				$_SESSION['userId'] = $userRow['USER_ID'];
				echo $_SESSION['userAuth'];
			}
			else
			{
				//error in processing login.  Logon Not Found...
				$_SESSION['validUser'] = "NO";
				$message = "Sorry, there was a problem with your username or password. Please try again.";
			}
		
		
			
		}
		//end if submitted
		else
		{
			
		
		}//end else submitted
		
		
		
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BandIt Login</title>

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

<header>BandIt Login</header>

<div class="info">
<h3><?php echo $message?></h3>

</div>

<?php

if ($_SESSION['validUser'] == "YES" && $_SESSION['userAuth'] == "BAND")	//This is a valid user.  Show them the Administrator Page
{
	header("Location:bandProfile.php");
}
	else if ($_SESSION['validUser'] == "YES" && $_SESSION['userAuth'] == "MUSICIAN")								//The user needs to log in.  Display the Login Form
	{
		header("Location:musicianProfile.php");
	}
	else if ($_SESSION['validUser'] == "YES" && $_SESSION['userAuth'] == "ADMIN"){
		header("Location:banditAdminPortal.php");
	}
	else {
		
	
?>
			<div class="container">
			<h2>BandIt Login</h2>
			<h3>You may access the administrator functions of this site with the following credentials: </h3>
				<h3>User name: <?php echo $loginID; ?></h3>
				<h3>Password: <?php echo $PassWord; ?></h3>
                <form method="post" name="loginForm" action="banditIndex.php" >
               <p>Username: <input name="loginUsername" type="text" />
               <span class="errMsg" > <?php if(isset($_POST['loginUsername'])) {echo $loginErrMessage;} ?></span>
               </p>
                  <p>Password: <input name="loginPassword" type="password" />
                    <span class="errMsg" > <?php if(isset($_POST['loginPassword'])) {echo $loginErrMessage;} ?></span></p>
                  <p><input name="submitLogin" id="submitLogin" value="Login" type="submit" class="button"/> <input type="reset" name="reset" id="reset" value="Reset" class="button">&nbsp;</p>
                </form>
                
                <span><a href="createBanditMusician.php">Create Musician</a></span>
              </div>  
<?php //turn off HTML and turn on PHP
	}//end of checking for a valid user
	
	$conn = null;
	$stmt = null;
//turn off PHP and begin HTML			
?>
<p>Return to <a href="http://www.drewdouglass.net">www.drewdouglass.net</a></p>

</body>
</html>