<?php
require 'setup.php';
if (empty($_SESSION['usernamev3'])) {
  header('Location: login.php');
  exit("You are not logged in. Redirecting..."); //Kicks off and automatically closes MySQL connection
}
$username = htmlentities($_SESSION['usernamev3']);
if(isset($_GET["email"]) and isset($_GET["timestamp"])) {
				$email = htmlspecialchars($_GET["email"]);
        if ($email != $username) {
          exit("You don't have permission for that!");
        }
				$timestamp = htmlspecialchars($_GET["timestamp"]);
				$resultArray = [];
				$checkUser =  mysqli_prepare($databaseSQL, "SELECT Results FROM users WHERE Email=?;");
				mysqli_stmt_bind_param($checkUser, 's', $email);
				mysqli_stmt_execute($checkUser);
				if ($result = mysqli_stmt_get_result($checkUser)) {	// echo "<p>Welcome to the logged in area, {$username}!</p>";
			    if ($row = mysqli_fetch_row($result)) {
			      $resultArray = unserialize($row[0]);
			    }
				}
				unset($resultArray[$timestamp]);
				$resultArraySerial = serialize($resultArray);
				//$data = json_decode($json);
        $updateResults =  mysqli_prepare($databaseSQL, "UPDATE users SET Results=? WHERE Email=?");

        mysqli_stmt_bind_param($updateResults, 'ss', $resultArraySerial, $email);

        mysqli_stmt_execute($updateResults);
    } else {
        echo "hi";
    }
