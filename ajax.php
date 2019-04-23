<?php
	require 'includes/dbh.inc.php';


	$topType = $_GET["topType"];

	if (!empty($topType)) {
		$res = mysqli_query($conn, "SELECT * FROM pjiang_top_subtype WHERE type = $topType"); //ints match to ints- try to get strings match to strings
		echo "<select>";
		echo "<option value='select'>Select</option>";
		while ($row = mysqli_fetch_array($res)) {
			?>
			<option value="<?php echo $row["id"]; ?>">
			<?php
			echo $row["subtype"];
			echo "</option>";
		}

		echo "</select";
	}



	$bottomType = $_GET["bottomType"];

	if (!empty($bottomType)) {
		$res = mysqli_query($conn, "SELECT * FROM pjiang_bottom_subtype WHERE type = $bottomType"); //ints match to ints- try to get strings match
		echo "<select>";
		echo "<option value='select'>Select</option>";
		while ($row = mysqli_fetch_array($res)) {
			?>
			<option value="<?php echo $row["id"]; ?>">
			<?php
			echo $row["subtype"];
			echo "</option>";
		}

		echo "</select";
	}
?>