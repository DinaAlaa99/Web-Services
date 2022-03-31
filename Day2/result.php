<?php
//require_once "config.php";
//require "autoload.php";
ini_set('memory_limit', '-1');
$weather = new Weather();
$egyption_cities = $weather->get_cities();

if (isset($_POST['city'])) {
    

    $cityId = $_POST['city'];
    $decode_response= $weather->get_weather($cityId);
    //$currentTime = $weather->get_current_time(); 

    //$lon = $cities_in_EG[$_POST['city']]['coord']['lon'];

   

            echo "<br><br>" . $decode_response['name'] . " Weather Status<br><br>";
            echo date('l  h:i A') . "<br>";
            echo date('d M Y') . "<br>";
            echo ucwords($decode_response['weather'][0]['description']) . " <br>Humidity: " . $decode_response['main']['humidity'] . "%";
            echo "<br>Wind: " . $decode_response['wind']['speed'] . " Km/h";

   
}
