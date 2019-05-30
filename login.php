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
		<?php
			if (isset($_SESSION['userId'])) {
				echo '<h2>'; echo $_SESSION['userUid']; echo' is currently logged in.</h2>';
			}
		?>
		</main>




	</div>