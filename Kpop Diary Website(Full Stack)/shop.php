<?php
require 'config/config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Events</title>
	<link rel="stylesheet" href="shop.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
	<?php include 'nav.php';?>
	
	<div class="container">
		<div class="row row1">
			<div class="top-text">
			<h1>Stariary Partnered with Ticketmaster</h1>
			<h4>To find the events you are interested of!</h4>
			</div>
		</div>
			<div class=" column2">
				<div class="row midrow">
	

	<form class="d-flex" id="search-form">
      <input class="form-control me-2 " type="search" placeholder="Find the events you're interested in..." id="search-id">
      <button class="btn btn-outline-dark" type="submit">Search</button>
    </form>
				</div>
				<div class="row displayrow">
				</div>
			</div>
		</div>
	</div>
<script src="main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>