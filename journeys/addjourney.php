<!--
    DOOR LEVER INVENTORY ASSIGNMENT - addProduct.php
    Developed by Bailey Camp on 15/3/2023
	This file shows a form where the user can input product information and it will save it to the MySQL database
-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Acme Hardware - Add Product</title>
        <link rel="stylesheet" type="text/css" href="../includes/css/style.css"/>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google+Sans">
    </head>
    <body>
        <?php
			ini_set('display_errors', 0);
			error_reporting(-1); 
            // Declares blank error <span> variables to use later
            $nameErr = "";
            $usageErr = "";
            $costErr = "";
            $finishErr = "";
			$fileErr = "";
            $invalidData = false;
			$journeyDate = "";
			$startTime = "";
			$endTime = "";
			$prodFinish = "";

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$journeyDate = checkInput($_POST["journeyDate"]);
                $startTime = checkInput($_POST["startTime"]);
                $endTime = checkInput($_POST["endTime"]);
                $prodFinish = checkInput($_POST["prodFinish"]);
				$fileUpload = $_FILES['imageFile']['name'];
				$filetype = $_FILES['imageFile']['type'];
				$filesize = $_FILES['imageFile']['size'];
				$tempname = $_FILES['imageFile']['tmp_name'];
        		$fileLocation = ".\\\\images\\\\" . $fileUpload;

				if ($journeyDate == ""){
					$nameErr = "Product name must not be blank.";
					$invalidData = true;
				} else {
					$nameErr = "";
				}

				if ($startTime == ""){
					$usageErr = "Product usage must not be blank.";
					$invalidData = true;
				} else {
					$usageErr = "";
				}

                if ($endTime == ""){
					$costErr = "Product cost must not be blank.";
					$invalidData = true;
				} elseif (!filter_var($endTime, FILTER_VALIDATE_FLOAT)) {
					$costErr = "Please enter a valid product cost.";
					$invalidData = true;
				} elseif ($endTime <= 0) {
					$costErr = "Please enter a product cost that is more than zero.";
					$invalidData = true;
				} else {
					$costErr = "";
				}

                if ($prodFinish == ""){
					$finishErr = "Product finish must not be blank.";
					$invalidData = true;
				} else {
					$finishErr = "";
				}

				if (($_FILES['imageFile']['type'] != "image/jpeg" && $_FILES['imageFile']['type'] != "image/png") && $_FILES['imageFile']['name'] != "") {
					$fileErr = "Image is not a JPEG or PNG file.";
					$invalidData = true;
				}

				if (!move_uploaded_file($tempname, $fileLocation)) {
					switch ($_FILES['imageFile']['error'])
					{
						case UPLOAD_ERR_INI_SIZE:
							$fileErr = "The file you uploaded is bigger than the limit set by the server.";
							$invalidData = true;
							break;
						
						case UPLOAD_ERR_FORM_SIZE:
							$fileErr = "The file you uploaded is bigger than the limit set by your browser.";
							$invalidData = true;
							break;
						
						case UPLOAD_ERR_NO_FILE:
							$fileErr = "You didn't upload a file, you numpty!";
							$invalidData = true;
							break;
						
						default:
							$fileErr = "Your file could not be uploaded.";
							$invalidData = true;
					}
				}
				
				if ($invalidData == false) {
					session_start();
					include('../includes/php/addentrytodb.php');
					header('Location: ./confirm.php');
					exit();
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
		<a href="./addProduct.php">Add Product</a> | <a href="./updateProduct.php">Update Product</a> | <a href="./deleteProduct.php">Delete Product</a>
		<h2><i>Add Product</i></h2>
		<h3>* - required field</h3>
        <form id="form1" name="form1" method="post" enctype='multipart/form-data' action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
			<input type='hidden' name='MAX_FILE_SIZE' value='41943040'>
			<label for="journeyDate">Journey date: </label><input name="journeyDate" id="journeyDate" type="date" aria-label="Product name" value="<?php echo $journeyDate;?>"/> <span class="error"><?php echo $nameErr;?></span><br /><br />
			<label for="startTime">Start time:</label> <input name="startTime" id="startTime" type="time" aria-label="Product description" value="<?php echo $startTime;?>"/><span class="error"> <?php echo $usageErr;?></span><br /><br />
			<label for="endTime">End time: </label> <input name="endTime" id="endTime" type="time" aria-label="Product price" value="<?php echo $endTime;?>"/><span class="error"> <?php echo $costErr;?></span><br /><br />
			<label for="prodFinish">Departure:</label> <input name="prodFinish" id="prodFinish" type="text" aria-label="Product finish" value="<?php echo $prodFinish;?>"/><span class="error"> <?php echo $finishErr;?></span><br /><br />
			<label for="prodFinish">Destination:</label> <input name="prodFinish" id="prodFinish" type="text" aria-label="Product finish" value="<?php echo $prodFinish;?>"/><span class="error"> <?php echo $finishErr;?></span><br /><br />
			<label for="driverSig">Driver's signature:</label>
			<input type="file" id="driverSig" name="driverSig"> or <button type="button" onclick="alert('This feature is not available at this time. Please try again later.')">Draw signature</button></br></br>
			<label for="roadConds">Road type: </label>
			<select id="roadConds" name="roadConds">
				<option value="">-- select --</option>
				<option value="S">Sealed</option>
				<option value="U">Unsealed</option>
				<option value="Q">Quiet street</option>
				<option value="B">Busy road</option>
				<option value="ML">Multi-laned road</option>
            </select></br><br />
			<label for="weatherConds">Weather: </label>
			<select id="weatherConds" name="weatherConds">
				<option value="">-- select --</option>
				<option value="D">Dry</option>
				<option value="W">Wet</option>
            </select></br><br />
			<label for="trafficConds">Traffic density: </label>
			<select id="trafficConds" name="trafficConds">
				<option value="">-- select --</option>
				<option value="L">Light</option>
				<option value="M">Medium</option>
				<option value="H">Heavy</option>
            </select></br>
			<input name="submit" type="submit" value="Submit"/>
			<input type="reset" name="reset" value="Reset" title="Reset"/>
			
		</form>
    </body>
</html>