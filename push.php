<?php
require 'setup.php';
if(isset($_GET["email"])) {
				$email = htmlspecialchars($_GET["email"]);
				$entityBody = json_decode(file_get_contents('php://input'));
				$resultArray = [];
				$checkUser =  mysqli_prepare($databaseSQL, "SELECT Results FROM users WHERE Email=?;");
				mysqli_stmt_bind_param($checkUser, 's', $email);
				mysqli_stmt_execute($checkUser);
				if ($result = mysqli_stmt_get_result($checkUser)) {	// echo "<p>Welcome to the logged in area, {$username}!</p>";
			    if ($row = mysqli_fetch_row($result)) {
			      $resultArray = unserialize($row[0]);
			    }
				}
				$score = ($entityBody->narrow + $entityBody->backwards + $entityBody->pivot) * 6 / 3;
				$resultAppend = ["type" => "fitness", "score" => $score];
				$resultArray[time()] = $resultAppend;
				$resultArraySerial = serialize($resultArray);
				//$data = json_decode($json);
        $updateResults =  mysqli_prepare($databaseSQL, "UPDATE users SET Results=? WHERE Email=?");

        mysqli_stmt_bind_param($updateResults, 'ss', $resultArraySerial, $email);

        mysqli_stmt_execute($updateResults);
    } else {
        echo "hi";
    }
