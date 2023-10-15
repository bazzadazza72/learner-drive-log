<?php
	/*
	DOOR LEVER INVENTORY ASSIGNMENT - deleteproductfromdb.php
	Developed by Bailey Camp on 15/3/2023
	This file takes the information input from the delete product form and deletes the product using its ID
	*/
	ini_set('display_errors', 0);
	error_reporting(-1); 
	$conn = @mysqli_connect("localhost:3306","root","","acme_products");
	$formResult = "";
	
	if (mysqli_connect_errno())
	{
		echo "<p>Failed to connect to MySQL and the test db: " . mysqli_connect_error() . "</p>";
	}		
	
	// Executes a MySQL query to delete the product based on its ID
	$query = "DELETE FROM products WHERE id= $prodID";
	$results = mysqli_query($conn,$query);
	$numRowsAffected = mysqli_affected_rows($conn);
	if (!$results) 
	{
		echo "<p>Error deleting product data: " . mysqli_error($conn) . "</p>";
	}
	else 
	{
		if ($numRowsAffected == 0) 
		{
			$formResult = "Product ID was not found";
		}
		else 		
		{	
			// Shows a message in the form stating the process was completed successfully
			$formResult = "Product with ID ".$prodID." was successfully deleted";
		}
	}
	
	mysqli_close($conn);
?>
