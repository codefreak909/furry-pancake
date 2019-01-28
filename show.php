<?php
	$conn = new mysqli('localhost','dude','wowdudedb','test');
	if (isset($_GET['country'])) {
		$country = $_GET['country'];
		$sql="SELECT s.state_name as state FROM state s INNER JOIN country c ON s.cid = c.cid WHERE c.country_name=\"$country\"";
		$result=$conn->query($sql);
		echo "<option disabled selected>State</option>";
		while ($row=$result->fetch_assoc()) {
			echo "<option value=\"".$row['state']."\">".$row['state']."</option>";
		}
	} elseif (isset($_GET['state'])) {
		$state = $_GET['state'];
		$sql="SELECT ct.city_name as city FROM city ct INNER JOIN state s ON ct.sid = s.sid WHERE s.state_name=\"$state\"";
		$result=$conn->query($sql);
		echo "<option disabled selected>City</option>";
		while ($row=$result->fetch_assoc()) {
			echo "<option value=\"".$row['city']."\">".$row['city']."</option>";
		}
	} elseif (isset($_GET['city'])) {
		$city = $_GET['city'];
		$sql="SELECT p.pcode as pincode FROM pincode p INNER JOIN city ct ON p.ctid = ct.ctid WHERE ct.city_name=\"$city\"";
		$result=$conn->query($sql);
		echo "<option disabled selected>Pincode</option>";
		while ($row=$result->fetch_assoc()) {
			echo "<option value=\"".$row['pincode']."\">".$row['pincode']."</option>";
		}
	}
?>