<?php

	require 'includes/dbh.inc.php';

	if(isset($_POST['attire'])) {
		$attire = $_POST['attire'];
		$color = $_POST['color'];
		$user = $_POST['user'];


		$result = mysqli_query($conn, "INSERT INTO pjiang_litfit_wardrobe(userId, attireId, color) VALUES ('$user', '$attire', '$color')");

	}
?>