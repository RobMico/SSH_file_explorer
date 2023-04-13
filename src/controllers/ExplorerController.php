<?php
namespace app;
require_once __DIR__ . '/../autoloadApp.php';

class ExplorerController{
    public function sendCommand($body){
        if(!property_exists($body, 'command'))
        {
            echo "Command not specified";
        }
        $remote = new RemoteServer();
        $remote->SendCommand($body["command"]);
    }
}