<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>FitBuds Registration</title>
        <meta name="description" content="The register page of FitBuds">
        <link rel="stylesheet" href="pages/assets/main.css">
    </head>
    <body>

<?php
	require 'setup.php';
	if (isset($_SESSION['usernamev3'])) { //Person is already logged in
		header('Location: member.php');
		exit("You are already logged in. Redirecting to member page..."); //Automatically closes MySQL connection and sends to logged in page
	}
	if (isset($_POST["register"]) and fieldExist()) {
		//Checks if user already exists
		$checkUser =  mysqli_prepare($databaseSQL, "SELECT Email FROM users WHERE Email=?;");
		mysqli_stmt_bind_param($checkUser, 's', $name);

		$name = $_POST["username"]; //Grabs name and password entered from POST
		$password = $_POST["passwrd"];
    $actualname = $_POST["firstandlastname"];
    $city = $_POST["city"];
    $state = $_POST["state"];
		mysqli_stmt_execute($checkUser); //System of prepared execution prevents SQL Injection
		$result = mysqli_stmt_get_result($checkUser);
    $resultArray = [];
    $arraySerial = serialize($resultArray);

		if (!mysqli_num_rows($result)) { //Only creates user if query SELECT returns no rows (so username is not in use)
			$checkUser =  mysqli_prepare($databaseSQL, "INSERT INTO users (Email, Password, Name, City, State, Results) VALUES (?,?,?,?,?,?)");
			mysqli_stmt_bind_param($checkUser, 'ssssss', $name, $password, $actualname, $city, $state, $arraySerial);

			$name = $_POST["username"]; //Grabs name and password entered from POST after page redirect from home.html on submit
			$password = password_hash($_POST["passwrd"], PASSWORD_DEFAULT);

      mysqli_stmt_execute($checkUser); //Prevents SQL Injection?

			echo "Account created with username/email {$name}.";
			echo '<br><button onClick="javascript:window.location.href=\'login.php\'">Take me to login!</button>';
		} else {
			echo "Username already in use.";
			echo '<br><button onClick="javascript:window.location.href=\'register.php\'">Try again!</button>';
		}
		mysqli_stmt_free_result($checkUser);
		mysqli_stmt_close($checkUser);
	} else { // Form generation if submit has not been pressed
		// echo '<!DOCTYPE HTML>
		// <html>
		// <head><meta charset="utf-8">
		// <title>David Frankel\'s Fancy Login Page</title>
		// <meta name="description" content="Less basic login!">
		// <meta name="author" content="David Frankel"></head>
		// <body>';
		// echo '<form action="register.php" method="post">
		// 	Username: <input type="text" name="username" required><br>
		// 	Password: <input type="password" name="passwrd" required><br>
		// 	<input type="submit" value="Register" name="register">
		// 	</form>';

      echo '<div align = "center">
  		<br />
  		<br />
  		<br />
  		<h1> FitBuds Registration </h1>
  		<h3> Sign up for your free, personal fitness buddy </h3>
  <section class = "registerme">

  <form name = "register" action = "register.php" method = "post">

  		<ul>
  				<li> <label for = "firstandlastname"> Name </label>
  						<input type = "firstandlastname" name = "firstandlastname" > </li>
  				<br />
  				<li> <label for = "city"> City </label>
  				<input type = "city" name = "city" placeholder = "city" >
  				<label for = "state"> State </label>
  				<select name="state">
  <option value="">   </option>
  <option value="AL">AL</option>
  <option value="AK">AK</option>
  <option value="AR">AR</option>
  <option value="AZ">AZ</option>
  <option value="CA">CA</option>
  <option value="CO">CO</option>
  <option value="CT">CT</option>
  <option value="DC">DC</option>
  <option value="DE">DE</option>
  <option value="FL">FL</option>
  <option value="GA">GA</option>
  <option value="HI">HI</option>
  <option value="IA">IA</option>
  <option value="ID">ID</option>
  <option value="IL">IL</option>
  <option value="IN">IN</option>
  <option value="KS">KS</option>
  <option value="KY">KY</option>
  <option value="LA">LA</option>
  <option value="MA">MA</option>
  <option value="MD">MD</option>
  <option value="ME">ME</option>
  <option value="MI">MI</option>
  <option value="MN">MN</option>
  <option value="MO">MO</option>
  <option value="MS">MS</option>
  <option value="MT">MT</option>
  <option value="NC">NC</option>
  <option value="NE">NE</option>
  <option value="NH">NH</option>
  <option value="NJ">NJ</option>
  <option value="NM">NM</option>
  <option value="NV">NV</option>
  <option value="NY">NY</option>
  <option value="ND">ND</option>
  <option value="OH">OH</option>
  <option value="OK">OK</option>
  <option value="OR">OR</option>
  <option value="PA">PA</option>
  <option value="RI">RI</option>
  <option value="SC">SC</option>
  <option value="SD">SD</option>
  <option value="TN">TN</option>
  <option value="TX">TX</option>
  <option value="UT">UT</option>
  <option value="VT">VT</option>
  <option value="VA">VA</option>
  <option value="WA">WA</option>
  <option value="WI">WI</option>
  <option value="WV">WV</option>
  <option value="WY">WY</option>
  </select>
  </li>
  				<br />
  				<li> <label for = "usermail"> Email </label>
  						<input type = "email" name = "username" placeholder = "name@example.com" > </li>
  				<br />
  				<div id = "passwordError"></div>
  			 <li> <label for = "password"> Password </label>
  				<input type = "password" name = "passwrd" placeholder = "Password" id="password" > </li>
  				<br />

  				<li> <label for = "confirmpassword"> Confirm Password </label>
  				<input type = "password" name = "passwrd" placeholder = "Confirm Password" id = "confirmPassword" > </li>
  				<br />

  				<li> <input type="submit" value="Register" name="register"> </li>
  				</ul>
          </form>
  		 </section>
  		</div>
';

		echo '<form action="login.php">I already have an account.<input type="submit" value="Take me to login!" /></form>';
	}

	mysqli_close($databaseSQL); //Closes socket to MySQL! Important!

	function fieldExist() {
		if ($_POST["username"] !== "" and $_POST["passwrd"] !== "") {
			return true;
		} else {
			echo "You did not enter anything. Try again.";
			return false;
		}
	}
?>

</body>
</html>
