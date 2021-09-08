<?php

require 'config/config.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


if( $mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
}


$sql = "SELECT * FROM idols";

if( isset($_GET["idol_name"]) && !empty($_GET["idol_name"])) {
    $sql = $sql . " WHERE kname LIKE '%" . $_GET["idol_name"] . "%'";
}

$sql = $sql . ";";

//echo "<hr>" . $sql;

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
<body>

    <?php include 'nav.php';?>

<br>
<div class="container">
    <div class="row">
        <h1>Here are the results that we could find for you</h1>
    </div>
    <div class="row">
            <div class="col-12">

                Showing
                <?php
                echo mysqli_num_rows($results);
                ?>
                result(s).

            </div>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3   g-3">

        <?php while( $row = $results->fetch_assoc()): ?>
            <div class="col">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body mb-3">
                            <h5 class="card-title"><?php echo $row['kname']; ?></h5>
                            <p class="card-text"><?php echo $row['group']; ?>  </p>
                            <a href="home_details.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-dark">More</a>
                        </div>
                    </div>
</div>
        <?php endwhile;?>
            </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>