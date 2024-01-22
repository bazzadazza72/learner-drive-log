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
		<script src="../includes/js/main.js"></script>
    </head>
    <body>
        <?php
            // Declares blank error <span> variables to use later
            $connectionErr = "There was an internal error retrieving the journey data.";
            $queryFailureErr = "";
            $numOfEntries = 3;
        ?>
        <h1 class="acmeTitle">Acme Hardware</h1>
		<a href="./addProduct.php">My Journeys</a> | <a href="./updateProduct.php">Add Journey</a> | <a href="./deleteProduct.php">Update Journeys</a>
		<h2><i>My Journeys</i></h2>
        <p><i>Showing <b><?php echo $numOfEntries ?></b> entries</i></p>
        <span><i><?php echo $connectionErr ?></i></span>
    </body>
</html>