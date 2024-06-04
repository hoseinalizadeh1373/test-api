<?php

require("./vendor/autoload.php");


use Simotel\Simotel;
use App\SelectiveCase;
use App\Log;

$config = require("config.php");
// $requestData = $_REQUEST;
// $config = require("config.php");
// $log = new Log;
// try{

    $config["ivrApi"]["apps"] = [
        'selectCase' => SelectiveCase::class
    ];
    $simotel = new Simotel($config);
    $appData = [
        'app_name' =>'selectCase',
        'data' =>'451'
    ];
   
    $res = $simotel->ivrApi($appData)->toJson();
    header('Content-Type: application/json; charset=utf-8');
    echo $res;
// }
// catch(Exception $ex){
//     $errorMessage = $ex->getMessage();
//     $log->error($errorMessage);
//     header('Content-Type: application/json; charset=utf-8');
//     echo json_encode(["error"=>$errorMessage]);
// }