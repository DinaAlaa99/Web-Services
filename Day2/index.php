<?php
//require "autoload.php";
require 'vendor/autoload.php';
$weather = new WeatherGuzzle();
$cities_in_EG = $weather->get_cities();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>	Check Weather</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<p2>Wether Forcase</p2><br><br>
		<form  method="post">
		<select name="city" >
			      <?php foreach ($cities_in_EG as $city) {
                   echo "<option  name='city'value=" . $city["id"] . ">" . $city["name"] . "</option>";
                   }
                ?>
        </select>
		<button type="submit" value= "get" name="submit">Submit</button>
	</form>

	<?php require "result.php"?>
</body>
</html>