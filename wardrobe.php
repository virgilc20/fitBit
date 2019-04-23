<!DOCTYPE html>
<html>
<head>
	<title>Wardrobe</title>
</head>
<body>
	<h1>Add Clothes to your Wardrobe!</h1>

	<?php
		require 'includes/dbh.inc.php';
	?>


	<form method="POST" action="">
		<table>
			<tr>
				<td>Select Top Type</td>
				<td>
					<select id="topTypedd" onChange="changeTopType()">
						<option value="select">Select</option>
						<?php
							$res = mysqli_query($conn, "SELECT * FROM pjiang_top_type;");
							while ($row = mysqli_fetch_array($res)) {		
								?>					
								<option value="<?php echo $row["id"]; ?>">
									<?php echo $row["type"]; ?>
								</option>
								<?php
							}
						?>
					</select>
				</td>
			</tr>

			<tr>
				<td>Select Top Subtype</td>
				<td>
					<div id="topSubtype">
					<select>
						<option value="select">Select</option>
					</select>
					</div>
				</td>

			</tr>

			<tr>
				<td>Select Color</td>
				<td>
					<input type="color" name="color" value="#ff0000">
				</td>
			</tr>

			<tr>
				<td>Select Pattern</td>
				<td>
					<select>
						<option value="none">None</option>
						<option value="horstripe">Horizontal Stripes</option>
						<option value="vertstripe">Vertical Stripes</option>
					</select>
				</td>
			</tr>

			<!-- the bottom table starts here--------probably combine tables in a way--------------------------------------------------------- -->
			<tr><td></br></br></td></tr>



			<tr>
				<td>Select Bottom Type</td>
				<td>
					<select id="bottomTypedd" onChange="changeBottomType()">
						<option value="select">Select</option>
						<?php
							$res = mysqli_query($conn, "SELECT * FROM pjiang_bottom_type;");
							while ($row = mysqli_fetch_array($res)) {		
								?>					
								<option value="<?php echo $row["id"]; ?>">
									<?php echo $row["type"]; ?>
								</option>
								<?php
							}
						?>
					</select>
				</td>
			</tr>

			<tr>
				<td>Select Bottom Subtype</td>
				<td>
					<div id="bottomSubtype">
					<select>
						<option value="select">Select</option>
					</select>
					</div>
				</td>

			</tr>

			<tr>
				<td>Select Color</td>
				<td>
					<input type="color" name="color" value="#ff0000">
				</td>
			</tr>

			<tr>
				<td>Select Pattern</td>
				<td>
					<select>
						<option value="none">None</option>
						<option value="horstripe">Horizontal Stripes</option>
						<option value="vertstripe">Vertical Stripes</option>
					</select>
				</td>
			</tr>

			<tr>
				<td>
					<input type="submit" value="GO!" />
				</td>	
			</tr>



		</table>
	</form>

	<script type="text/javascript">
		function changeTopType() {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", "ajax.php?topType="+document.getElementById("topTypedd").value, false);
			xmlhttp.send(null);
			document.getElementById("topSubtype").innerHTML=xmlhttp.responseText;
		}

		function changeBottomType() {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", "ajax.php?bottomType="+document.getElementById("bottomTypedd").value, false);
			xmlhttp.send(null);
			document.getElementById("bottomSubtype").innerHTML=xmlhttp.responseText;
		}
	</script>	


</body>
</html>
