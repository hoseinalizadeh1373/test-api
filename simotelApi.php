<?php

use App\Log;
use Monolog\Logger; // The Logger instance
use Monolog\Handler\StreamHandler;
use Simotel\Simotel;

$log = new Log();

$config = require("config.php");
if(file_exists('data.json')){
    $jsonString = file_get_contents('data.json');
    $data = json_decode($jsonString, true);
}

$simotel = new Simotel($data);

try {
    $res = $simotel->connect("setting/ping/act", [
     ""]);

    $logger = new Logger("daily");

    $stream_handler = new StreamHandler('logs.log', Logger::DEBUG);
    $logger->pushHandler($stream_handler);

    $logger->info($res);

} catch(Exception $ex) {
    $log->error($ex->getMessage());
    die($ex->getMessage());
}
?>