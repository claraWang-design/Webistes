<?php

require 'config/config.php';

$isDeleted = false;


if ( !isset($_GET['diary_id']) || empty($_GET['diary_id']) 
		|| !isset($_GET['title']) || empty($_GET['title']) ) {
	$error = "Invalid Diary.";
}
else {
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if( $mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}

	$statement = $mysqli->prepare("DELETE FROM diarys WHERE diary_id = ?");
	$statement->bind_param("i", $_GET["diary_id"]);

	$executed = $statement->execute();
	if(!$executed) {
		echo $mysqli->error;
		exit();
	}

	if($statement->affected_rows == 1) {
		$isDeleted = true;
	}

	$statement->close();

	$mysqli->close();

}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Delete Diary</title>
	<link rel="stylesheet" href="home.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
	<?php include 'nav.php';?>

	<div class="container">
		<div class="row mt-4">
			<div class="col-12">
				<h1 class="col-12 mt-4">Delete A Diary</h1>

				<?php if ( isset($error) && !empty($error) ) : ?>
					<div class="text-danger">
						<?php echo $error; ?>
					</div>
				<?php endif; ?>

				<?php if ( $isDeleted ) :?>
					<div class="text-success"><span class="font-italic"><?php echo $_GET["title"]; ?></span> was successfully deleted.</div>
				<?php endif; ?>

			</div>
		</div> 
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="diary.php" role="button" class="btn btn-dark">Back to Your Diary</a>
			</div> 
		</div> 
	</div> 
</body>
</html>