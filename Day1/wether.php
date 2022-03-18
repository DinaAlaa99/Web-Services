<?php
ini_set('memory_limit', '-1');
$cities_encoded = file_get_contents("resources/city.list.json");
$cities_decoded = json_decode($cities_encoded, 1);
$cities_in_EG = [];
foreach ($cities_decoded as $city) {
    if ($city['country'] === 'EG') {
        $cities_in_EG[] = $city;
    }
}


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
			    <?php for ($i = 0; $i < count($cities_in_EG); $i++) {?>
				<option name="selected" value="<?=$i ?>" data-lat="<?$lat=$cities_in_EG[$i]['coord']['lat']?>"
                data-lon="<?$lon=$cities_in_EG[$i]['coord']['lon']?>"><?=$cities_in_EG[$i]['name']?></option>
				<?php }?>
        </select>
		<button type="submit" value= "get" name="submit">Submit</button>
	</form>
	<?php require "result.php" ?>
</body>
</html>