<?php
include 'connectPDOBANDIT.php';
session_start();

  $id = $_GET['id'];
  $band_id = $_SESSION['bandId'];
  $user_name = $_SESSION['userName'];
  $user_auth = $_SESSION['userAuth'];
  $user_id = $_SESSION['userId'];
  $venue_id = 1;
  
  
  // do some validation here to ensure id is safe

include 'connectPDOBANDIT.php';
 
  $sql = "SELECT M_IMAGE FROM BANDIT_MUSICIAN WHERE M_USER_ID='$id'";
 
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  
  
  $row = $stmt->fetchAll();
  
  $m_image = $row['M_IMAGE'];
  $_SESSION['mImage'] = $m_image;
  
  header("Content-type: images/jpeg");
  echo "musician image: " . $m_image;
?>