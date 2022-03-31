<?php

use GuzzleHttp\Client;

//$client = new GuzzleHttp\Client();

class WeatherGuzzle implements Weather_Interface
{

    //put your code here
    private $url;
    private $key;
    
    public function __construct()
    {


    }

    public function get_cities()
    {
        ini_set('memory_limit', '-1');
        $string = file_get_contents("resources/city.list.json");
        $json_cities = json_decode($string, true);
    
        foreach ($json_cities as $item) {
            if (strcmp($item["country"], "EG") == 0) {
                $cities[] = $item;
            }
        }
        return $cities;
    }

    public function get_weather($cityid)
    {
        require_once "config.php";
        $client = new GuzzleHttp\Client();
        $result = json_decode($client->get("https://api.openweathermap.org/data/2.5/weather?q=$cityid&units=metric&appid=" . api_key)->getBody(), true);    
        return $result;
  
       
      
    }

    public function get_current_time()
    {
        $date = array(date("l g:i a"), date("jS F,Y"));
        return $date;
    }
}
