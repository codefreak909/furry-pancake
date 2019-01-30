<?php
	$conn =  new mysqli('localhost','dude','wowdudedb','project_auto');

	function ifExists($conn, $node, $item) {
		$sql = "SELECT ".$node."_name FROM tbl_car_".$node." WHERE ".$node."_name=\"".$item."\"";
		#echo $sql;
		$result = $conn->query($sql);
		if($result) {
			if (mysqli_num_rows($result)>0) {
				#echo "wow";
				return 1;
			}
			else {
				#echo "nowow";
				return 0;
			}
		}
	}

	function checkInventory($conn, $part_id, $model_id) {
		$sql = "SELECT inv_id FROM tbl_inventory WHERE part_id=\"".$part_id."\" AND model_id=\"".$model_id."\"";
		#echo $sql;
		$result = $conn->query($sql);
		if($result) {
			if (mysqli_num_rows($result)>0) {
				#echo "wow";
				return 1;
			}
			else {
				#echo "nowow";
				return 0;
			}
		}
	}

	function extractId($conn, $node, $item) {
		$sql = "SELECT ".$node."_id FROM tbl_car_".$node." WHERE ".$node."_name=\"".$item."\"";
		#echo $sql;
		$result = $conn->query($sql);
		if($result) {
			if (mysqli_num_rows($result)>0) {
				$row = $result->fetch_assoc();
				#echo "wow";
				return $row[$node.'_id'];
			}
			else {
				#echo "nowow";
				return 0;
			}
		}
	}

	$file = fopen("qualityautoparts.csv","r");
	$maker = "";
	$model = "";
	$part = "";
	$data = fgetcsv($file);
	#print_r($data);
	$n = 0;

	#while($data = fgetcsv($file))
	for($i=0;$i<5000;$i++) { 
		$data = fgetcsv($file);
		#0print_r($data);
		$data[4] = str_ireplace('-', ' ', $data[4]);
		$data[4] = str_ireplace('Used ', '', $data[4]);
		$data[4] = str_ireplace(' Parts', '', $data[4]);
		$data[6] = str_ireplace('-', ' ', $data[6]);
		$data[6] = str_ireplace('Used ', '', $data[6]);
		$data[6] = str_ireplace($data[4].' ', '', $data[6]);
		$data[6] = str_ireplace(' Parts', '', $data[6]);
		$data[8] = str_ireplace($data[6].' ', '', $data[8]);
		$data[8] = str_ireplace(' Part', '', $data[8]);
		#print_r($data);
		#echo "$maker ".$data[4]."/n";
		if (!ifExists($conn,'maker',$data[4])) {
			$sql = "INSERT INTO tbl_car_maker(maker_name) VALUES(\"".$data[4]."\")";
			$result = $conn->query($sql);
			echo "Inserted maker.";

		}
		#$sql = "SELECT maker_id FROM tbl_car_maker WHERE maker_name=\"".$data[4]."\"";
		#$result = $conn->query($sql);
		#$row=$result->fetch_assoc();
		#$mid=$row['maker_id'];
		if(!ifExists($conn,'model',$data[6])) {
			$sql = "INSERT INTO tbl_car_model(model_name,maker_id) VALUES(\"".$data[6]."\",\"".extractId($conn,'maker',$data[4])."\")";
			$result = $conn->query($sql);
			echo "Inserted model.";

		}
		#$sql = "SELECT model_id FROM tbl_car_model WHERE model_name=\"".$data[6]."\"";
		#$result = $conn->query($sql);
		#$row=$result->fetch_assoc();
		#$moid=$row['model_id'];
		if(!ifExists($conn,'part',$data[8])) {
			$sql = "INSERT INTO tbl_car_part(part_name) VALUES(\"".$data[8]."\")";
			$result = $conn->query($sql);
			echo "Inserted part.";
		}
		#echo extractId($conn,'part',$data[8]);
		if(!checkInventory($conn, extractId($conn,'part',$data[8]), extractId($conn,'model',$data[6]))) {
			$sql = "INSERT INTO tbl_inventory(part_id,model_id) VALUES(\"".extractId($conn,'part',$data[8])."\",\"".extractId($conn,'model',$data[6])."\")";
			$result = $conn->query($sql);
			echo "Added part to Inventory.";
		}
		#$maker= $data[4];
		#$model= $data[6];
		#$part= $data[8];
		$n++;
		echo "$n\n";

	}
	#	$data[2] = explode("(", $data[2])[0];
	#while ($data = fgetcsv($file)) {
	#	$data = fgetcsv($file);
	#	$data[2] = str_replace(' ', '', $data[2]);
	#	$data[2] = explode("(", $data[2])[0];
	#	print_r($data);
	#	$sql = "INSERT INTO data VALUES(\"".$data[0]."\",\"".$data[1]."\",\"".$data[2]."\",\"".$data[3]."\",\"".$data[4]."\",\"".$data[5]."\")";
		#$result = $conn->query($sql);
##	fclose($file);

?>	