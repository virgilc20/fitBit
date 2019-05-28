<?php
	require "header.php";
?>

	<main>
		<?php
			if (isset($_SESSION['userId'])) {
				echo '<p>You are logged in!</p>';
				print_r($_SESSION);
			}
			else {
				echo '<p>You are logged out!</p>';
			}
		?>
	</main>

<?php
	require "footer.php";
?>