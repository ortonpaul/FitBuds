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
            <li>New Cognitive Test <div class="tooltip"><img src="pages/assets/info.png"><span class="tooltiptext">Analyze your mental health habits</span></div>
              <a href="cognitivequiz1.php" class="diagButton">Quiz 1</a>
              <a href="cognitivequiz2.php" class="diagButton">Quiz 2</a></li>
            </ul>
            <ul id="eye">
            <li>New Sensory Test <div class="tooltip"><img src="pages/assets/info.png"><span class="tooltiptext">Assess your sensory capabilities</span></div></li>
            </ul>
            <ul id="heart">
            <li>New Vitals Check-In <div class="tooltip"><img src="pages/assets/info.png"><span class="tooltiptext">Log your vital data points</span></div></li>
            </ul>
            <ul id="weight">
            <li>New Fitness Check-In <div class="tooltip"><img src="pages/assets/info.png"><span class="tooltiptext">Analyze your physical health</span></div>
              <a href="https://api.qrserver.com/v1/create-qr-code/?data='.$username.'" onclick="window.open(\'https://api.qrserver.com/v1/create-qr-code/?data='.$username.'\',\'popup\',\'width=600,height=600\'); return false;" target="popup" class="diagButton">iOS Diagnostic App QR Code</a>
            </li>
            </ul>
            <ul id="apple">
            <li>New Nurtition Check-In <div class="tooltip"><img src="pages/assets/info.png"><span class="tooltiptext">Log your nutritional data</span></div></li>
            </ul>
        </div>';
?>

    </body>
</html>
