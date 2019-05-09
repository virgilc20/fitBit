<!DOCTYPE html>
<html>
<head>
	<title>Wardrobe</title>
</head>
<body>
	<h1>Add Clothes to your Wardrobe!</h1>

	<?php
		require 'includes/dbh.inc.php';



		function addWardrobe() {
			//submit form info???????????
		}
	?>


<div id="wardrobe_form">
	<form action="">
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
					<select id="attire">
						<option value="select">Select</option>
					</select>
					</div>
				</td>
			</tr>

			<!-- <tr>
				<td>Select Pattern</td>
				<td>
					<div id="pattern">
					<select>
						<option value="select">Select</option>
					</select>
					</div>
				</td>
			</tr> -->

			<tr>
				<td>Select Color</td>
				<td>
					<input id="color" type="color" name="color" value="#ff0000">
				</td>
			</tr>


			<tr>
				<td>
					<button onclick="addWardrobe()"> Add to Wardrobe </button>
				</td>	
			</tr>


		</table>
	</form>
</div>

	<script type="text/javascript">
		function changeType() {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", "ajax.php?type="+document.getElementById("typedd").value, false);
			xmlhttp.send(null);
			document.getElementById("subtype").innerHTML=xmlhttp.responseText;

			//document.getElementById("pattern").innerHTML=xmlhttp.responseText; change pattern, and fit, based off of type
			//document.getElementById("fit").innerHTML=xmlhttp.responseText;

			document.getElementById("subsubtype").innerHTML="<select><option value='select'>Select</option></select>";
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
