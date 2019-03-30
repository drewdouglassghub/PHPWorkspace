<?php
include 'connectPDO2.php';
$stmt = $conn->prepare("SELECT EVENT_ID, EVENT_NAME, EVENT_DESCRIPTION, EVENT_PRESENTER, DATE_FORMAT(EVENT_DATE, '%c/%d/%Y') EVENT_DATE, EVENT_TIME FROM WDV_EVENT ORDER BY EVENT_ID DESC");
$stmt->execute();
$rowCount = $stmt->rowCount();
echo "executed";
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>WDV341 Intro PHP  - Display Events Example</title>
    <style>
		.eventBlock{
			width:500px;
			margin-left:auto;
			margin-right:auto;
			background-color:#CCC;	
		}
		
		.displayPresenter{
		padding-left:10px;
		text-align:left;
		font-size:18px;
		}
		
		.displayEvent{
			padding-left:10px;
			text_align:left;
			font-size:18px;	
		}
		
		.displayDescription {
		
			margin-left:50px;
		}
		
		.displayDate{
			padding-left:10px;
			font-size:18px;
		}
		
		.displayTime{
		padding-left:10px;
			font-size:18px;
		}
	</style>
</head>

<body>
    <h1>Event Format Example</h1>
    <h2>Future events are in <em>italics</em>.  <span style="font-style:italic; font-weight:bold; color: red">Bold, red, italics </span>indicate an event this month.</h2>
    <h3><?php echo $rowCount ?>  Events are available.</h3>

<?php
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
	echo "<p>
        <div class='eventBlock'>	
            <div>";
			$date = explode('/', $row['EVENT_DATE']);
			$year = $date[2];
			$month = $date[0];

			
           if ($month == date("m")){
           	
           	echo "<span class='displayEvent'style='font-style:italic; font-weight:bold; color: red'>Event: "  . $row['EVENT_NAME'] . "</span></br>
           	</div>
           		<div>
           			<span class='displayPresenter'>Presenter: "  . $row['EVENT_PRESENTER'] . "</span>
           		</div>
           		<div>
           			<span class='displayDescription'>Description: " . $row['EVENT_DESCRIPTION'] . "</span>
           		</div>
           	<div>
           	<span class='displayDate'>Date: " . $row['EVENT_DATE'] . "</span>
           	</div>
           	<div>
           	<span class='displayTime'>Time: " . $row['EVENT_TIME'] . "</span>
           	</div>
           	</div>
           	</p>";
           }
           	else if ($month > date("m") && ($year >= date("Y"))){
           	echo "<span class='displayEvent' style='font-style:italic'>Event: "  . $row['EVENT_NAME'] . "</span></br>
           		
            </div>
            <div>
                <span class='displayPresenter'>Presenter: "  . $row['EVENT_PRESENTER'] . "</span>
            </div>
            <div>
            	<span class='displayDescription'>Description: " . $row['EVENT_DESCRIPTION'] . "</span>
            </div>
            <div>
            	<span class='displayDate'>Date: " . $row['EVENT_DATE'] . "</span>
            </div>
            <div>
            	<span class='displayTime'>Time: " . $row['EVENT_TIME'] . "</span>
            </div>
        	</div>
    		</p>";
  			}
  			else{
  				echo "<span class='displayEvent'>Event: "  . $row['EVENT_NAME'] . "</span></br>
  				 
  				</div>
  				<div>
  				<span class='displayPresenter'>Presenter: "  . $row['EVENT_PRESENTER'] . "</span>
  				</div>
  				<div>
  				<span class='displayDescription'>Description: " . $row['EVENT_DESCRIPTION'] . "</span>
  				</div>
  				<div>
  				<span class='displayDate'>Date: " . $row['EVENT_DATE'] . "</span>
  				</div>
  				<div>
  				<span class='displayTime'>Time: " . $row['EVENT_TIME'] . "</span>
  				</div>
  				</div>
  				</p>";
  			}
	}
    ?>
<?php
		$stmt->close();
	$conn->close();
?>
</div>	
</body>
</html>