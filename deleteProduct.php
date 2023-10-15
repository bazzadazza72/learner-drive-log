<!--
    DOOR LEVER INVENTORY ASSIGNMENT - deleteProduct.php
    Developed by Bailey Camp on 15/3/2023
	This file shows a form where the user can delete a product from the database by using its ID
-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Acme Hardware - Delete Product</title>
		<link rel="stylesheet" type="text/css" href="./includes/css/style.css"/>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google+Sans">
    </head>
	<body>
		<?php
			ini_set('display_errors', 0);
			error_reporting(-1); 
			$formResult = "";
			$prodIDErr = "";
			$successText = "";
			$invalidData = false;
			
		
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$prodID = checkInput($_POST["prodID"]);
				
				if ($prodID == "") {
					$prodIDErr="Product ID must not be blank";
				}
				elseif (!is_numeric($prodID)){
					$prodIDErr="Product ID must be numeric";
				} else {
					include('./includes/php/deleteproductfromdb.php');
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
		<h2><i>Delete Product</i></h2>
		<h3>* - required field</h3>
		<span class="error"><?php echo $formResult;?></span><br>
        <form id="form1" name="form1" method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>>
			<br><label for="prodID">Product ID:</label> <input name="prodID" id="prodID" type="text"/>* <span class="error"><?php echo $prodIDErr;?></span><br /><br />
			<input name="submit" type="submit" value="Delete"/>
			<input type ="reset" name="reset" value ="Reset" title="Reset Form"/>
		</form>
        <br><p>Logged in as <b><?php echo $_COOKIE["loggedInUser"];?></b></p>
		<a href="./index.php"><i>Log out</i></a>
    </body>
</html>