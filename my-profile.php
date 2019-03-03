<!DOCTYPE html>
<html>
    <head>
        <title>My Profile</title>
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
    $checkUser = mysqli_prepare($databaseSQL, "SELECT Name FROM users WHERE Email=?;");
    mysqli_stmt_bind_param($checkUser, 's', $username);

    mysqli_stmt_execute($checkUser);
    if ($result = mysqli_stmt_get_result($checkUser)) {	// echo "<p>Welcome to the logged in area, {$username}!</p>";
      if ($row = mysqli_fetch_row($result)) {
        $name = $row[0];
      }
  }
    echo '    <body>
        <div class="homeIcon">
            <a href="member.php"><img src="pages/assets/home.png" alt="home"></a>
        </div>
        <ul class="navbar">
            <li><a href="diagnostics.php">Diagnostics</a></li>
            <li><a href="past-results.php">Past Results</a></li>
            <li><a href="my-profile.php" id="selected">My Profile</a></li>
            <li><a href="resources.php">Resources</a></li>
        </ul>
        <div>
        <div class="callout">
            <div class="column">
                <ul id="brain">
                    <li>Cognitive Health</li>
                </ul>
                <ul id="eye">
                    <li>Sensory Health</li>
                </ul>
                <ul id="heart">
                    <li>Vital Information</li>
                </ul>
                <ul id="weight">
                    <li>Physical Strength</li>
                </ul>
                <ul id="apple">
                    <li>Nutritional Data</li>
                </ul>
            </div>
            <div class="column" id="profile">
                <img src="pages/assets/profile.png" style="display: block; margin-left: auto; margin-right: auto; width: 30%">
                <h3>' . $name . '</h3>
                <h4>Age 64</h4>
                <h4>Rolla, MO</h4>
            </div>
        </div>';
?>
    </body>
</html>
