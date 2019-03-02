<?php
require 'setup.php';
if(isset($_GET["email"])) {
				$email = htmlspecialchars($_GET["email"]);
				$entityBody = serialize(json_decode(file_get_contents('php://input')));

				//$data = json_decode($json);
        $updateResults =  mysqli_prepare($databaseSQL, "UPDATE users SET Results=?  WHERE Email=?");

        mysqli_stmt_bind_param($updateResults, 'ss', $entityBody, $email);

        mysqli_stmt_execute($updateResults);
    } else {
        echo "hi";
    }
