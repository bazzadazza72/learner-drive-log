<?php
    /*
    DOOR LEVER INVENTORY ASSIGNMENT - verifylogin.php
    Developed by Bailey Camp on 15/3/2023
    This file is called from the login form, it pulls the hashed password from the database and compares it with the password the user input
    */
    ini_set('display_errors', 0);
	error_reporting(-1); 
    $conn = @mysqli_connect("localhost:3306", "root", "", "acme_products");
	 
	if (!$conn) {
		echo "The connection has failed: " . mysqli_connect_error();
	}

    $userName = $_POST['userName'];
	$userPassword = $_POST['userPassword'];

    
    $query = "SELECT * FROM users WHERE username='".$userName."'";
    $results = mysqli_query($conn,$query);
    if ($results) 
    {
        // Selects the username from the daatabase and shows an error if it doesn't exist
        $numRecords=mysqli_num_rows($results);
        if ($numRecords != 0)
        {
            $row = mysqli_fetch_array($results);
            $hashedPassword = $row['userpassword'];
            
            // Verifies the password from the database with the password from the form, and
            // if it is the same, it logs the user in
            $passwordsAreTheSame = password_verify($userPassword, $hashedPassword);
            
            if ($passwordsAreTheSame == true)
            {
                echo "<p>Passwords match! Logging in...</p>";
                sleep(3);
                header('Location: addProduct.php');
            }
            else
            {
                echo "<p>The password you entered doesn't match our records. Check your spelling and try again.</p>";
                echo "<a href='./index.php'>Return to form</a>";
            }
        }
        else
        {
            echo "<p>The user you entered doesn't exist in our database. Check your details and try again.</p>";
            echo "<a href='./index.php'>Return to form</a>";
        }	
    }
    else
    {
        echo "<p>Error locating customer details</p>";
        echo "<a href='./index.php'>Return to form</a>";
    }
?>
                
                
                
                
                