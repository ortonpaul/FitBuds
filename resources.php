<!DOCTYPE html>
<html>
    <head>
        <title>Resources</title>
        <link rel="stylesheet" href="pages/assets/main.css">
        <link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet">
        <style>
        iframe {
          margin: auto;
          display: block;
        }
        </style>
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
            <li><a href="diagnostics.php">Diagnostics</a></li>
            <li><a href="past-results.php">Past Results</a></li>
            <li><a href="my-profile.php">My Profile</a></li>
            <li><a href="resources.php" id="selected">Resources</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        <div>
        <div class="callout">
            <h2>Resources Near Me</h2>
            <table class="resources">
                <thead>
                    <th><a href="resources.php?resource=fitness"><img src="pages/assets/weight.png"></a></th>
                    <th><a href="resources.php?resource=care"><img src="pages/assets/stethoscope.png"></a></th>
                    <th><a href="resources.php?resource=support"><img src="pages/assets/people.png"></a></th>
                </thead>
                <tr>
                    <td>Fitness</td>
                    <td>Care</td>
                    <td>Support</td>
                </tr>
            </table>';
            if(isset($_GET['resource'])) {
              echo '<h3>Results based on your location:</h3>';
              if($_GET['resource'] == "fitness") {
                echo '<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=gym&key=AIzaSyBGSNKy4FUNmeh7SijgX4NDZZPEBAxW9mA" allowfullscreen></iframe>';
              } elseif ($_GET['resource'] == "care") {
                echo '<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=hospital&key=AIzaSyBGSNKy4FUNmeh7SijgX4NDZZPEBAxW9mA" allowfullscreen></iframe>';

              } elseif ($_GET['resource'] == "support") {
                echo '<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=senior+services&key=AIzaSyBGSNKy4FUNmeh7SijgX4NDZZPEBAxW9mA" allowfullscreen></iframe>';

              }
            }
            echo '</div>';
?>
    </body>

</html>
