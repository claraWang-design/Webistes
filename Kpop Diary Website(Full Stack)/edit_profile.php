<?php

require 'config/config.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


if( $mysqli->connect_errno) {
	echo $mysqli->connect_error;
	exit();
}
$sql = "SELECT * FROM users
	WHERE user_id = " . $_GET["user_id"] . ";";

$results = $mysqli->query($sql);
if(!$results) {
	echo $mysqli->error;
	exit();
} 

$row = $results->fetch_assoc();
//var_dump($row);

$sql = "SELECT * FROM users;";

$results = $mysqli->query($sql);
if(!$results ) {
	echo $mysqli->error;
	exit();
}

$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Profile</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="home.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
	<style>
		.form-check-label {
			padding-top: calc(.5rem - 1px * 2);
			padding-bottom: calc(.5rem - 1px * 2);
			margin-bottom: 0;
		}
	</style>
</head>
<body>
	<?php include 'nav.php';?>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Edit Your Profle</h1>
		</div> 
	</div> 

	<div class="container">

			<?php if ( isset($error) && !empty($error) ) : ?>

					<div class="text-danger">
						<?php echo $error; ?>
					</div>

			<?php endif; ?>

			<form action="edit_profile_confirmation.php" method="POST">

				<div class="form-group row">
					<label for="username-id" class="col-sm-3 col-form-label text-sm-right">Username: </label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="username-id" name="username" value="<?php echo $row['username']; ?>" disabled>
					</div>
				</div> 

				<div class="form-group row">
					<label for="email-id" class="col-sm-3 col-form-label text-sm-right">Email: </label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="email-id" name="email" value="<?php echo $row['email']; ?>" disabled>
					</div>
				</div> 

				<div class="form-group row">
					<label for="fav-id" class="col-sm-3 col-form-label text-sm-right">Favorite Idol: </label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="fav-id" name="fav" value="<?php echo $row['fav']; ?>">
					</div>
				</div> 

				<div class="form-group row">
					<label for="motto-id" class="col-sm-3 col-form-label text-sm-right">Motto: </label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="motto-id" name="motto" value="<?php echo $row['motto']; ?>">
					</div>
				</div> 


				<input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>">

				<div class="form-group row">
					<div class="col-sm-3"></div>
					<div class="col-sm-9 mt-2">
						<button type="submit" class="btn btn-dark">Submit</button>
						<button type="reset" class="btn btn-outline-dark">Reset</button>
					</div>
				</div> 

			</form>

	</div>
</body>
</html>