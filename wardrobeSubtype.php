<?php
	require 'includes/dbh.inc.php';

	$type = $_GET["type"];

	if (!empty($type)) { 
		$res = mysqli_query($conn, "SELECT DISTINCT subtype FROM pjiang_litfit_attire_list WHERE type = '$type'"); 
		echo "<select id='subtypedd' onChange='changeSubtype()'>";
		echo "<option value='select'>Select</option>";
		while ($row = mysqli_fetch_array($res)) {
			?>
			<option value="<?php echo $row["subtype"]; ?>">
			<?php
			echo $row["subtype"];
			echo "</option>";
		}

		echo "</select>";
	}
?>