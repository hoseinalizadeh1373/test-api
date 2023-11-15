<?php

require("./vendor/autoload.php");

use Simotel\Simotel;
use App\Log;
use Monolog\Logger; // The Logger instance
use Monolog\Handler\StreamHandler;

$simotel = new Simotel();

$json = file_get_contents('php://input');
$data =json_decode($json,true);

$simotel->eventApi()->addListener('Ping', function ($json) {
    $json = file_get_contents('php://input');

    $logger = new Logger("daily");
    $stream_handler = new StreamHandler(__DIR__ . '/pings.log', Logger::DEBUG);
    
    $logger->pushHandler($stream_handler);
    $logger->info($json);
});

$simotel->eventApi()->dispatch($data['event_name'], $_REQUEST);
