<?php
namespace app;
require_once __DIR__ . '/../autoloadApp.php';
class RemoteServer{
    public $host;
    public $port;
    public $username;
    public $password;

    public function SendCommand($command, $isLS=false){
        //send command via ssh
        //if not ls, call ls and return current dir
        //return responce
    }
}