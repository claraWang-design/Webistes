<?php

require 'config/config.php';

//var_dump($_POST);

if ( !isset($_POST['email']) || empty($_POST['email'])
	|| !isset($_POST['username']) || empty($_POST['username'])
	|| !isset($_POST['password']) || empty($_POST['password'])
	|| !isset($_POST['fav']) || empty($_POST['fav'])
	|| !isset($_POST['motto']) || empty($_POST['motto']) ) {
	$error = "Please fill out all required fields.";
}
else {
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}

	$sql_registered = "SELECT * FROM users
	WHERE username = '" . $_POST["username"] . "' OR email = '" . $_POST["email"] . "';";

	//echo "<hr>" . $sql_registered . "<hr>";

	$results_registered = $mysqli->query($sql_registered);
	if (!$results_registered) {
		echo $mysqli->error;
		exit();
	}

	//var_dump($results_registered);

	if($results_registered->num_rows > 0) {
		$error = "Username or email address is already taken. Please try again.";
	}

	else {
		$password_new = hash("sha256", $_POST["password"]);

		//var_dump($password_new);

		$sql = "INSERT INTO users(username, email, password, fav, motto) VALUES('" . $_POST["username"] . "','" . $_POST["email"]. "','" . $password_new . "','" . $_POST["fav"] . "','" . $_POST["motto"] . "');";

		//echo "<hr>" . $sql . "<hr>";

		$results = $mysqli->query($sql);
		if(!$results) {
			echo $mysqli->error;
			exit();
		}
	}

	$mysqli->close();
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up Confirmation</title>
	<link rel="stylesheet" href="home.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
	<?php include 'nav.php';?>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Sign Up</h1>
		</div> 
	</div>

	<div class="container">

		<div class="row mt-4">
			<div class="col-12">
				<?php if ( isset($error) && !empty($error) ) : ?>
					<div class="text-danger"><?php echo $error; ?></div>
				<?php else : ?>
					<div class="text-success"><?php echo $_POST['username']; ?> was successfully registered.</div>
				<?php endif; ?>
		</div> 
	</div> 

	<div class="row mt-4 mb-4">
		<div class="col-12">
			<a href="login.php" role="button" class="btn btn-dark">Login</a>
			<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" role="button" class="btn btn-outline-dark">Back</a>
		</div> 
	</div> 

</div> 

</body>
</html>