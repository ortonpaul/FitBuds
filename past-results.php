<!DOCTYPE html>
<html>
    <head>
        <title>Past Results</title>
        <link rel="stylesheet" href="pages/assets/main.css">
        <link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet">
        <script>
        function deleteItem(user, timestamp) {
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              var element = document.getElementById(timestamp);
              element.parentNode.removeChild(element);
            }
          };
          xhttp.open("GET", "delete.php?email=" + user + "&timestamp=" + timestamp, true);
          xhttp.send();
        }
        function openItem(user, timestamp) {
          window.open("view.php?email=" + user + "&timestamp=" + timestamp, '_blank');
        }
        </script>
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
                <th>Date</th>
                <th>Type</th>
                <th>View</th>
                <th>Delete</th>
              </tr>';
              foreach (array_reverse($resultArray, TRUE) as $key => $value) {
                echo '<tr id="'.$key.'">
                  <td>'.date('n/j/y g:ia', $key).'</td>
                  <td>'.$value["type"].'</td>
                  <td><img onclick="openItem(\''.$username.'\','.$key.');" src="pages/assets/eye.png"></td>
                  <td><img onclick="deleteItem(\''.$username.'\','.$key.');" src="pages/assets/trash.png"></td>
                </tr>';
              }
              echo '
            </table>
        </div>';
?>
    </body>
</html>
