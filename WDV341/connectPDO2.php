<?php 

$servername = "localhost";
			$username = "walrusdodges_341";
			$password = "Dougl@ss73";
			$dbname = "walrusdodges_341";
			
				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					// set the PDO error mode to exception
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					echo "Connected successfully";
				}
				catch(PDOException $e)
				{
					echo "Connection failed: " . $e->getMessage();
				}

?>
