<!DOCTYPE html>
<html>
    <head>
        <title>Past Results</title>
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

  $resultArray = [];
  $checkUser =  mysqli_prepare($databaseSQL, "SELECT Results FROM users WHERE Email=?;");
  mysqli_stmt_bind_param($checkUser, 's', $username);
  mysqli_stmt_execute($checkUser);
  if ($result = mysqli_stmt_get_result($checkUser)) {	// echo "<p>Welcome to the logged in area, {$username}!</p>";
    if ($row = mysqli_fetch_row($result)) {
      $resultArray = unserialize($row[0]);
    }
  }

  echo '    <body>
        <div class="homeIcon">
            <a href="member.php"><img src="pages/assets/home.png" alt="home"></a>
        </div>
        <ul class="navbar">
            <li><a href="diagnostics.php">Diagnostics</a></li>
            <li><a href="past-results.php" id="selected">Past Results</a></li>
            <li><a href="my-profile.php">My Profile</a></li>
            <li><a href="resources.php">Resources</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        <div>
        <div class="callout">
            <table class="past">
              <tr>
                <th></th>
                <th>Date</th>
                <th>Shared</th>
                <th>Type</th>
                <th>View</th>
                <th>Download</th>
                <th>Share</th>
              </tr>';
              $counter = 1;
              foreach ($resultArray as $key => $value) {
                echo '<tr>
                  <td>'.$counter.'.</td>
                  <td>'.date('n/j/y g:ia', $key).'</td>
                  <td>TBD</td>
                  <td>'.$value["type"].'</td>
                  <td><img src="pages/assets/eye.png"></td>
                  <td><img src="pages/assets/download.png"></td>
                  <td><img src="pages/assets/share.png"></td>
                </tr>';
                $counter = $counter + 1;
              }
              // <tr>
              //   <td>1.</td>
              //   <td>6/4/2018</td>
              //   <td>Yes</td>
              //   <td>Sensory</td>
              //   <td><img src="pages/assets/eye.png"></td>
              //   <td><img src="pages/assets/download.png"></td>
              //   <td><img src="pages/assets/share.png"></td>
              // </tr>
              //   <tr>
              //   <td>2.</td>
              //   <td>7/15/2018</td>
              //   <td>Yes</td>
              //   <td>Cognitive</td>
              //   <td><img src="pages/assets/eye.png"></td>
              //   <td><img src="pages/assets/download.png"></td>
              //   <td><img src="pages/assets/share.png"></td>
              // </tr>
              //   <tr>
              //   <td>3.</td>
              //   <td>8/1/2018</td>
              //   <td>No</td>
              //   <td>Vital</td>
              //   <td><img src="pages/assets/eye.png"></td>
              //   <td><img src="pages/assets/download.png"></td>
              //   <td><img src="pages/assets/share.png"></td>
              // </tr>
              //   <tr>
              //   <td>4.</td>
              //   <td>8/9/2018</td>
              //   <td>Yes</td>
              //   <td>Nutritional</td>
              //   <td><img src="pages/assets/eye.png"></td>
              //   <td><img src="pages/assets/download.png"></td>
              //   <td><img src="pages/assets/share.png"></td>
              // </tr>
              //   <tr>
              //   <td>5.</td>
              //   <td>10/22/2018</td>
              //   <td>No</td>
              //   <td>Physical</td>
              //   <td><img src="pages/assets/eye.png"></td>
              //   <td><img src="pages/assets/download.png"></td>
              //   <td><img src="pages/assets/share.png"></td>
              // </tr>
              //   <tr>
              //   <td>6.</td>
              //   <td>11/13/2018</td>
              //   <td>No</td>
              //   <td>Cognitive</td>
              //   <td><img src="pages/assets/eye.png"></td>
              //   <td><img src="pages/assets/download.png"></td>
              //   <td><img src="pages/assets/share.png"></td>
              // </tr>
              //   <tr>
              //   <td>7.</td>
              //   <td>11/27/2018</td>
              //   <td>No</td>
              //   <td>Cognitive</td>
              //   <td><img src="pages/assets/eye.png"></td>
              //   <td><img src="pages/assets/download.png"></td>
              //   <td><img src="pages/assets/share.png"></td>
              // </tr>
              //   <tr>
              //   <td>8.</td>
              //   <td>12/15/2018</td>
              //   <td>Yes</td>
              //   <td>Vital</td>
              //   <td><img src="pages/assets/eye.png"></td>
              //   <td><img src="pages/assets/download.png"></td>
              //   <td><img src="pages/assets/share.png"></td>
              // </tr>
              //   <tr>
              //   <td>9.</td>
              //   <td>12/19/2018</td>
              //   <td>No</td>
              //   <td>Sensory</td>
              //   <td><img src="pages/assets/eye.png"></td>
              //   <td><img src="pages/assets/download.png"></td>
              //   <td><img src="pages/assets/share.png"></td>
              // </tr>
              echo '
            </table>
        </div>';
?>
    </body>
</html>
