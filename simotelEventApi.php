<?php

require("./vendor/autoload.php");

use Simotel\Simotel;
use App\Log;
use Monolog\Logger; // The Logger instance
use Monolog\Handler\StreamHandler;

$simotel = new Simotel();
$log = new Log();
$log->info($_REQUEST["event_name"]);

$simotel->eventApi()->addListener('Ping', function ($data) {
    $log = new Log();
    $log->info( $_REQUEST['event_name']);
    $logger = new Logger("daily");
    $stream_handler = new StreamHandler(__DIR__ . '/ping.log', Logger::DEBUG);
    // $log->info("Ping",$data);
    $logger->pushHandler($stream_handler);
    $logger->info($_REQUEST['date']);
});
$simotel->eventApi()->addListener('NewState', function ($data) {
    $log = new Log();
    $log->info("NewState", $data);
});

$simotel->eventApi()->dispatch($_REQUEST["event_name"], $_REQUEST);
