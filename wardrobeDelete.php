<?php

	require 'includes/dbh.inc.php';

	if(isset($_POST['wardrobeId'])) {
		$wardrobeId = $_POST['wardrobeId'];


		$result = mysqli_query($conn, "DELETE FROM pjiang_litfit_wardrobe WHERE wardrobeId = $wardrobeId");

	}
?>