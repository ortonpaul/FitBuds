<?php
	require 'setup.php';
	if (isset($_SESSION['usernamev3'])) { //Person is already logged in
		header('Location: member.php');
		exit("You are already logged in. Redirecting to member page..."); //Automatically closes MySQL connection and sends to logged in page
	}
	if (isset($_POST["register"]) and fieldExist()) {
		//Checks if user already exists
		$checkUser =  mysqli_prepare($databaseSQL, "SELECT Email FROM users WHERE Email=?;");
		mysqli_stmt_bind_param($checkUser, 's', $name);

		$name = $_POST["username"]; //Grabs name and password entered from POST
		$password = $_POST["passwrd"];

		mysqli_stmt_execute($checkUser); //System of prepared execution prevents SQL Injection
		$result = mysqli_stmt_get_result($checkUser);

		if (!mysqli_num_rows($result)) { //Only creates user if query SELECT returns no rows (so username is not in use)
			$checkUser =  mysqli_prepare($databaseSQL, "INSERT INTO users (Email, Password) VALUES (?,?)");
			mysqli_stmt_bind_param($checkUser, 'ss', $name, $password);

			$name = $_POST["username"]; //Grabs name and password entered from POST after page redirect from home.html on submit
			$password = password_hash($_POST["passwrd"], PASSWORD_DEFAULT);
            
            echo mysqli_stmt_execute($checkUser); //Prevents SQL Injection?

			echo "Account created with username {$name}.";
			echo '<br><button onClick="javascript:window.location.href=\'login.php\'">Take me to login!</button>';
		} else {
			echo "Username already in use.";
			echo '<br><button onClick="javascript:window.location.href=\'register.php\'">Try again!</button>';
		}
		mysqli_stmt_free_result($checkUser);
		mysqli_stmt_close($checkUser);
	} else { // Form generation if submit has not been pressed
		echo '<!DOCTYPE HTML>
		<html>
		<head><meta charset="utf-8">
		<title>David Frankel\'s Fancy Login Page</title>
		<meta name="description" content="Less basic login!">
		<meta name="author" content="David Frankel"></head>
		<body>';
		echo '<form action="register.php" method="post">
			Username: <input type="text" name="username" required><br>
			Password: <input type="password" name="passwrd" required><br>
			<input type="submit" value="Register" name="register">
			</form>';
		echo '<form action="login.php">I already have an account.<input type="submit" value="Take me to login!" /></form>';
	}

	mysqli_close($databaseSQL); //Closes socket to MySQL! Important!

	function fieldExist() {
		if ($_POST["username"] !== "" and $_POST["passwrd"] !== "") {
			return true;
		} else {
			echo "You did not enter anything. Try again.";
			return false;
		}
	}
?>
