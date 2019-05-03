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
		function changeType() {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", "ajax.php?type="+document.getElementById("typedd").value, false);
			xmlhttp.send(null);
			document.getElementById("subtype").innerHTML=xmlhttp.responseText;

			if (document.getElementById("typedd").value == 'select') { //this checks for absense (select) but not for changes, fix
				document.getElementById("subsubtype").innerHTML="<select><option>Select</option></select>"; 
			}
		}

		function changeSubtype() {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", "ajax.php?subtype="+document.getElementById("subtypedd").value, false);
			xmlhttp.send(null);
			document.getElementById("subsubtype").innerHTML=xmlhttp.responseText;
		}

	</script>	


</body>
</html>
