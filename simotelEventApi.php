<?php

require("./vendor/autoload.php");

use NasimTelecom\Simotel\Simotel;
use App\Log;


$simotel = new Simotel();

$simotel->eventApi()->addListener('Ping', function ($data) {
    $log= new Log;
    $log->info("Ping",$data);
});
$simotel->eventApi()->addListener('NewState', function ($data) {
    $log= new Log;
    $log->info("NewState",$data);
});

$simotel->eventApi()->dispatch($_REQUEST["event_name"], $_REQUEST);