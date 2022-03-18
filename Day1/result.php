<?php
require_once "config.php";


if (isset($_POST['city'])) {
    //echo $_POST['city'];
    
   $lat = $cities_in_EG[$_POST['city']]['coord']['lat'];
   $lon = $cities_in_EG[$_POST['city']]['coord']['lon'];



  
    $url = "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid=".api_key;

    try {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        if ($response) {

            $decode_response = json_decode($response, true);
            echo "<br><br>". $decode_response['name']. " Weather Status<br><br>"; 
            echo date('l  h:i A')."<br>";
            echo   date('d M Y')."<br>";
            echo  ucwords($decode_response['weather'][0]['description']) . " <br>Humidity: " . $decode_response['main']['humidity'] ."%";
            echo "<br>Wind: " . $decode_response['wind']['speed']." Km/h";

        } else {
            echo "<br>"."no response from the server";
        
        }
    } catch (Exception $e) {
        echo $e;
    }
}


?>
