<?php
session_start();

  $id = $_GET['id'];
  $band_id = $_SESSION['bandId'];
  $user_name = $_SESSION['userName'];
  $user_auth = $_SESSION['userAuth'];
  $user_id = $_SESSION['userId'];
  $venue_id = 1;
  
  
  // do some validation here to ensure id is safe

include 'connectPDOBANDIT.php';
 
  $sql = "SELECT BAND_IMAGE FROM BANDIT_BAND WHERE BAND_ID='$band_id'";
 
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  
  $stmt->fetchAll();
  
  header("Content-type: images/jpeg");
  echo $row['$BAND_IMAGE'];
?>