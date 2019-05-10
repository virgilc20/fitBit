<?php
	require 'includes/dbh.inc.php';

	$type = $_GET["type"];
	$subtype = $_GET["subtype"];

	if (!empty($type)) { //these are never actually empty?
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

	if (!empty($subtype)) {
		$res = mysqli_query($conn, "SELECT id, subsubtype FROM pjiang_litfit_attire_list WHERE subtype = '$subtype'"); 
		echo "<select id='attire'>";
		echo "<option value='select'>Select</option>";
		while ($row = mysqli_fetch_array($res)) {
			?>
			<option value="<?php echo $row["id"]; ?>">
			<?php
			echo $row["subsubtype"];
			echo "</option>";
		}

		echo "</select>";
	}


?>