<?php

class apiHelper
{
    private $url;
    private $method = "get";
    private $resource;
    private $resource_id;
    private $body_resource;

    public function __construct()
    {
        $this->method = $this->get_method();
        $this->read_resource();
        if ($this->resource === "" || $this->resource_id === -1) {
            $this->output(array("error" => "resource or resource id dosnot exist"), 404);
        } elseif (is_numeric($this->resource_id) && $this->resource_id != -1) {

            //is_numeric($this->resource_id)&&$this->resource_id!=-1
            $value = $this->resource_id;
            var_dump($value);
            $data = Illuminate\Database\Capsule\Manager::table("items")
                ->where('id', '=', $value)
                ->get();
            if (!empty($data)) {
                $this->output(array("data" => $data), 200);
            } else {
                $this->output(array("error" => "Resource doesnot exist"), 404);
            }
        }
    }
    public function output($data, $response_code = 200)
    {
        http_response_code($response_code);
        header("content_Type: application/json");
        echo json_encode($data);
        exit();
    }
    public function get_method()
    {
        $allowe = array("GET", "POST", "PUT", "DELETE");
        if (in_array(($_SERVER["REQUEST_METHOD"]), $allowe)) {
            return $_SERVER["REQUEST_METHOD"];
        } else {
            $this->output(array("error" => "Method Not Allowed"), 405);
        }
    }
    public function read_resource()
    {
        $this->url = $_SERVER["REQUEST_URI"];
        $allowed = array("items", "users", "employees");
        $pieces = explode('/', $this->url);
        $this->resource = in_array($pieces[3], $allowed) ? $pieces[3] : "";
        if (isset($pieces[4])) {
            $this->resource_id = is_numeric($pieces[4]) ? $pieces[4] : -1;
        }
    }
    public function get()
    {
        $value = $this->resource_id;
        if (is_numeric($this->resource_id)) {
            $data = Illuminate\Database\Capsule\Manager::table("items")
                ->where('id', '=', "$value")
                ->get();
            var_dump($data);
            $this->output(array("data" => $data), 200);
        }
    }
}
