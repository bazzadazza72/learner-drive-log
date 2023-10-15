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
		<link rel="stylesheet" type="text/css" href="./includes/css/style.css"/>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google+Sans">
    </head>
    <body>
        <?php
            ini_set('display_errors', 0);
            error_reporting(-1); 
            $idErr = "";
            $priceErr = "";
            $prodID = "";
            $newPrice = "";
            $invalidData = false;

            if ($_SERVER["REQUEST_METHOD"] == "POST") { 
                $prodID = checkInput($_POST["prodID"]);
                $newPrice = checkInput($_POST["prodCost"]);

                if ($prodID == "") {
					$idErr="Product ID must not be blank";
				} elseif (!is_numeric($prodID)){
					$idErr="Product ID must be numeric";
				} elseif ($newPrice == ""){
                    $priceErr="Product cost must not be blank";
                } elseif (!is_numeric($newPrice)){
                    $priceErr="Product cost must be numeric";
                } elseif ($newPrice < 20 || $newPrice > 200){
                    $priceErr="Product cost must be more than $20 and less than $200";
                } else {
					include('./includes/php/updateproductindb.php');
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
		<h2><i>Update Product</i></h2>
		<h3>* - required field</h3>
        <span><?php echo $formResult?></span><br><br>
        <form id="form1" name="form1" method="post">
            <label for="prodID">Product ID:</label> <input name="prodID" id="prodID" type="text"/>* <span><?php echo $idErr?></span><hr width="420px">
            <label for="prodCost">New product price: $ </label><input name="prodCost" id="prodCost" type="text"></input>* <span><?php echo $priceErr?></span><br /><br />
            <input name="submit" type="submit" value="Update"/>
            <input type ="reset" name="reset" value ="Reset" title="Reset Form"/>
        </form>
        <br><p>Logged in as <b><?php echo $_COOKIE["loggedInUser"];?></b></p>
		<a href="./index.php"><i>Log out</i></a>
    </body>
</html>