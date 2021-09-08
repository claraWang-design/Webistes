<?php

	require "config/config.php";

	//var_dump($_POST);

	$isUpdated = false;

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	if ( isset($_POST['fav']) && !empty($_POST['fav']) ) {
		$fav = $_POST['fav'];
	} else {
		$fav = null;
	}

	if ( isset($_POST['motto']) && !empty($_POST['motto']) ) {
		$motto = $_POST['motto'];
	} else {
		$motto = null;
	}

	$statement = $mysqli->prepare("UPDATE users SET fav = ?, motto = ? WHERE user_id = ?");

	$statement->bind_param("ssi", $fav, $motto, $_POST["user_id"]);

	$executed = $statement->execute();
	if(!$executed) {
		echo $mysqli->error;
	}
	else{
		$isUpdated = true;
		$_SESSION["fav"] = $_POST["fav"];
		$_SESSION["motto"] = $_POST["motto"];
	}

	$statement->close();


	$mysqli->close();

	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Profile Confirmation</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="home.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
	<?php include 'nav.php';?>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Edit Your Profile</h1>
		</div> 
	</div>
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

				<?php if ( isset($error) && !empty($error) ) : ?>
					<div class="text-danger">
						<?php echo $error; ?>
					</div>
				<?php endif; ?>

				<?php if ($isUpdated) : ?>
					<div class="text-success">
						Your profile was successfully edited.
					</div>
				<?php endif; ?>

			</div> 
		</div> 
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="diary.php" role="button" class="btn btn-dark">Back to Diary</a>
			</div> 
		</div> 
	</div> 
</body>
</html>