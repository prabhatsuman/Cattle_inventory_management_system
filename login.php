<?php
include 'database_connection.php';
include 'php_includes/functions.php';
$message = '';

if (isset($_POST["login_button"])) {

	$formdata = array();

	if (empty($_POST["admin_email"])) {
		$message .= '<li>Email Address is required</li>';
	} else {
		if (!filter_var($_POST["admin_email"], FILTER_VALIDATE_EMAIL)) {
			$message .= '<li>Invalid Email Address</li>';
		} else {
			$formdata['admin_email'] = $_POST['admin_email'];
		}
	}

	if (empty($_POST['admin_password'])) {
		$message .= '<li>Password is required</li>';
	} else {
		$formdata['admin_password'] = $_POST['admin_password'];
	}

	if ($message == '') {
		$data = array(
			':admin_email'		=>	$formdata['admin_email']
		);

		$query = "
		SELECT * FROM cis_admin 
        WHERE admin_email = :admin_email
		";

		$statement = $connect->prepare($query);

		$statement->execute($data);

		if ($statement->rowCount() > 0) {
			foreach ($statement->fetchAll() as $row) {
				if ($row['admin_password'] == $formdata['admin_password']) {
					session_start();
					$_SESSION['admin_id'] = $row['admin_id'];

					header('location:admin/index.php');
				}
				else
				{
					$message = '<li>Wrong Password</li>';
				}
			}
		} else {
			$message = '<li>Wrong Email Address</li>';
		}
	}
}

?>



<!DOCTYPE html>
<html lang="en">



<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="login1.css">
	<title>Login</title>
</head>
<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<div class="login-form">
				<?php
				if ($message != '') {
					echo '<div class="alert alert-danger"><ul>' . $message . '</ul></div>';
				}
				?>
				<form method="post">
					<div class="form-group">
						<label for="exampleInputEmail1">Email address</label>
						<input type="text" name="admin_email" id="admin_email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" />
						<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
					</div>
					<div class="form-group">

						<label for="exampleInputPassword1">Password</label>
						<input type="password" name="admin_password" id="admin_password" class="form-control" placeholder="Password" />
					</div>
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="exampleCheck1">
						<label class="form-check-label" for="exampleCheck1">Check me out</label>
					</div>
					<input type="submit" name="login_button" class="btn btn-primary" value="Login" />
				</form>
			</div>
		</div>
	</div>
</div>

<body>

</body>

</html>