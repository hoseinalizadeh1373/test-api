<?php
// دریافت مقادیر ارسال شده از طریق POST
$serverAddress = $_POST['serverAddress'];
$token = $_POST['token']??"";
$username = $_POST['username']??"";
$password = $_POST['password']??"";
$tokenType = $_POST['tokenType'];

// ایجاد یک آرایه با مقادیر دریافتی
$data = array(
    'simotelApi'=>[
    'server_address' => $serverAddress,
    'api_key' => $token,
    'api_user' => $username,
    'api_pass' => $password,
    'api_auth' => $tokenType
    ]
);

// تبدیل آرایه به رشته JSON
$jsonString = json_encode($data);

// ذخیره فایل JSON
$file = 'data.json';
file_put_contents($file, $jsonString);
?>