<?php
	session_start();
	require 'includes/dbh.inc.php';

	$userId = $_SESSION['userId'];

	$sql = "SELECT wardrobeId, type, subtype, subsubtype, color FROM pjiang_litfit_wardrobe w JOIN pjiang_litfit_attire_list a ON w.attireId = a.id WHERE userId = $userId AND type = 'Top'";
	$result = mysqli_query($conn, $sql);
	echo "<table>";
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr>";
					echo "<td>"; echo $row['wardrobeId']; echo "</td>";
					echo "<td>"; echo $row['subsubtype']; echo "</td>";
					echo "<td> ("; echo $row['subtype']; echo ") </td>";
					echo "<td>"; echo $row['color']; echo "</td>";
					echo "<td>"; ?> <button id='delete' value='<?php echo $row['wardrobeId'] ?>'>X</button> <?php echo "</td>";
					echo "<script>"; ?> var elem = document.getElementById('delete'); elem.id = 'delete'.concat(<?php echo $row['wardrobeId']?>); <?php echo "</script>";
				echo "</tr>";
			}
		}
		else {
			echo "No tops yet!";
		}
	echo "</table>";


	$sql = "SELECT wardrobeId, type, subtype, subsubtype, color FROM pjiang_litfit_wardrobe w JOIN pjiang_litfit_attire_list a ON w.attireId = a.id WHERE userId = $userId AND type = 'Bottom'";
	$result = mysqli_query($conn, $sql);
	echo "<table>";
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr>";
					echo "<td>"; echo $row['wardrobeId']; echo "</td>";
					echo "<td>"; echo $row['subsubtype']; echo "</td>";
					echo "<td> ("; echo $row['subtype']; echo ") </td>";
					echo "<td>"; echo $row['color']; echo "</td>";
					echo "<td>"; ?> <button id='delete' value='<?php echo $row['wardrobeId'] ?>'>X</button> <?php echo "</td>";
					echo "<script>"; ?> var elem = document.getElementById('delete'); elem.id = 'delete'.concat(<?php echo $row['wardrobeId']?>); <?php echo "</script>";
				echo "</tr>";
			}
		}
		else {
			echo "No bottoms yet!";
		}
	echo "</table>";


	$sql = "SELECT wardrobeId, type, subtype, subsubtype, color FROM pjiang_litfit_wardrobe w JOIN pjiang_litfit_attire_list a ON w.attireId = a.id WHERE userId = $userId AND type = 'Footwear'";
	$result = mysqli_query($conn, $sql);
	echo "<table>";
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr>";
					echo "<td>"; echo $row['wardrobeId']; echo "</td>";
					echo "<td>"; echo $row['subsubtype']; echo "</td>";
					echo "<td> ("; echo $row['subtype']; echo ") </td>";
					echo "<td>"; echo $row['color']; echo "</td>";
					echo "<td>"; ?> <button id='delete' value='<?php echo $row['wardrobeId'] ?>'>X</button> <?php echo "</td>";
					echo "<script>"; ?> var elem = document.getElementById('deletetop'); elem.id = 'delete'.concat(<?php echo $row['wardrobeId']?>); <?php echo "</script>";
				echo "</tr>";
			}
		}
		else {
			echo "No footwear yet!";
		}
	echo "</table>";
?>

<script>
	$(function() {
		$("button[id^='delete']").click(function() {

			var wardrobeId = $(this).val(); 

			$.ajax({
				type: "POST",
				url: "wardrobeDelete.php",
				data: {wardrobeId: wardrobeId},
				success: function() {

				}
			});

			$("#display").load("wardrobeDisplay.php"); 
		});
	});
</script>