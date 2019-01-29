<!DOCTYPE html>
<html>
<head>
	<title>TEST</title>
	<style type="text/css">
		select {
			width: 150px;
		}
	</style>
	<script type="text/javascript">
		function myFunction(e) {
    		//cument.getElementById("myText").value = e.currentTarget.id;
    		var xmlhttp = new XMLHttpRequest();
    		if (e.currentTarget.id == "maker") {
	        	xmlhttp.onreadystatechange = function() {
		            if (this.readyState == 4 && this.status == 200) {
				        	document.getElementById("model").innerHTML = this.responseText;
		            }
		        };
		    } else if (e.currentTarget.id == "model") {
		    	xmlhttp.onreadystatechange = function() {
		            if (this.readyState == 4 && this.status == 200) {
				        	document.getElementById("part").innerHTML = this.responseText;
		            }
		        };
		    } else if (e.currentTarget.id == "part")  {
		    	xmlhttp.onreadystatechange = function() {
		            if (this.readyState == 4 && this.status == 200) {
				        	document.getElementById("year").innerHTML = this.responseText;
		            }
		        };
		    }
	        if (e.currentTarget.id == "maker")
	        	xmlhttp.open("GET", "show.php?maker=" + e.target.value, true);
	        else if (e.currentTarget.id == "model") 
	        	xmlhttp.open("GET", "show.php?model=" + e.target.value, true);
	        else if (e.currentTarget.id == "part") 
	        	xmlhttp.open("GET", "show.php?part=" + e.target.value, true);
	        xmlhttp.send();
		}
	</script>
</head>
<body>
	<form>
		<select name="" id="maker" oninput="myFunction(event)">
			<option disabled selected>Maker</option>
			<?php
				$conn = new mysqli('localhost','dude','wowdudedb','project_auto');

				$sql="SELECT maker_name FROM tbl_car_maker";
				$result=$conn->query($sql);
				while ($row=$result->fetch_assoc()) {
					echo "<option value=\"".$row['maker_name']."\">".$row['maker_name']."</option>";
				}
			?>
		</select> <br>
		<select name="" id="model" oninput="myFunction(event)">
			<option disabled selected>Model</option>
		</select><br>
		<select name="" id="part" oninput="myFunction(event)">
			<option disabled selected>Parts</option>
		</select><br>
		<select name="" id="year" oninput="myFunction(event)">
			<option disabled selected>Year</option>
		<select><br>
	</form>
</body>
</html>