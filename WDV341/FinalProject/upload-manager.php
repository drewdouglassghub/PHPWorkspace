<?php
session_start();
include 'connectPDOBANDIT.php';

$band_image = "/images.KCCLogo.jpg";

$sql = ("UPDATE BANDIT_BAND SET BAND_IMAGE = :image WHERE BAND_ID = '$band_id'");
$stmt = $conn->prepare($sql);
	
	
$stmt->bindParam(':image', $band_image);
	
	
$stmt->execute();
$band_image = "";

// Check if the form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	// Check if file was uploaded without errors
	if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
		$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
		$filename = $_FILES["photo"]["name"];
		$filetype = $_FILES["photo"]["type"];
		$filesize = $_FILES["photo"]["size"];
		
		$band_image = "images/" . $fileName;
		echo $band_image;
		// Verify fileextension
		
		
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

		// Verify file size - 5MB maximum
		$maxsize = 5 * 1024 * 1024;
		if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

		// Verify MYME type of the file
		if(in_array($filetype, $allowed)){
			// Check whether file exists before uploading it
			if(file_exists("images/" . $filename)){
				echo $filename . " is already exists.";
			} else{
				move_uploaded_file($_FILES["photo"]["tmp_name"], "images/" . $filename);
				echo "Your file was uploaded successfully.";
			
			header("Location:bandProfile.php");
			}
		} else{
			echo "Error: There was a problem uploading your file. Please try again.";
		}
	} else{
		echo "Error: " . $_FILES["photo"]["error"];
	}
}



?>