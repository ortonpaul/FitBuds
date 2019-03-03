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
    $checkUser = mysqli_prepare($databaseSQL, "SELECT Name, City, State, Results FROM users WHERE Email=?;");
    mysqli_stmt_bind_param($checkUser, 's', $username);

    mysqli_stmt_execute($checkUser);
    if ($result = mysqli_stmt_get_result($checkUser)) {	// echo "<p>Welcome to the logged in area, {$username}!</p>";
      if ($row = mysqli_fetch_row($result)) {
        $name = $row[0];
        $city = $row[1];
        $state = $row[2];
        $resultArray = unserialize($row[3]);
      }
  }

  $minType = "More data needed";
  if (count($resultArray) > 2) {
    $minTypeVal = 50;
    foreach ($resultArray as $value) {
      if ($minTypeVal > $value["score"]) {
        $minTypeVal = $value["score"];
        $minType = $value["type"];
      }
    }
  }

  switch($minType){
    case "Cognitive Quiz 1":
        $minType = "Try to do more mental exercises (like Soduku).";
        break;
    case "Cognitive Quiz 2":
        $minType = "Talk to a doctor.";
        break;
    case "Nutrition Quiz":
        $minType = "Try to find a buddy and pledge to improve nutritional choices.";
        break;
    case "Vitals Quiz":
        $minType = "Try swimming to improve cardiovascular health.";
        break;
    case "Fitness":
        $minType = "Try yoga to improve your balance.";
        break;
    default:
        $minType = "Not enough data.";
        break;
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
            <li><a href="logout.php">Logout</a></li>
        </ul>
        <div class="callout">
            <div class="column" style="cursor:pointer;">
                <ul id="brain">
                    <li onclick="location.href = \'past-results.php\';">Cognitive Health</li>
                </ul>
                <ul id="heart">
                    <li onclick="location.href = \'past-results.php\';">Vital Information</li>
                </ul>
                <ul id="weight">
                    <li onclick="location.href = \'past-results.php\';">Physical Strength</li>
                </ul>
                <ul id="apple">
                    <li onclick="location.href = \'past-results.php\';">Nutritional Data</li>
                </ul>
                <ul id="analysis">
                    <li onclick="location.href = \'resources.php?resource=fitness\';">Smart Recommendation:
                    <br/><span style="padding-left: 85px; display: block;">'.$minType.'</span></li>
                </ul>
            </div>
            <div class="column" id="profile">
                <img src="pages/assets/profile.png" style="display: block; margin-left: auto; margin-right: auto; width: 30%">
                <h3>' . $name . '</h3>
                <h4>'.$city.', '.$state.'</h4>
            </div>
        </div>';
?>
    </body>
</html>
