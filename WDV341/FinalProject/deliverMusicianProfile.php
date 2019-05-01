<?php
	
	$musicianObj = new stdClass();
	
	$musicianObj->m_firstname = "roger";
	//$productObj->productPrice = "$1.99";
//
	$returnObj = json_encode($musicianObj);	//create the JSON object
//	
	echo $returnObj;							//send results back to calling program
?>