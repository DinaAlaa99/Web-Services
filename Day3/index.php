<?php
session_start();
require_once("vendor/autoload.php");

use Illuminate\Database\Capsule\Manager as Capsule; //class manager that is used to establish the connection for the database
$Capsule = new Capsule();
$Capsule->addConnection([
    "driver" => _driver_,
    "host" => _host_,
    "database" => _database_,
    "username" => _username_,
    "password" => _password_
]);
$Capsule->setAsGlobal();
$Capsule->bootEloquent();
if (!$Capsule) {
    $api->output(array("error" => "Internal Server Error"), 500);
}


$api = new apiHelper();
$method = $_SERVER["REQUEST_METHOD"];
if ($api->get_method() == "GET") {
    $api->get();
}




