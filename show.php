<?php
	$conn = new mysqli('localhost','dude','wowdudedb','project_auto');
	if (isset($_GET['maker'])) {
		$maker = $_GET['maker'];
		$sql="SELECT s.model_name as model FROM tbl_car_model s INNER JOIN tbl_car_maker c ON s.maker_id = c.maker_id WHERE c.maker_name=\"$maker\"";
		$result=$conn->query($sql);
		echo "<option disabled selected>Model</option>";
		while ($row=$result->fetch_assoc()) {
			echo "<option value=\"".$row['model']."\">".$row['model']."</option>";
		}
	} elseif (isset($_GET['model'])) {
		$model = $_GET['model'];
		$sql="SELECT ct.part_name as part FROM tbl_car_part ct INNER JOIN tbl_car_model s ON ct.model_id = s.model_id WHERE s.model_name=\"$model\"";
		$result=$conn->query($sql);
		echo "<option disabled selected>Part</option>";
		while ($row=$result->fetch_assoc()) {
			echo "<option value=\"".$row['part']."\">".$row['part']."</option>";
		}
	} elseif (isset($_GET['part'])) {
		echo "<option disabled selected>Year</option>";
		for($i=1960;$i<=2019;$i++) {
			echo "<option value=\"".$i."\">".$i."</option>";
		}
	}
?>