<?php 
include 'connectPDOBANDIT.php';
session_cache_limiter('none');			//This prevents a Chrome error when using the back button to return to this page.
session_start();

$user_name = "";
$user_auth = "";
$user_id = "";

if (isset($_SESSION['validUser']) && ($_SESSION['validUser'] == "YES") && ($_SESSION['userAuth'] == "ADMIN"))
{



$user_name = $_SESSION['userName'];
$user_auth = $_SESSION['userAuth'];
$user_id  = $_SESSION['userId'];
$current_user = $_SESSION['currentUser'];

echo "user name: " . $user_name;




}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Portal</title>
<link href="style.css" rel="stylesheet" style="text/css"/>
</head>
<body>

<header><?php echo "Welcome " . $user_name; ?></header>
<div class="container">
<h3 id="info">Administrator Options</h3>
<p><a href="viewAllBanditEvents.php" class="link">All Shows</a></p>
<p><a href="viewAllBands.php" class="link">All Bands</a></p>
<p><a href="musicianProfile.php" class="link">Musician Profile Template</a>
<p><a href="BanditLogout.php" class="link">Logout of Admin System</a></p>
</div>

</body>
</html>