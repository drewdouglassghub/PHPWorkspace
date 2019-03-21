<?php
include("FormValidation.php");
$formValidations = new validations();

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form Validation Example</title>
</head>

<body>
	
	<h2>Cannot Be Empty</h2>
	<p>0 <?php  if( $formValidations->cannotBeEmpty(0) ){
					echo "True";
	}
	else {
		echo "False";
	}
	 ?></p>
		
	<p>"" <?php if ( $formValidations->cannotBeEmpty("") ){
				echo "True";
	}
	else{
		echo "False";
	}
	?>
	</p>
	<p>0.0 <?php if ($formValidations->cannotBeEmpty(0.0)){
						echo "True";
	}
	else{
		echo "False";
	} ?>
	</p>		
	<p>"    " <?php if ($formValidations->cannotBeEmpty("     ")){
					echo "True";
	}
	else{
				echo "False";
	} ?>
	</p>
	<p>"j" <?php if ($formValidations->cannotBeEmpty("j")) {
					echo "True";
	}else
	{
		echo "False";
	}					
	?></p>
		
	<p>"dmacc" <?php if( $formValidations->cannotBeEmpty('dmacc') ){
			echo "True";
		} 
		else {
			echo "False";
		}
		?></p>	
	
	<p>0: <?php if( $formValidations->cannotBeEmpty(0) ){
			echo "True";
		} 
		else {
			echo "False";
		}	
		?></p>	

	<p>null: <?php if( $formValidations->cannotBeEmpty(null) ){
			echo "True";
		} 
		else {
			echo "False";
		}	
		?></p>
	<p>undefined:<?php if( $formValidations->cannotBeEmpty(undefined) ){
			echo "True";
		} 
		else {
			echo "False";
		}	
		?></p>
	
	<h2>Email Validation</h2>
	
	<p>drew.douglass@hotmail.com 
		<?php 
			if($formValidations->validateEmail("drew.douglass@hotmail.com")){
				echo "Valid";
			}else{
				echo "Invalid";
			}
		
		?>
	</p>
	
	<p>drew.douglass@hotmail 
		<?php
			if($formValidations->validateEmail("drew.douglass@hotmail")){
				echo "Valid";
			}else{
				echo "Invalid";
			}
		?>
	</p>	
	
	<h2>Integer Validation</h2>
	
	<p>55
		<?php 
			if($formValidations->validateInteger(55)){
				echo "Valid";
			}else
			{
				echo "Invalid";
			}
		?>
	</p>
	
	<p>6.7
		<?php 
			if($formValidations->validateInteger(6.7)){
				echo "Valid";
			}else
			{
				echo "Invalid";
			}
		?>
	</p>
	
	<h2>Phone Validation</h2>
	
	<p>515-222-4555
		<?php 
			if($formValidations->validatePhone("515-222-4555")){
				echo "Valid";
			}else
			{
				echo "Invalid";
			}
		?>
	</p>

	<p>(515)-242-610
		<?php 
			if($formValidations->validatePhone("(515)-242-610")){
				echo "Valid";
			}else
			{
				echo "Invalid";
			}
		?>
	</p>
	
	<h2>Date Validation</h2>
	
	<p>month = 06, day = 27, year = 1973
		<?php 
			$month = 06;
			$day = 27;
			$year = 1973;
			if($formValidations->validateDate($month, $day, $year)){
				echo "Valid";
			}else
			{
				echo "Invalid";
			}
		?>
	</p>
	
	<p>month = 25, day = 06, year = 2019
		<?php 
			$month = 25;
			$day = 06;
			$year = 2019;
			if($formValidations->validateDate($month, $day, $year)){
				echo "Valid";
			}else
			{
				echo "Invalid";
			}
		?>
	</p>
</body>
</html>