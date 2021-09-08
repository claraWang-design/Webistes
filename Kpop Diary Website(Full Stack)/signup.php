<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up</title>
	<link rel="stylesheet" href="home.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>

<body>
	<?php include 'nav.php';?>

	<div class="container">
		<form action="signup_confirmation.php" method="POST">
			<div class="row justify-content-center">
			<div class="col-sm-5">
				<h1 class="col-12 mt-4 mb-4">Sign Up</h1>

			<div class="form-group row">
				<label for="username-id" class="col-sm-3 col-form-label text-sm-right">Username: <span class="text-danger">*</span></label>
				<input type="text" class="form-control" id="username-id" name="username">
				<small id="username-error" class="invalid-feedback">Username is required.</small>
			</div>

			<div class="form-group row">
				<label for="email-id" class="col-sm-3 col-form-label text-sm-right">Email: <span class="text-danger">*</span></label>
				<input type="email" class="form-control" id="email-id" name="email">
				<small id="email-error" class="invalid-feedback">Email is required.</small>
			</div> 

			<div class="form-group row">
				<label for="password-id" class=" col-form-label text-sm-right">Password: <span class="text-danger">*</span></label>
				<input type="password" class="form-control" id="password-id" name="password">
				<small id="password-error" class="invalid-feedback">Password is required.</small>
			</div> 

			<div class="form-group row">
				<label for="fav-id" class=" col-form-label text-sm-right">Favorite Idol: <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="fav-id" name="fav">
					<small id="password-error" class="invalid-feedback">Favorite Idol is required.</small>
			</div> 

			<div class="form-group row">
				<label for="motto-id" class=" col-form-label text-sm-right">Motto: <span class="text-danger">*</span></label>
				<input type="text" class="form-control" id="motto-id" name="motto">
				<small id="password-error" class="invalid-feedback">Motto Idol is required.</small>
			</div> 
			<div class="row">
				<div class="ml-auto col-sm-9">
					<span class="text-danger font-italic">* Required</span>
				</div>
			</div> 
			<div class="form-group row">
				<div class="d-grid mt-3 gap-2">
					<button type="submit" class="btn btn-dark">Register</button>
					<a href="../final/home.php" role="button" class="btn btn-outline-dark">Cancel</a>
				</div>
			</div> 
			<div class="row">
				<div class="col-sm-9 ml-sm-auto mt-3">
					<a href="login.php">Already have an account</a>
					<br>
				</div>
			</div> 
		</div>
	</div>
		</form>
	</div> 
	<script>

		document.querySelector('form').onsubmit = function(){
			if ( document.querySelector('#username-id').value.trim().length == 0 ) {
				document.querySelector('#username-id').classList.add('is-invalid');
			} else {
				document.querySelector('#username-id').classList.remove('is-invalid');
			}
			if ( document.querySelector('#email-id').value.trim().length == 0 ) {
				document.querySelector('#email-id').classList.add('is-invalid');
			} else {
				document.querySelector('#email-id').classList.remove('is-invalid');
			}
			if ( document.querySelector('#password-id').value.trim().length == 0 ) {
				document.querySelector('#password-id').classList.add('is-invalid');
			} else {
				document.querySelector('#password-id').classList.remove('is-invalid');
			}
			if ( document.querySelector('#fav-id').value.trim().length == 0 ) {
				document.querySelector('#fav-id').classList.add('is-invalid');
			} else {
				document.querySelector('#fav-id').classList.remove('is-invalid');
			}
			if ( document.querySelector('#motto-id').value.trim().length == 0 ) {
				document.querySelector('#motto-id').classList.add('is-invalid');
			} else {
				document.querySelector('#mottos-id').classList.remove('is-invalid');
			}
			return ( !document.querySelectorAll('.is-invalid').length > 0 );
		}
	</script>
</body>
</html>