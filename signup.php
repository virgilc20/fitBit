<?php 
	if (isset($_GET['error'])) {
		$error = $_GET['error'];
		echo "<script>alert('$error');</script>";
	}
?>

<?php
	require "header.php";
?>

	<main>
		<h3>Please enter your information here:</h3>
		<form action="includes/signup.inc.php" method="post">
			<input type="text" name="uid" placeholder="Username">
			<input type="text" name="mail" placeholder="Email">
			<input type="password" name="pwd" placeholder="Password">
			<input type="password" name="pwd-repeat" placeholder="Repeat password">

			<button type="submit" name="signup-submit">Signup</button>
		</form>
	</main>

<?php
	require "footer.php";
?>