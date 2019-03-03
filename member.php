<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" href="pages/assets/main.css">
        <link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet">
    </head>

		<?php
	require 'setup.php';
	if (empty($_SESSION['usernamev3'])) {
		header('Location: login.php');
		exit("You are not logged in. Redirecting..."); //Kicks off and automatically closes MySQL connection
	}
	$username = htmlentities($_SESSION['usernamev3']);
	// echo "<p>Welcome to the logged in area, {$username}!</p>";

	echo '	<body>
			<div class="homeIcon" id="selected">
					<a href="home.html"><img src="pages/assets/home.png" alt="home" ></a>
			</div>
			<ul class="navbar">
					<li><a href="diagnostics.html">Diagnostics</a></li>
					<li><a href="past-results.html">Past Results</a></li>
					<li><a href="my-profile.html">My Profile</a></li>
					<li><a href="resources.html">Resources</a></li>
			</ul>
			<div>
					<h1 style="padding-top: 100px">Welcome back, {$username}!</h1>
					<h3>Click a tab to get started!</h3>
			</div>';
	echo '<button onClick="javascript:window.location.href=\'logout.php\'">Logout</button>';
	mysqli_close($databaseSQL); //Closes socket to MySQL! Important!
?>


	</body>
</html>
