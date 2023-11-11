<?php

require("./vendor/autoload.php");

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
    // $log->info($res);
    $logger = new Logger("daily");

    $stream_handler = new StreamHandler(__DIR__ . '/app.log', Logger::DEBUG);
    $logger->pushHandler($stream_handler);

    $logger->info($res);
} catch(Exception $ex) {
    $log->error($ex->getMessage());
    die($ex->getMessage());
}

$logFile = 'logs.log';
$logContent = file_get_contents($logFile);

// استخراج تمام لاگ‌ها با استفاده از Regex
$pattern = '/\[(.*?)\] name.(.*?): (.*?})/';
preg_match_all($pattern, $logContent, $matches, PREG_SET_ORDER);



?>




<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="
https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js
"></script>
<head>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
</head>
</head>
<body>
<html>
  <head>
    <title>محتویات فایل لاگ</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body class="container" dir="rtl">
    <div id="logContents"></div>
    <!-- <button id="refreshButton">بروزرسانی</button> -->

    <table class="table">
  <thead>
    <tr>
      <th scope="col">تاریخ</th>
      <th scope="col">نوع</th>
      <th scope="col">پیام</th>
    </tr>
  </thead>
  <tbody>
    <?php
  foreach ($matches as $match) {
      $date = $match[1];
      $type = $match[2];
      $message = $match[3];

      $jsonData = json_decode($message);
      $success = $jsonData->success;
      $message = $jsonData->message;

      echo '<tr>
      <td>' . $date . '</td>
      <td>' . $type . '</td>
      <td>' . $message . '</td>
    </tr>';
  }
?>
</tbody>
</table>
  </body>
</html>

<script>

</script>
</body>
</html>
