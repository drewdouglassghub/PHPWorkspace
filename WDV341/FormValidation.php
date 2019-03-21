<?php

	class validations {
		
	public function __construct() {
		//empty constructor with no functionality
	}		

		
		public function cannotBeEmpty($inFieldValue){	

			return empty($inFieldValue);

		}
		
		
		public function validateEmail($inEmail){
			
			$inEmail = filter_var($inEmail, FILTER_SANITIZE_EMAIL);	//clean it
			
			return filter_var($inEmail,FILTER_VALIDATE_EMAIL);	//validate format
			
		}
		
		public function validateInteger($inNumber)
		{										
		
			if (is_int($inNumber))		
			{
				$validForm = true;
				return true;
			}
			else
			{		
				$validForm = false;
				return false;
			}
		}
		
		public function validatePhone($inPhone)
		{
			if(preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $inPhone)) {
 					$validForm = true;
 					return  true;
			}else {
				$validForm = false;
				return false;
			}
		}
		
		public function validateDate($inmonth, $inday, $inyear)
		{
			if(checkdate($inmonth, $inday, $inyear)){
				$validForm = true;
				return true;
			}
			else{
				$validForm = false;
				return false;
			}
		}
		
		
		
		
	}

?>
