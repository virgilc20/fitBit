<?php
	require 'includes/dbh.inc.php';

	$subtype = $_GET["subtype"];

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