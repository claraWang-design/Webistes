<?php

require 'config/config.php';

if( !isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) {	

	if ( isset($_POST['username']) && isset($_POST['password']) ) {

		if ( empty($_POST['username']) || empty($_POST['password']) ) {

			$error = "Please enter username and password.";

		}
		else {
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			if($mysqli->connect_errno) {
				echo $mysqli->connect_error;
				exit();
			}

			$passwordInput = hash("sha256", $_POST['password']);

			$sql = "SELECT * FROM users
						WHERE username = '" . $_POST['username'] . "' AND password = '" . $passwordInput . "';";

			//echo "<hr>" . $sql . "<hr>";
			
			$results = $mysqli->query($sql);

			if(!$results) {
				echo $mysqli->error;
				exit();
			}

			if($results->num_rows > 0) {
				$row = $results->fetch_assoc();
				$_SESSION["username"] = $_POST["username"];
				$_SESSION["fav"] = $row["fav"];
				$_SESSION["motto"] = $row["motto"];
				$_SESSION["user_id"] = $row["user_id"];
				$_SESSION["logged_in"] = true;

				header("Location: home.php");

			}
			else {
				$error = "Invalid username or password.";
			}
		} 
	}
}
else {
	header("Location: home.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" href="home.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
	<?php include 'nav.php'; ?>

	<div class="container">

		<form action="login.php" method="POST">
			
			<div class="row justify-content-center">

			<div class="col-sm-5">
				<div class="row">
			<h1 class="col-9 mt-4 mb-4">Login</h1>
		</div> 
		<div class="row mb-3">
				<div class="font-italic text-danger col-sm-9 ml-sm-auto">

					<?php
						if ( isset($error) && !empty($error) ) {
							echo $error;
						}
					?>
				</div>
			</div> 
			<div class="form-group row-9">
				<label for="username-id" class="col-sm-3 col-form-label text-sm-right">Username:</label>
				<input type="text" class="form-control" id="username-id" name="username">
			</div> 

			<div class="form-group row-9 mb-5">
				<label for="password-id" class="col-sm-3 col-form-label text-sm-right">Password:</label>
				<input type="password" class="form-control" id="password-id" name="password">
			</div> 

			<div class="form-group row-9 gap-2 mb-3">
				<div class="d-grid gap-2">
					<button type="submit" class="btn btn-dark">Login</button>
					<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" role="button" class="btn btn-outline-dark">Cancel</a>
				</div>
			</div>

			<div class="row">
			<div class="col-sm-9 ml-sm-auto">
				<a href="signup.php">Create an account</a>
			</div>
		</div> 
			</div>
		</div>
		</form>
		</div>


	</div> 
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>