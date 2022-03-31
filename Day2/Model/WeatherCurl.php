<?php

class Weather implements Weather_Interface
{

    //put your code here
    private $url;
    private $key;
    public function __construct()
    {

        //$this->key=$apikey;

        //return $ch;

    }

    public function get_cities()
    {
        ini_set('memory_limit', '-1');
        $string = file_get_contents("resources/city.list.json");
        $json_cities = json_decode($string, true);
        // print_r($json_cities);
        // $cities=0;
        foreach ($json_cities as $item) {
            if (strcmp($item["country"], "EG") == 0) {
                $cities[] = $item;
            }
        }
        return $cities;

    }

    public function get_weather($cityid)
    {      require_once "config.php";

            $this->url="https://api.openweathermap.org/data/2.5/weather?id=".$cityid."&appid=".api_key;

    try {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, $this->url);
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, true);
        return $data;
          } catch (Exception $e) {
        echo $e;
    }

    }

    public function get_current_time()
    {
        $date = array(date("l g:i a"), date("jS F,Y"));
        return $date;

    }

}
