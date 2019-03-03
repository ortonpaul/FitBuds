<!DOCTYPE html>
<html>
    <head>
        <title>Diagnostics</title>
        <link rel="stylesheet" href="assets/main.css">
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

  echo '    <body>
        <div class="homeIcon">
            <a href="home.html"><img src="assets/home.png" alt="home"></a>
        </div>
        <ul class="navbar">
            <li><a href="diagnostics.php" id="selected">Diagnostics</a></li>
            <li><a href="past-results.html">Past Results</a></li>
            <li><a href="my-profile.html">My Profile</a></li>
            <li><a href="resources.html">Resources</a></li>
        </ul>
        <div class="callout">
            <ul id="brain">
            <li>New Cognitive Test <img src="assets/info.png"></li>
            </ul>
            <ul id="eye">
            <li>New Sensory Test <img src="assets/info.png"></li>
            </ul>
            <ul id="heart">
            <li>New Vitals Check-In <img src="assets/info.png"></li>
            </ul>
            <ul id="weight">
            <li>New Strength Check-In <img src="assets/info.png"></li>
            </ul>
            <ul id="apple">
            <li>New Nurtition Check-In <img src="assets/info.png"></li>
            </ul>
        </div>';

?>

    </body>
</html>
