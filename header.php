<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<meta name=viewport content="width=device-width, initial=scale=1">
		<title>LitFit</title>
		<link rel="stylesheet" type="text/css" href="style.css"/>

	</head>
	<body>
	
		<header>
			<nav>
				<div>
					<form action="includes/login.inc.php" method="post">
						<input type="text" name="mailuid" placeholder="Username/Email...">
						<input type="password" name="pwd" placeholder="Password...">
						<button type="submit" name="login-submit">Login</button>
					</form>
					<a href="signup.php">Signup</a>
					<form action="includes/logout.inc.php" method="post">
						<button type="submit" name="logout-submit">Logout</button>
					</form>
				</div>
			</nav>
		</header>
</html>