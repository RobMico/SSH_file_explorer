<?php
namespace app;
//require_once __DIR__ . '/../autoloadApp.php';

class ExplorerController{
    public function sendCommand($body){
        if(!array_key_exists('command', $body))
        {
            echo "Command not specified";
            return;
        }
        $remote = new RemoteServer($body);
        $remote->SendCommand($body["command"]);
    }
}