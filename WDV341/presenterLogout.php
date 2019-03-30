<?php
session_start();

$currentUser = ($_SESSION['currentUser']);
$logOutMessage = "";

if(($_SESSION['validUser']) == "no")
{

	header("Location:presenterLogin.php");
}

if(isset($_GET['submit']))
{
	$logOutMessage =  "Bye now";
	$_SESSION = array();
	session_destroy();
	header("Location:presenterLogin.php");
	exit;
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Presenter Logout</title>
<link href="style.css" rel="stylesheet" style="text/css"/>
</head>
<body>

	<div class="container">
	<h2>
		<?php echo $currentUser ?>
		are you sure you would like to log out?
	</h2>
	<p>
		<?php echo $logOutMessage ?>
	</p>
	<form action="presenterLogout.php" method="get">
		<input type="submit" name="submit" id="submit" value="Logout" onclick="logout()" class="button"/> 
		<input type="button" name="cancel" id="cancel" value="Cancel" class="button"/>
	</form>
	</div>
	
</body>
</html>
