<?php
	session_start();

	require 'includes/dbh.inc.php';

	$userId = $_SESSION['userId'];

		$sql = "SELECT * FROM pjiang_litfit_wardrobe WHERE userId = $userId";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<p>";
				echo $row['userId'];
				echo "<br>";
				echo $row['attireId'];
				echo "<br>";
				echo $row['color'];
				echo "</p>";
			}
		}
		else {
			echo "nothing here yet!";
		}


?>