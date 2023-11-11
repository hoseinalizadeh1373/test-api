<?php

namespace App\Simotel\SmartApi;

use \Simotel\SmartApi\Commands;

class SmartApiApp{
    
    use Commands;

    public function sayHello($data){
       $this->cmdPlayAnnouncement("hellow");
       return $this->okResponse();
    }
}