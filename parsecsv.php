<?php
	$conn =  new mysqli('localhost','dude','wowdudedb','project_auto');
	$file = fopen("zaxon.csv","r");
	$maker = "";
	$model = "";
	$part = "";
	$data = fgetcsv($file);
	print_r($data);
	$n = 0;

	while($data = fgetcsv($file)) { 
		#$data = fgetcsv($file);
		#print_r($data);
		$data[4] = str_replace('Used ', '', $data[4]);
		$data[4] = str_replace(' Parts', '', $data[4]);
		$data[6] = str_replace('Used '.$data[4].' ', '', $data[6]);
		$data[6] = str_replace(' Parts', '', $data[6]);
		$data[8] = str_replace($data[6].' ', '', $data[8]);
		$data[8] = str_replace(' Part', '', $data[8]);
		#print_r($data);
		#echo "$maker ".$data[4]."/n";
		if ($maker!=$data[4]) {
			$sql = "INSERT INTO tbl_car_maker(maker_name) VALUES(\"".$data[4]."\")";
			$result = $conn->query($sql);
		}
		$sql = "SELECT maker_id FROM tbl_car_maker WHERE maker_name=\"".$data[4]."\"";
		$result = $conn->query($sql);
		$row=$result->fetch_assoc();
		$mid=$row['maker_id'];
		if($model!=$data[6]) {
			$sql = "INSERT INTO tbl_car_model(model_name,maker_id) VALUES(\"".$data[6]."\",\"".$mid."\")";
			$result = $conn->query($sql);
		}
		$sql = "SELECT model_id FROM tbl_car_model WHERE model_name=\"".$data[6]."\"";
		$result = $conn->query($sql);
		$row=$result->fetch_assoc();
		$moid=$row['model_id'];

		$sql = "INSERT INTO tbl_car_part(part_name,model_id) VALUES(\"".$data[8]."\",\"".$moid."\")";
		#echo "$sql";
		$result = $conn->query($sql);

		$maker= $data[4];
		$model= $data[6];
		$part= $data[8];
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