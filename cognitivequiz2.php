<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Cognitive Quiz 2 </title>
        <meta name="description" content="One of the cognitive quizzes on FitBuds.">
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
  if(isset($_POST["cognitivequiz2"])) {
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
    $resultAppend = ["type" => "cognitivequiz2", "score" => $sum];
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
        <h2>Cognitive Quiz 2</h2>
        <h3>Please select the answer that best describes you.</h3>

        <form name = "cognitivequiz2" action = "cognitivequiz2.php" method = "post" style="padding-left: 40px;">

        1. On average, how many hours of sleep do you get each night?<br>
            <input type = "radio" value = "0" name = "q1"> 0-4 hours<br>
            <input type = "radio" value = "2" name = "q1"> 5-8 hours <br>
            <input type = "radio" value = "4" name = "q1"> 9 or more hours <br>
            <br>
        2. On average, how much exercise do you get per week? <br>
            <input type = "radio" value = "0" name = "q2"> 0-30 minutes <br>
            <input type = "radio" value = "1" name = "q2"> 30 minutes-1 hour <br>
            <input type = "radio" value = "2" name = "q2"> 1-2 hours <br>
            <input type = "radio" value = "3" name = "q2"> 2-3 hours <br>
            <input type = "radio" value = "5" name = "q2"> 4 hours or more <br>
        <br>
        3. Do you ever wake up confused in the morning? <br>
             <input type = "radio" value = "0" name = "q3"> Yes <br>
            <input type = "radio" value = "2" name = "q3"> No <br>
        <br>
        4. Does music help you remember events, places or people? <br>
            <input type = "radio" value = "0" name = "q4"> Yes <br>
            <input type = "radio" value = "2" name = "q4"> No <br>
        <br>
        5. Do you struggle with focusing? <br>
            <input type = "radio" value = "0" name = "q5"> Yes <br>
            <input type = "radio" value = "2" name = "q5"> No <br>
        <br>
        6. Do you find conversations hard to follow? <br>
            <input type = "radio" value = "0" name = "q6"> Yes <br>
            <input type = "radio" value = "2" name = "q6"> No <br>
        <br>
            <input type = "submit" name="cognitivequiz2" value = "Submit">

        </form>
        </div>';
}
?>
    </body>
</html>
