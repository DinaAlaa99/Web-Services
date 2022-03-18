
<p>Weather Status</p><br><br>
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
            echo "The weather of " . $decode_response['name'] . " at " . date('d M Y') . " is " . ucwords($decode_response['weather'][0]['description']) . " <br>temperature is " . $decode_response['main']['temp'] . "<br>wind speed is " . $decode_response['wind']['speed'];
        } else {
            echo "<br>"."no response from the server";
        
        }
    } catch (Exception $e) {
        echo $e;
    }
}


?>
