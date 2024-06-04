<?php

require("./vendor/autoload.php");

use Simotel\Simotel;
use App\Log;


$log = new Log;
$log->info("ss");
$requestData = $_REQUEST;
$config = require("config.php");

try{
    
    $config["smartApi"]["apps"] = [
        'test' => RestOfApps::class,
      ];
      $simotel = new Simotel($config);
    $res = $simotel->smartApi($requestData)->toJson();
    // header('Content-Type: application/json; charset=utf-8');
    // echo $res;

    $log->info($requestData);
}
catch(Exception $ex){
    $errorMessage = $ex->getMessage();
    $log->error($errorMessage);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(["error"=>$errorMessage]);
}