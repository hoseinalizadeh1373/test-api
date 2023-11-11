<?php

require("./vendor/autoload.php");

use App\Log;
use NasimTelecom\Simotel\Simotel;

$log= new Log;

$config = require ("config.php");
$simotel = new Simotel($config);

try{
    $res = $simotel->connect("setting/ping/act",[
     ""]);
    $log->info($res);
}
catch(Exception $ex){
    $log->error($ex->getMessage());
    die($ex->getMessage());
}

