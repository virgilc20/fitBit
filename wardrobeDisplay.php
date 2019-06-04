<?php
	session_start();
	require 'includes/dbh.inc.php';

	$userId = $_SESSION['userId'];
	$typeDisplay = array("Top", "Bottom", "Footwear");

	for ($i = 0; $i < count($typeDisplay); $i++) {
		$sql = "SELECT wardrobeId, type, subtype, subsubtype, color FROM pjiang_litfit_wardrobe w JOIN pjiang_litfit_attire_list a ON w.attireId = a.id WHERE userId = $userId AND type = '$typeDisplay[$i]'";
		$result = mysqli_query($conn, $sql);
		echo "<table>";
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
						echo "<td>"; echo $row['subsubtype']; echo "</td>";
						echo "<td> ("; echo $row['subtype']; echo ") </td>";
						echo "<td style = color:"; echo $row['color']; echo ">"; echo $row['color']; echo "</td>";
						echo "<td>"; ?> <button id='delete' value='<?php echo $row['wardrobeId'] ?>'>X</button> <?php echo "</td>";
						echo "<script>"; ?> var elem = document.getElementById('delete'); elem.id = 'delete'.concat(<?php echo $row['wardrobeId']?>); <?php echo "</script>";
					echo "</tr>";
				}
			}
		else {
			if ($i == 0) {
				echo "No tops yet!";
			}
			else if ($i == 1) {
				echo "No bottoms yet!";
			}
			else {
				echo "No  yet!";
			}
		}
		echo "</table>";
	}
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
					$('#intro').html("<h4 id='intro'>Succesfully deleted.</h4>").hide().fadeIn("1500", function() {
						//Animation complete. 
					});
				}
			});

			$("#display").load("wardrobeDisplay.php"); 
		});
	});
</script>