<!DOCTYPE html>
<html>
    <head>
        <title>Resources</title>
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
            <li><a href="diagnostics.php">Diagnostics</a></li>
            <li><a href="past-results.php">Past Results</a></li>
            <li><a href="my-profile.php">My Profile</a></li>
            <li><a href="resources.php" id="selected">Resources</a></li>
        </ul>
        <div>
        <div class="callout">
            <h2>Resources Near Me</h2>
            <table class="resources">
                <thead>
                    <th><a href="https://www.google.com/maps?q=gym" target="_blank"><img src="pages/assets/weight.png"></a></th>
                    <th><a href="https://www.google.com/maps?q=hospital" target="_blank"><img src="pages/assets/stethoscope.png"></a></th>
                    <th><a href="https://www.google.com/maps?q=senior+services" target="_blank"><img src="pages/assets/people.png"></a></th>
                </thead>
                <tr>
                    <td>Fitness</td>
                    <td>Care</td>
                    <td>Support</td>
                </tr>
            </table>';
            if(isset($_GET['resource'])) {
              echo '<h3>Your Location:</h3>';
              if($_GET['resource'] == "fitness") {
              } elseif ($_GET['resource'] == "care") {

              } elseif ($_GET['resource'] == "support") {

              }
            }
            echo '</div>';
?>
    </body>

</html>
