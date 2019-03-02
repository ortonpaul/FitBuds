<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>FitBud Welcome</title>
        <meta name="description" content="The login/register page of FitBud.">
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        
<?php
	//Optional error printing code
	error_reporting(-1);
	ini_set('display_errors', 'On');


	// Make the main SQL connection:
	$databaseSQL = mysqli_connect('localhost', 'root', 'root', 'users');
	if (!$databaseSQL) {
		trigger_error('Could not connect to MySQL: '.mysqli_connect_error() );
	}

	if (isset($_POST["submit"])) {
		$checkUser =  mysqli_prepare($databaseSQL, "SELECT Email, Password FROM users WHERE Email=? AND Password=?;");
		mysqli_stmt_bind_param($checkUser, 'ss', $name, $password);

		$name = $_POST["username"]; //Grabs name and password entered from POST after page redirect from home.html on submit
		$password = $_POST["passwrd"];

		mysqli_stmt_execute($checkUser); //Prevents SQL Injection?
		$result = mysqli_stmt_get_result($checkUser);
		
		if (mysqli_num_rows($result)) {
			echo "Logged in.";
            header("Location: /home.html");
		} else {
			echo "Username or password incorrect.";
		}

		mysqli_stmt_close($checkUser);
	} else { // Form generation if submit has not been pressed
		echo '<form action="index.php" method="post">
			Username: <input type="text" name="username"><br>
			Password: <input type="password" name="passwrd"><br>
			<input type="submit" value="Submit" name="submit">
			</form>';
	}

	mysqli_close($databaseSQL); //Closes socket to MySQL! Important!

?>
        <!--
        <div align = "center">
        <h1> Welcome to FitBud! </h1>
        <h3> Check in and check up </h3>
        <a href = "loginform.html" class = "button"> Log In </a>
        <a href = "registerform.html" class = "button"> Register </a>
        </div>-->
    </body>
</html>
        
