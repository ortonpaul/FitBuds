<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Nutrition Quiz</title>
        <meta name="description" content="One of the quizzes on FitBuds.">
        <link rel="stylesheet" href="pages/assets/main.css">
    </head>
    <?php
    require 'setup.php';
    if (empty($_SESSION['usernamev3'])) {
      header('Location: login.php');
      exit("You are not logged in. Redirecting..."); //Kicks off and automatically closes MySQL connection
    }
    $username = htmlentities($_SESSION['usernamev3']);
    // echo "<p>Welcome to the logged in area, {$username}!</p>";
  if(isset($_POST["nutritionquiz"])) {
    $sum = 0;
    for ($i=0; $i<count($_POST)-1; $i++) {
      $sum = $sum + intval($_POST['q'.$i]);
    }
    $resultArray = [];
    $checkUser =  mysqli_prepare($databaseSQL, "SELECT Results FROM users WHERE Email=?;");
    mysqli_stmt_bind_param($checkUser, 's', $username);
    mysqli_stmt_execute($checkUser);
    if ($result = mysqli_stmt_get_result($checkUser)) {	// echo "<p>Welcome to the logged in area, {$username}!</p>";
      if ($row = mysqli_fetch_row($result)) {
        $resultArray = unserialize($row[0]);
      }
    }
    $resultAppend = ["type" => "Nutrition Quiz", "score" => $sum];
    $resultArray[time()] = $resultAppend;
    $resultArraySerial = serialize($resultArray);
    //$data = json_decode($json);
    $updateResults =  mysqli_prepare($databaseSQL, "UPDATE users SET Results=? WHERE Email=?");

    mysqli_stmt_bind_param($updateResults, 'ss', $resultArraySerial, $username);

    mysqli_stmt_execute($updateResults);

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
        <h2>Quiz completed.</h2>
        <h3>Your score is: '.$sum.'</h3>
        </div>';
  } else {
    echo '
    <body>
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
        <h2>Nutrition Quiz</h2>
        <h3>Please select the answer that best describes you.</h3>

        <form name = "nutritionquiz" action = "nutritionquiz.php" method = "post" style="padding-left: 40px;">

        1. Do you eat a lot of red meat? <br>
            <input type = "radio" value = "1" name = "q1"> Yes <br>
            <input type = "radio" value = "2" name = "q1"> No <br>
            <br>
        2. On average, how often do you eat vegetables? <br>
            <input type = "radio" value = "0" name = "q2"> Never <br>
            <input type = "radio" value = "1" name = "q2"> Monthly <br>
            <input type = "radio" value = "2" name = "q2"> Weekly <br>
            <input type = "radio" value = "4" name = "q2"> Daily <br>
        <br>
        3. On average, how often do you eat junk food? <br>
            <input type = "radio" value = "4" name = "q3"> Never <br>
            <input type = "radio" value = "3" name = "q3"> Monthly <br>
            <input type = "radio" value = "2" name = "q3"> Weekly <br>
            <input type = "radio" value = "0" name = "q3"> Daily <br>
        <br>
        4. Do you eat food with high nutritional value? <br>
            <input type = "radio" value = "3" name = "q4"> Yes <br>
            <input type = "radio" value = "0" name = "q4"> No <br>
        <br>
        5. Do you keep a count of caloric intake? <br>
            <input type = "radio" value = "2" name = "q5"> Yes <br>
            <input type = "radio" value = "0" name = "q5"> No <br>
        <br>
        6. How often do you drink soda? <br>
              <input type = "radio" value = "5" name = "q6"> Never <br>
            <input type = "radio" value = "3" name = "q6"> Monthly <br>
            <input type = "radio" value = "2" name = "q6"> Weekly <br>
            <input type = "radio" value = "0" name = "q6"> Daily <br>
        <br>
            <input type = "submit" name="nutritionquiz" value = "Submit">

            </form>
            </div>';
    }
    ?>
        </body>
    </html>
