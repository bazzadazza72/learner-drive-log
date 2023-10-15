<?php
    /*
    DOOR LEVER INVENTORY ASSIGNMENT - addharduser.php
    Developed by Bailey Camp on 15/3/2023
    This file inserts the username and password required for logging in into the database.
    */

    ini_set('display_errors', 0);
    error_reporting(-1); 
	// Declares the MySQL connection, using the 'root' user and connecting to the 'acme_products' database
	$conn = @mysqli_connect("localhost:3306", "root", "", "acme_products");
	 
	if (!$conn) {
		echo "The connection has failed: " . mysqli_connect_error();
	}
	// Creates the table required for logging in if it doesn't exist
    $query = "CREATE TABLE IF NOT EXISTS users (username varchar(50) not null primary key, userpassword varchar(255) not null)";
    
    if (!mysqli_query($conn,$query)) {
        echo "<p>table query failed: " . mysqli_error($conn)."</p>";
    }
    else
    {	
        $newUsername = "bailey";
        $newPassword = "RickAstley";

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        // Inserts the username and hashed password defined above into the database
        $insert = "INSERT INTO users(username, userpassword) VALUES ('$newUsername', '$hashedPassword')";
        if (mysqli_query($conn, $insert)) {
            // Shows a message to the user stating the process completed
            echo "<p>Hardcoded user was added</p>"; 
            echo "<p>Press your browser's back button to return to the admin menu.</p>";
        }
        else 
        {
            echo "<p>table query failed: " . mysqli_error($conn) . "</p>";
        }
    }
	// Closes the MySQL connection
	mysqli_close($conn);
?>
