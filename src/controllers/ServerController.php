<?php
namespace app;
//require_once __DIR__ . '/../autoloadApp.php';

class ServerController{
    public function Connect($body){
        $rempte = new RemoteServer($_POST);
    }

    public function GetView($args){
        echo "GET VIEW";
    }
}