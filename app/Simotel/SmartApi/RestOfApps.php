<?php
namespace App\Simotel\SmartApi;

use Simotel\SmartApi\Commands;

class RestOfApps{
    use Commands;

    public function getData(){

        
         $this->cmdGetData('thank tou',10,1);
         $this->cmdExit('go-s2');
    }
}