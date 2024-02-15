<!--
    DOOR LEVER INVENTORY ASSIGNMENT - addProducttodb.php
    Developed by Bailey Camp on 15/3/2023
    This file is called from the add product form, it takes the information input from the add product form and adds it to its respective columns in the database
-->

<?php
    ini_set('display_errors', 0);
    error_reporting(-1);

    // Starts a browser session, this is used for saving the image path for use later
    $conn = @mysqli_connect("localhost:3306", "drivelog", "1234567890", "learnerdrivelog");
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
    $insert = "INSERT INTO journeys (journeyDate, fromLocation, toLocation, startTime, endTime, journeyLength, roadConds, weatherConds, trafficConds) VALUES ('$_POST[journeyDate]', '$_POST[departureLocation]', '$_POST[destinationLocation]', '$_POST[startTime]', '$_POST[endTime]', '$_POST[journeyLength]', '$_POST[roadConds]', '$_POST[weatherConds]', '$_POST[trafficConds]')";
    if (mysqli_query($conn, $insert)) {
            // Retrieves the ID from the inserted product in the database and stores it in a cookie
            // $nameID = mysqli_insert_id($conn);
            // setcookie("product_id", $nameID);
            // $dbQuery = "SELECT imagePath FROM products WHERE id=".$nameID;
            // $result = mysqli_query($conn, $dbQuery);
            // echo "$productid";
            // Retrieves the image path based on the product's ID and stores it in the session
            $successMsg = "Your log was saved sucessfully.";
        } else {
            $msgTxt = "There was an internal error.";
            echo "table query failed: " . mysqli_error($conn);
    }
    // Closes the MySQL connection
    mysqli_close($conn);
?>