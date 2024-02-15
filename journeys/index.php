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
            $connectionErr = "";
            $queryFailureErr = "";
            $numOfEntries = 0;
            $displayCount = 20;

 
            // Username is root
            $user = 'drivelog';
            $password = '1234567890';
            
            // Database name is geeksforgeeks
            $database = 'learnerdrivelog';
            
            // Server is localhost with
            // port number 3306
            $servername='localhost:3306';
            $mysqli = new mysqli($servername, $user, $password, $database);
            
            // Checking for connections
            if ($mysqli->connect_error) {
                die('Connect Error (' .
                $mysqli->connect_errno . ') '.
                $mysqli->connect_error);
            }
            
            // SQL query to select data from database
            $sql = " SELECT * FROM journeys";
            $result = $mysqli->query($sql);
            $totalNumberOfEntries = mysqli_num_rows($result);

            $sql = " SELECT * FROM journeys LIMIT $displayCount";
            $result = $mysqli->query($sql);
            $numOfEntries = mysqli_num_rows($result);

        ?>
        <h1 class="acmeTitle">Acme Hardware</h1>
		<a href="./">My Journeys</a> | <a href="./addjourney.php">Add Journey</a> | <a href="./updateJourney.php">Update Journey</a>
		<h2><i>My Journeys</i></h2>
        <p><i>Showing <b><?php echo $numOfEntries ?></b> of <b><?php echo $totalNumberOfEntries ?></b> <?php if ($totalNumberOfEntries == 1) { echo("entry"); } else { echo("entries"); } ?></i></p>
        <span><i><?php echo $connectionErr ?></i></span>
        <section>
            <!-- TABLE CONSTRUCTION -->
            <table>
                <tr>
                    <th>Journey ID</th>
                    <th>Date</th>
                    <th>Starting location</th>
                    <th>Ending location</th>
                    <th>Start time</th>
                    <th>End time</th>
                    <th>Journey length (min)</th>
                    <th>Road conditions</th>
                    <th>Weather conditions</th>
                    <th>Traffic density</th>
                </tr>
                <!-- PHP CODE TO FETCH DATA FROM ROWS -->
                <?php 
                    // LOOP TILL END OF DATA
                    while($rows=$result->fetch_assoc())
                    {
                ?>
                <tr>
                    <!-- FETCHING DATA FROM EACH
                        ROW OF EVERY COLUMN -->
                    <td><?php echo $rows['id'];?></td>
                    <td><?php echo $rows['journeyDate'];?></td>
                    <td><?php echo $rows['fromLocation'];?></td>
                    <td><?php echo $rows['toLocation'];?></td>
                    <td><?php echo $rows['startTime'];?></td>
                    <td><?php echo $rows['endTime'];?></td>
                    <td><?php echo $rows['journeyLength'];?></td>
                    <td><?php echo $rows['roadConds'];?></td>
                    <td><?php echo $rows['weatherConds'];?></td>
                    <td><?php echo $rows['trafficConds'];?></td>
                </tr>
                <?php
                    }
                ?>
            </table>
        </section>
    </body>
</html>