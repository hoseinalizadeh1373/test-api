<?php

use App\Log;
use Monolog\Logger; // The Logger instance
use Monolog\Handler\StreamHandler;
use Simotel\Simotel;

$log = new Log();

$config = require("config.php");
$simotel = new Simotel($config);

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