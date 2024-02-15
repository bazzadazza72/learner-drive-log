<!--
DOOR LEVER INVENTORY ASSIGNMENT - updateProduct.php
Developed by Bailey Camp on 15/3/2023
This file shows a form where the user can update the product cost by using its ID
-->

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Acme Hardware - Add Product</title>
        <link rel="stylesheet" type="text/css" href="../includes/css/style.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google+Sans">
        <script src="../includes/js/main.js"></script>
    </head>
    <body>
        <?php
            ini_set('display_errors', 0);
            error_reporting(-1); 
            $idErr = "";
            $priceErr = "";
            $journeyID = "";
            $newPrice = "";
            $invalidData = false;

            if ($_SERVER["REQUEST_METHOD"] == "POST") { 
                $journeyID = checkInput($_POST["journeyID"]);

                $journeyDate = checkInput($_POST["journeyDate"]);
                $startTime = checkInput($_POST["startTime"]);
                $endTime = checkInput($_POST["endTime"]);
				$journeyLength = checkInput($_POST["journeyLength"]);
                $departureLocation = checkInput($_POST["departureLocation"]);
				$destinationLocation = checkInput($_POST["destinationLocation"]);
				$roadConditions = checkInput($_POST["roadConds"]);
                $weatherConditions = checkInput($_POST["weatherConds"]);
				$trafficConditions = checkInput($_POST["trafficConds"]);

				if(isset($_POST["reset"])) {
					header("Refresh: 0");
					exit();
				}

				if ($journeyDate == ""){
					$journeyErr = "Journey date must not be blank.";
					$invalidData = true;
				} else {
					$journeyErr = "";
				}

				if ($startTime == ""){
					$startErr = "Start time must not be blank.";
					$invalidData = true;
				} else {
					$startErr = "";
				}

				if ($endTime == ""){
					$endErr = "End time must not be blank.";
					$invalidData = true;
				} else {
					$endErr = "";
				}

				if ($departureLocation == ""){
					$departureErr = "Departure must not be blank.";
					$invalidData = true; 
				} else {
					$departureErr = "";
				}

                if ($destinationLocation == ""){
					$destinationErr = "Destination must not be blank.";
					$invalidData = true;
				} else {
					$destinationErr = "";
				}

				if ($roadConditions == ""){
					$roadErr = "At least one road type must be selected.";
					$invalidData = true;
				} else {
					$roadErr = "";
				}

				if ($weatherConditions == ""){
					$weatherErr = "You didn't select the weather conditions.";
					$invalidData = true;
				} else {
					$weatherErr = "";
				}

				if ($trafficConditions == ""){
					$trafficErr = "You didn't select the traffic conditions.";
					$invalidData = true;
				} else {
					$trafficErr = "";
				}
            }

            function checkInput($inputData) {
                $inputData = trim($inputData);
                $inputData = stripslashes($inputData);
                $inputData = htmlspecialchars($inputData);
                return $inputData;
            }
        ?>
        <h1 class="acmeTitle">Acme Hardware</h1>
        <a href="./">My Journeys</a> | <a href="./addjourney.php">Add Journey</a> | <a href="./updateJourney.php">Update Journey</a>
        <h2><i>Update Journey</i></h2>
        <h3>* - required field</h3>
        <span><?php echo $formResult?></span><br><br>
        <form id="form1" name="form1" method="post" enctype='multipart/form-data' action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
            <input type='hidden' name='MAX_FILE_SIZE' value='41943040'>
            <label for="journeyID">Journey ID:</label> <input name="journeyID" id="journeyID" type="text"/>* <span><?php echo $idErr?></span><hr width="420px">
            <label for="journeyDate">Journey date: </label><input name="journeyDate" id="journeyDate" type="date" aria-label="Product name" value="<?php echo $journeyDate;?>"/> <span class="error"><?php echo $journeyErr;?></span><br /><br />
            <label for="startTime">Start time:</label> <input name="startTime" id="startTime" type="time" aria-label="Product description" value="<?php echo $startTime;?>"/><span class="error"> <?php echo $startErr;?></span><br /><br />
            <label for="endTime">End time: </label> <input name="endTime" id="endTime" type="time" aria-label="Product price" value="<?php echo $endTime;?>" onblur="checkTime()"/><span class="error"> <?php echo $endErr;?></span><br /><br />
            <label for="journeyLength">Journey length:</label> <input style="width:30px" name="journeyLength" id="journeyLength" type="text" aria-label="Product description" value="<?php echo $journeyLength;?>" readonly/> min.<br /><br />
            <label for="departureLocation">Departure:</label> <input name="departureLocation" id="departureLocation" type="text" aria-label="Product finish" value="<?php echo $departureLocation;?>"/><span class="error"> <?php echo $departureErr;?></span><br /><br />
            <label for="destinationLocation">Destination:</label> <input name="destinationLocation" id="destinationLocation" type="text" aria-label="Product finish" value="<?php echo $destinationLocation;?>"/><span class="error"> <?php echo $destinationErr;?></span><br /><br />
            <!-- <label for="driverSig">Driver's signature:</label>
            <input type="file" id="driverSig" name="driverSig"> or <button type="button" onclick="alert('This feature is not available at this time. Please try again later.')">Draw signature</button></br></br> -->
            <label for="roadConds">Road type: </label>
            <select id="roadConds" name="roadConds">
                <option value="">-- select --</option>
                <option value="S">Sealed</option>
                <option value="U">Unsealed</option>
                <option value="Q">Quiet street</option>
                <option value="B">Busy road</option>
                <option value="ML">Multi-laned road</option>
            </select><span class="error"><?php echo $roadErr;?></span</br><br />
            <label for="weatherConds">Weather: </label>
            <select id="weatherConds" name="weatherConds">
                <option value="">-- select --</option>
                <option value="D">Dry</option>
                <option value="W">Wet</option>
            </select><span class="error"><?php echo $weatherErr;?></span</br><br />
            <label for="trafficConds">Traffic density: </label>
            <select id="trafficConds" name="trafficConds">
                <option value="">-- select --</option>
                <option value="L">Light</option>
                <option value="M">Medium</option>
                <option value="H">Heavy</option>
            </select><span class="error"><?php echo $trafficErr;?></span</br>
            <input name="submit" type="submit" value="Update"/>
            <input type ="reset" name="reset" value ="Reset" title="Reset Form"/>
        </form>
    </body>
</html>