<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Wardrobe</title>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js"></script> <!-- microsoft cdn jquery -->
</head>
<body>
	<h2 id="intro">Add Clothes to your Wardrobe!</h2>

	<?php
		require 'includes/dbh.inc.php';
	?>

	<form id="wardrobe_form" action="">
		<table>
			<tr>
				<td>Select Type</td>
				<td>
					<select id="typedd" onChange="changeType()">
						<option value="select">Select</option>
						<?php
							$res = mysqli_query($conn, "SELECT DISTINCT type FROM pjiang_litfit_attire_list");
							while ($row = mysqli_fetch_array($res)) {		
								?>					
								<option value="<?php echo $row["type"]; ?>">
									<?php echo $row["type"]; ?>
								</option>
								<?php
							}
						?>

						
					</select>
				</td>
			</tr>

			<tr>
				<td>Select Subtype</td>
				<td>
					<div id="subtype">
					<select>
						<option value="select">Select</option>
					</select>
					</div>
				</td>
			</tr>

			<tr>
				<td>Select Subsubtype</td>
				<td>
					<div id="subsubtype">
					<select>
						<option value="select">Select</option>
					</select>
					</div>
				</td>
			</tr>

			<tr>
				<td>Select Color</td>
				<td>
					<input id="color" type="color" name="color" value="#ff0000">
					<input type="hidden" id="user" value="<?=$_SESSION['userId'];?>"> <!--hidden for ajax pass-->
				</td>
			</tr>


			<tr>
				<td>
					<input type="submit" name="submit" class="button" id="submit_btn" value="send">
				</td>	
			</tr>


		</table>
	</form>	

	
	<div id="display">
	<?php
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
	</div>


	<script>
		$(function() {
			$(".button").click(function() {

					var attire = $("#attire").val(); 
						if (attire == "select" || attire == null) {
							alert("Please fully select an article of clothing.");
							return false;
						}
					var color = $("#color").val();
					var user = $("#user").val();

					$.ajax({
						type: "POST",
						url: "wardrobeUpdate.php",
						data: {attire: attire, color: color, user: user},
						success: function() {
							$('#intro').html("<h4 id='intro'>Succesfully added! Add another?</h4>").hide().fadeIn("1500", function() {
								//Animation complete. 
							});
							$('#wardrobe_form')[0].reset()
							$('#subtype').html("<select><option value='select'>Select</option></select>")
							$('#subsubtype').html("<select><option value='select'>Select</option></select>")
						}
					});

					$("#display").load("wardrobeDisplay.php");

					return false;
			});
		});

		function changeType() {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", "wardrobeSubtype.php?type="+document.getElementById("typedd").value, false);
			xmlhttp.send(null);
			document.getElementById("subtype").innerHTML=xmlhttp.responseText;
			document.getElementById("subsubtype").innerHTML="<select><option value='select'>Select</option></select>";
		}

		function changeSubtype() {

			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", "wardrobeSubsubtype.php?subtype="+document.getElementById("subtypedd").value, false);
			xmlhttp.send(null);
			document.getElementById("subsubtype").innerHTML=xmlhttp.responseText;
		}

	</script>	

	

</body>
</html>
