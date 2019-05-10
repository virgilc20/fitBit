<?php
	require 'includes/dbh.inc.php';

	if(isset($_POST['attire'])) {
		$attire = $_POST['attire'];
		$color = $_POST['color'];



		$result = mysqli_query($conn, "INSERT INTO pjiang_litfit_wardrobe(attireId, color) VALUES ('$attire', '$color')");

	}
?>