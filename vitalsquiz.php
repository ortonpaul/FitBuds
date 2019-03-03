<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Vitals Quiz</title>
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
  if(isset($_POST["vitalsquiz"])) {
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
    $resultAppend = ["type" => "Vitals Quiz", "score" => $sum];
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
        <h2>Vitals Quiz</h2>
        <h3>Please select the answer that best describes you.</h3>

        <form name = "vitalsquiz" action = "vitalsquiz.php" method = "post" style="padding-left: 40px;">

        1. Do you have trouble breathing? <br>
            <input type = "radio" value = "yes" name = "q1"> Yes <br>
            <input type = "radio" value = "no" name = "q1"> No <br>
            <br>
        2. What is your normal blood pressure range? <br>
           <input type = "radio" value = "low" name = "q2"> Low <br>
            <input type = "radio" value = "ideal" name = "q2"> Ideal <br>
            <input type = "radio" value = "high" name = "q2"> High <br>
        <br>
        3. Do you have heart troubles? <br>
           <input type = "radio" value = "yes" name = "q3"> Yes <br>
            <input type = "radio" value = "no" name = "q3"> No <br>
        <br>
            <input type = "submit" name="vitalsquiz" value = "Submit">

            </form>
            </div>';
    }
    ?>
        </body>
    </html>
