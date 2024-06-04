<?php


return [
    'smartApi' => [
        'apps' => [
            'sayDate' => "\App\Simotel\SmartApi\SayDateSmartApiApp",
            '*' => "\App\Simotel\SmartApi\SmartApiApp",
        ],
    ],
    'ivrApi' => [
        'apps' => [
            '*' => "\App\Simotel\IvrApiApp",
        ],
    ],
    'trunkApi' => [
        'apps' => [
            '*' => "\App\Simotel\TrunkApiApp",
        ],
    ],
    'extensionApi' => [
        'apps' => [
            '*' => "\App\Simotel\ExtensionApiApp",
        ],
    ],
    'simotelApi' => [
        'api_auth' => 'apikey',
        'api_user' => 'hosein',
        'api_pass' => 'Hosein101',
        'api_key' => 'v444dbrVrLHvlBYTG6I6rcJ9Bseuttk8f309Etx7hv6OEjeMsD',
        'server_address' => 'http://185.141.215.62:8029/api/v4/',
    ],
   
];
