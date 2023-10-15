<!--
    DOOR LEVER INVENTORY ASSIGNMENT - index.php
    Developed by Bailey Camp on 15/3/2023
	This file shows a login form, placing a wall before the rest of the site
-->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Acme Hardware - Login</title>
		<link rel="stylesheet" type="text/css" href="./includes/css/style.css"/>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google+Sans">
	</head>
	<body>
		<?php
			ini_set('display_errors', 0);
			error_reporting(-1); 
			$userName;
			$userpassword;
			$errMessageUserName="";
			$errMessageUserPassword="";
			
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if(isset($_POST["reset"])){
					header("Refresh:0");
					exit();
				}
				
				$userName = checkInput($_POST["userName"]);
				$userPassword = checkInput($_POST["userPassword"]);
				
				$errMessageUserName="";
				$errMessageUserPassword="";
				
				$validData = true;

				
				if($userName == "") {
					$errMessageUserName="Username must not be blank";
					$validData = false;
				}
				
				if($userPassword == "") {
					$errMessageUserPassword="Password must not be blank";
					$validData = false;
				}
				
				if ($validData) {
					setcookie("loggedInUser", $_POST["userName"]);
					include("./includes/php/verifylogin.php");
					exit();
				}
			}
			
			function checkInput($inputData) {
				$inputData = trim($inputData);
				$inputData = stripslashes($inputData);
				$inputData = htmlspecialchars($inputData);
				$inputData = strip_tags($inputData);
				return $inputData;
			}
		?>



		<h1 class="acmeTitle">Acme Hardware</h1>
		<h2><i>Login</i></h2><br/>
		<h3>* - required field</h3>
		<form id="login" name="login" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<label for="userName">Username:</label> <input name="userName" id="userName" type="text" aria-label="Username field" /> * <span><?php echo $errMessageUserName?></span><br />
			<label for="password">Password:</label> <input name="userPassword" id="password" type="password" aria-label="Password field"> * </input><?php echo $errMessageUserPassword?><br /><br />
			<input name="submit" type="submit" value="Log in"/>
			<input type="reset" name="reset" value="Clear" title="Reset Form"/>
		</form>
	</body>
</html>