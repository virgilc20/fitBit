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
		<link rel="stylesheet" href="login.css">

		<div class="topnav">
			<a class="left" href ="index.php">DASHBOARD</a>
	    	<a class="left" href="wardrobe.php">WARDROBE</a>
	    	<?php 
	    	if (!isset($_SESSION['userId'])) {
				echo "<a class='left' href='login.php'>LOGIN</a>";
	    	}
	    	else {
	    		echo "<a class='left' href='login.php'>("; echo $_SESSION['userUid']; echo ") LOGIN/LOGOUT</a>";
	    	}
	    	?>
  		</div>

  		<div id='mainblock'>
  		<?php
  		if (!isset($_SESSION['userId'])) {
	  		echo "<h3>Welcome to Outfit Generator! Please sign up or log in before continuing.</h3>";
	  	}
	  	?>
	
		<header>
			<nav>
				<div>
					<form action="includes/login.inc.php" method="post">
						<input type="text" name="mailuid" placeholder="Username/Email...">
						<input type="password" name="pwd" placeholder="Password...">
						<button id=login-button type="submit" name="login-submit">Login</button>
					</form>
					<form action="includes/logout.inc.php" method="post">
						<button id=logout-button type="submit" name="logout-submit">Logout</button>
					</form>
					<a id='signup' href="signup.php">Signup</a>
				</div>
			</nav>
		</header>
</html>