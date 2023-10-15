<!--
    DOOR LEVER INVENTORY ASSIGNMENT - addProducttodb.php
    Developed by Bailey Camp on 15/3/2023
    This file is called from the add product form, it takes the information input from the add product form and adds it to its respective columns in the database
-->

<?php
    ini_set('display_errors', 0);
    error_reporting(-1);

    // Starts a browser session, this is used for saving the image path for use later
    session_start();
    $conn = @mysqli_connect("localhost", "root", "", "acme_products");
    $msgTxt;
    $nameID = 0;
    $retrievedCookie = 0;
    $tempname = "";

    if ($conn === false) {
        echo "The connection has failed: " . mysqli_connect_error();
    }
    else
    {
        // echo "Successfully connected to mySQL!";
    }
    
    // Inserts the data from the add products form and inserts it into the database
    $insert = "INSERT INTO products (prodName, prodDesc, prodCost, prodFinish, imagePath) VALUES ('$_POST[prodName]', '$_POST[prodUsage]', '$_POST[prodCost]', '$_POST[prodFinish]', '$fileLocation')";
    if (mysqli_query($conn, $insert)) {
            // Retrieves the ID from the inserted product in the database and stores it in a cookie
            $nameID = mysqli_insert_id($conn);
            setcookie("product_id", $nameID);
            $dbQuery = "SELECT imagePath FROM products WHERE id=".$nameID;
            $result = mysqli_query($conn, $dbQuery);
            echo "$productid";
            // Retrieves the image path based on the product's ID and stores it in the session
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $imagePath = $row["imagePath"];
                $_SESSION['imagePath'] = $imagePath;
            }
            else {
                echo "Record doesn't exist";
            }
        } else {
            $msgTxt = "There was an internal error.";
            echo "table query failed: " . mysqli_error($conn);
    }
    // Closes the MySQL connection
    mysqli_close($conn);
?>