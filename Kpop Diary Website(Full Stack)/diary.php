<?php

require 'config/config.php';

if ( !isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"] ) {
    $error = "<br><h1>Please log in first to access your diary!<h1>";
}
else{

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


if( $mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
}


$sql = "SELECT * FROM users
JOIN diarys
ON users.user_id = diarys.users_user_id
WHERE user_id =" . $_SESSION["user_id"].";";

//echo "<hr>" . $sql;

$results = $mysqli->query($sql);
if(!$results) {
    echo $mysqli->error;
    exit();
}

$mysqli->close();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Diary</title>
	<link rel="stylesheet" href="diary.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'nav.php';?>

<div class="container">
	<?php if( !isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"] ): ?>
				<?php echo $error; ?>
			<?php else: ?>
	<div class="row">
		<div class="col-lg-3 col-md-4">
			<br><br><br>
				<h3><?php echo $_SESSION["username"]; ?></h3>
				<br>
				<b>Favorite Idol:</b><p><?php echo $_SESSION["fav"]; ?></p>
				<strong>Motto:</strong><p><?php echo $_SESSION["motto"]; ?></p>
				<div>
				<a href="edit_profile.php?user_id=<?php echo $_SESSION['user_id']; ?>" class="btn btn-dark">Edit Profile</a>
			</div> 
			<br>
			<br>
		</div>

		<div class="col-lg-6 col-md-8 middle">
			<form class="row g-3" action="diary_confirmation.php" method="POST">
              <div class="col-md-6">
                <label for="inputEmail" class="form-label">Title</label>
                <input name="title" type="input" class="form-control" id="inputEmail">
              </div>
              <div class="col-md-6">
                <label for="inputPassword" class="form-label">Date</label>
                <input name="date" type="date" class="form-control" id="inputPassword">
              </div>
              <div class="col-12">
                <label for="diaryTextarea" class="form-label">Diary</label>
                <textarea name="diary" type="text" class="form-control" id="diaryTextarea" placeholder="Put down your thoughts"></textarea>
              </div>
              <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-dark">Add Diary</button>
              </div>
            </form>

			<br>
			<br>

            <h4>Your Diary List</h4>

<?php while( $row = $results->fetch_assoc()): ?>
<br>
<div class="card w-100" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"><?php echo $row['title']; ?></h5>
    <h6 class="card-subtitle text-muted"><?php echo $row['date']; ?></h6>
    <p class="card-text"><?php echo $row['diary']; ?></p>

    <a onclick="return confirm('You are about to delete diary <?php echo $row['title']?>.');" href="delete.php?diary_id=<?php echo $row['diary_id']; ?>&title=<?php echo $row['title']?>" class="btn btn-outline-danger delete-btn">Delete</a>

  </div>
</div>
<?php endwhile;?> 

		</div>
		<div class="col-lg-3 col-md-6 ">

			<br>
			<br>
			<br>
			<br>
			<h4>"Memory... is the diary that we all carry about with us." <br>-- Oscar Wilde</h4>
		</div>
	</div>
</div>
<?php endif;?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>