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
  $name = " ";
  $checkUser =  mysqli_prepare($databaseSQL, "SELECT Name FROM users WHERE Email=?;");
  mysqli_stmt_bind_param($checkUser, 's', $username);

  mysqli_stmt_execute($checkUser); //System of prepared execution prevents SQL Injection
  if ($result = mysqli_stmt_get_result($checkUser)) {	// echo "<p>Welcome to the logged in area, {$username}!</p>";
    if ($row = mysqli_fetch_row($result)) {
      $name = $row[0];
    }
}
	echo '	<body>
			<div class="homeIcon" id="selected">
					<a href="member.php"><img src="pages/assets/home.png" alt="home" ></a>
			</div>
			<ul class="navbar">
					<li><a href="diagnostics.php">Diagnostics</a></li>
					<li><a href="past-results.php">Past Results</a></li>
					<li><a href="my-profile.php">My Profile</a></li>
					<li><a href="resources.php">Resources</a></li>
			</ul>
			<div>
					<h1 style="padding-top: 100px">Welcome back, ' . $name . '!</h1>
					<h3>Click a tab to get started!</h3>
			</div>';
	echo '<button onClick="javascript:window.location.href=\'logout.php\'">Logout</button>';
	mysqli_close($databaseSQL); //Closes socket to MySQL! Important!
?>


	</body>
</html>
