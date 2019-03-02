<?php
	require 'setup.php';
	if (empty($_SESSION['usernamev3'])) {
		header('Location: login.php');
		exit("You are not logged in. Redirecting..."); //Kicks off and automatically closes MySQL connection
	}
	$username = htmlentities($_SESSION['usernamev3']);
	echo "<p>Welcome to the logged in area, {$username}!</p>";
	echo '<button onClick="javascript:window.location.href=\'logout.php\'">Logout</button>';
	mysqli_close($databaseSQL); //Closes socket to MySQL! Important!
?>