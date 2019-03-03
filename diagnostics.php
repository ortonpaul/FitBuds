<!DOCTYPE html>
<html>
    <head>
        <title>Diagnostics</title>
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

  echo '    <body>
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
            <ul id="brain">
            <li>New Cognitive Test <img src="pages/assets/info.png"><a href="pages/cognitivequiz1.html" style="color:black; margin: 0px 20px; padding: 10px 10px 10px 0px; background-color: lightgray; text-decoration: none;"> Quiz 1</a><a href="pages/cognitivequiz2.html" style="color:black; margin: 0px 20px; padding: 10px 10px 10px 0px; background-color: lightgray; text-decoration: none;"> Quiz 2</a></li>
            </ul>
            <ul id="eye">
            <li>New Sensory Test <img src="pages/assets/info.png"></li>
            </ul>
            <ul id="heart">
            <li>New Vitals Check-In <img src="pages/assets/info.png"></li>
            </ul>
            <ul id="weight">
            <li>New Strength Check-In <img src="pages/assets/info.png"></li>
            </ul>
            <ul id="apple">
            <li>New Nurtition Check-In <img src="pages/assets/info.png"></li>
            </ul>
        </div>';
?>

    </body>
</html>
