<?php

	class validations {
		
	public function __construct() {
		//empty constructor with no functionality
	}		


		public function cannotBeEmpty($inField){	
			global $validForm, $customerNameErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
			$customerNameErrMsg = "";
			
			if($inField == "")
			{
				$validForm = false;
				$customerNameErrMsg = "Name cannot be empty";
			}

		}
		
		
		public function validateEmail($inEmail){
			global $validForm, $customerEmailErrMsg;			//Use the GLOBAL Version of these variables instead of making them local
			$customerEmailErrMsg = "";
			$inEmail = filter_var($inEmail, FILTER_SANITIZE_EMAIL);	//clean it
			
			$inEmail =  filter_var($inEmail,FILTER_VALIDATE_EMAIL);	//validate format
			if($inEmail === false)
			{
				$validForm = false;
				$customerEmailErrMsg = "Invalid email";
			}
			
		}
		
		
		// Does string contain special characters?
		
		public function validatePhone($inPhone)
		{
			global $validForm, $customerPhoneErrMsg;
			if(preg_match("/^[0-9]{10}$/", $inPhone) == FALSE || $inPhone == "") {
				$customerPhoneErrMsg = "Incorrect Phone format";
				$validForm = false;
			}
		}
		
		public function validateDate($inmonth, $inday, $inyear)
		{
			global $validForm, $customerPhoneErrMsg;
			if(checkdate($inmonth, $inday, $inyear) === false){
		
				$validForm = false;
				return false;
			}
		}
		
		
		public function checkRequestLength($inField){
			global $validForm, $customerRequestErrMsg;
			$customerRequestErrMsg = "";
			
			if(strlen($inField > 200))
			{
				echo strlen($inField);
				echo "exceeds max";
				$validForm = false;
				$customerRequestErrMsg = "Request exceeds max length";
			}
		}

		function validateNameStringChars($inField) {
			global $validForm, $customerNameErrMsg;
			$customerNameErrMsg = "";
			//var_dump(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
			if(preg_match('/[^a-zA-Z0-9_ -]/s', $inField) == FALSE){
				$validForm = false;
				$customerNameErrMsg = "No special chars allowed";
			}
		}
		
		function validateRequestStringChars( $inField ) {
			global $validForm, $customerRequestErrMsg;
			$customerRequestErrMsg = "";
			//var_dump(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
			if(preg_match('/[^a-zA-Z0-9_-]/', $inField) == FALSE){			
				$validForm = false;		
				$customerRequestErrMsg = "No special chars allowed";
			}
		}
		
		public function mustBeCheckedBadge($inField){
			global $validForm, $customerBadgeErrMsg;
			$customerBadgeErrMsg = "";
			if ($inField == "") {
				$validForm = false;
				$customerBadgeErrMsg = "Must be checked";
			
			}
		}
		
		public function mustBeCheckedRole($inField){
			
			global $validForm, $customerRoleErrMsg;
			$customerRoleErrMsg = "";
			if ($inField == "") {
			$validForm = false;
			$customerRoleErrMsg = "Must be checked";
		} 
		}
		
		public function validateAddress($inAddress)
		{
		global $validForm, $addressErrMsg;
				$addressErrMsg = "";
			
				if($inAddress !== "")
				{
					echo "Error.  Please resubmit the form.";
					$validForm = false;
					header('Location:ConferenceForm.php');
				}
		}
	}

?>
