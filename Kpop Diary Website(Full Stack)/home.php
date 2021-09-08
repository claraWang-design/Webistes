<?php


require 'config/config.php';
//var_dump($_SESSION);

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


if( $mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
}


$sql = "SELECT * FROM idols;";


$results = $mysqli->query($sql);
if(!$results) {
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
	<title>Home</title>

	<link rel="stylesheet" href="home.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body id="homeback">

    <?php include 'nav.php';?>

<div class="container" id="boxs">
    <div id="ball"></div>
    	<div class="row inner-row1">
    		<div class="up-text">
    		Find Out Something About Kpop
    		<br><br>
    		<form class="d-flex" action="home_results.php" method="GET">
      <input class="form-control me-2 " type="search" name="idol_name" placeholder="Type anything..." aria-label="Search">
      <button class="btn btn-outline-light" type="submit">Search</button>
    </form>
    		</div>
    	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>