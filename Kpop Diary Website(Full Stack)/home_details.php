<?php

//var_dump($_GET);

if(!isset($_GET["id"]) || empty($_GET["id"])) {
    $error = "Invalid track";
}
else {
    require 'config/config.php';

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if( $mysqli->connect_error) {
        echo $mysqli->connect_error;
        exit();
    }

    $mysqli->set_charset('utf8');

    $sql = "SELECT kname, fullName, idols.group, birthplace, dob
    FROM idols 
    WHERE id = " . $_GET["id"] . ";";

    //echo "<hr>" . $sql . "<hr>";

    $results = $mysqli->query($sql);
    if(!$results) {
        echo $mysqli->error;
        exit();
    }

    $row = $results->fetch_assoc();

    //var_dump($row);

    $mysqli->close();
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>

	<link rel="stylesheet" href="home.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>

    <?php include 'nav.php';?>


<div class="container">
    <div class="row mt-4 justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-4">

<?php if( isset($error) && !empty($error) ): ?>

    <div class="text-danger">
        <?php echo $error; ?>
    </div>

<?php else: ?>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">
        <strong>Artist: </strong>
        <?php echo $row['kname']; ?></li>
      <li class="list-group-item">
        <strong>Full Name: </strong>
        <?php echo $row['fullName']; ?></li>
      <li class="list-group-item">
        <strong>Group: </strong><?php echo $row['group']; ?></li>
      <li class="list-group-item">
        <strong>Birth Place: </strong><?php echo $row['birthplace']; ?></li>
      <li class="list-group-item">
        <strong>Date of Birth: </strong><?php echo $row['dob']; ?></li>
    </ul>

<?php endif; ?>

            </div> 
        </div> 
    	
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>