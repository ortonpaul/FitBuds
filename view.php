<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Cognitive Quiz 1</title>
        <meta name="description" content="One of the cognitive quizzes on FitBuds.">
        <link rel="stylesheet" href="pages/assets/main.css">
    </head>
<?php
require 'setup.php';
if (empty($_SESSION['usernamev3'])) {
  header('Location: login.php');
  exit("You are not logged in. Redirecting..."); //Kicks off and automatically closes MySQL connection
}
$username = htmlentities($_SESSION['usernamev3']);
if(isset($_GET["email"]) and isset($_GET["timestamp"])) {
	$email = htmlspecialchars($_GET["email"]);
  if ($email != $username) {
    exit("You don't have permission for that!");
  }
	$timestamp = htmlspecialchars($_GET["timestamp"]);
	$resultArray = [];
	$checkUser =  mysqli_prepare($databaseSQL, "SELECT Results FROM users WHERE Email=?;");
	mysqli_stmt_bind_param($checkUser, 's', $email);
	mysqli_stmt_execute($checkUser);
	if ($result = mysqli_stmt_get_result($checkUser)) {	// echo "<p>Welcome to the logged in area, {$username}!</p>";
    if ($row = mysqli_fetch_row($result)) {
      $resultArray = unserialize($row[0]);
    }
	}

  echo '<body>
  <div class="homeIcon">
      <a href="member.php"><img src="pages/assets/home.png" alt="home"></a>
  </div>
  <ul class="navbar">
      <li><a href="diagnostics.php" id="selected">Diagnostics</a></li>
      <li><a href="past-results.php">Past Results</a></li>
      <li><a href="my-profile.php">My Profile</a></li>
      <li><a href="resources.php">Resources</a></li>
      <li><a href="logout.php">Logout</a></li>
  </ul>
  <div class="callout">
      <h2>Your quiz score was:</h2>
      <h2>'.$resultArray[$timestamp]["score"].'</h2>
      </div>';
}
?>
</body>
</html>
