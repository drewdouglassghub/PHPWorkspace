
<?php 
	 
	class Emailer {
		
		private $senderAddress;
		private $sendToAddress;
		private $subjectLine;
		private $messageBody;
		
		public function __construct(){
			//empty constructor
			
		}
		
		public function setSenderAddress($senderAddress){
			$this->senderAddress = $senderAddress;
		}
		
		public function setSendToAddress($sendToAddress){
			$this->sendToAddress = $sendToAddress;
		}
		
		public function setSubjectLine($subjectLine){
			$this->subjectLine = $subjectLine;
		}
		
		public function setMessageBody($message){
			$this->messageBody = $message;
		}
		
		public function getSenderAddress(){
			return $this->senderAddress;
		}
		
		public function getSendToAddress(){
			return $this->sendToAddress;
		}
		
		public function getSubjectLine(){
			return $this->subjectLine;			
		}
		
		public function getMessageBody(){
		return $this->messageBody;
	}
	

	public function sendNewMessage(){				//sends new message using mail() function
		
		$to = $this->getSendToAddress();
		$subject = $this->getSubjectLine();
		$message = $this->getMessageBody();
		
		$headers = "From: " . $this->getSenderAddress() . "\r\n";
		
		if (mail($to, $subject, $message, $headers)) 	//puts pieces together and sends the email to your hosting account's smtp (email) server
		{
			echo("<p>Message Submitted.  Expect a response within 24 hours</p>");
			return mail($to, $subject, $message, $headers);
		}
		else
		{
			echo("<p>Message failed.  Please try again.</p>");
		}
		
	}
}
	?>


<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>