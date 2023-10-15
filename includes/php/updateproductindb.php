<?php 
	/* 
    DOOR LEVER INVENTORY ASSIGNMENT - updateproductindb.php
    Developed by Bailey Camp on 15/3/2023
	This file is called from the product update form, and it takes the information entered in the form and updates the entry in the database
 	*/
	
	$conn = @mysqli_connect("localhost:3306","root","","acme_products");

	if (mysqli_connect_errno())
	{
		echo "<p>Failed to connect to MySQL and the db: " . mysqli_connect_error() . "</p>";
	}
	else {	

		$query = "UPDATE products SET prodCost = $newPrice WHERE id= $prodID";
		$results = mysqli_query($conn,$query);
		$numRowsAffected = mysqli_affected_rows($conn);
		if (!$results) 
		{
			echo "<p>Error updating product data: " . mysqli_error($conn) . "</p>";
		}
		else 
			if ($numRowsAffected == 0) 
			{
				$formResult = "Product was not found.";
			}
			else {
				// Updates the product using the ID and the new cost
				$query = "SELECT * FROM products WHERE id=$prodID";
				$results = mysqli_query($conn,$query);
				if ($results) {
					$numRecords=mysqli_num_rows($results);
					if ($numRecords != 0){
						while ($row = mysqli_fetch_array($results)) 
						{ 
							$formResult = "Price successfully updated for product with ID: ".$prodID.". New product cost: $$row[prodCost]";
						}
					}
					else{
						echo "<p>Product ID not found!</p>";
					}
				}
			}
	}		
		
	mysqli_close($conn);
?>