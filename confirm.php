<!--
    DOOR LEVER INVENTORY ASSIGNMENT - confirm.php
    Developed by Bailey Camp on 15/3/2023
    This file shows confirmation that the product, and its information, was added to the databae
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
            session_start();
        ?>
        <h1 class="acmeTitle">Acme Hardware</h1>
		<a href="./addProduct.php">Add Product</a> | <a href="./updateProduct.php">Update Product</a> | <a href="./deleteProduct.php">Delete Product</a>
		<h2><i>Add Product</i></h2>
        <p>The operation was successful.</p>
        <?php
            // Retrieves the product ID from the cookie 'product_id', created when the product was added to the database
            echo "<p>Your product ID is " . $_COOKIE['product_id'] . ".</p>";
            // Retrieves the image path from the browser session and renders it on the page
            echo "<img src='$_SESSION[imagePath]' height='300' width='200' alt='Product image'/>";
        ?>
        <br><p>Logged in as <b><?php echo $_COOKIE["loggedInUser"];?></b></p>
		<a href="./index.php"><i>Log out</i></a>
    </body>
</html>
