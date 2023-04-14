<?php
namespace app;
//require_once __DIR__ . '/../autoloadApp.php';

class TerminalController{
    public function sendCommand($body){
        if(!$body['command']??false)
        {
            echo "Command not specified";
            return;
        }
        session_start();
        $responce=array();
        $command = $body['command'];
        $dir = $body['dir']??false;

        $remote = new RemoteServer($_SESSION);
        if($dir)
        {
            //echo 'cd '.$dir;
            $remote->SendCommand('cd '.$dir);
        }
        $responce["result"] = $remote->SendCommand($command);
        $responce["dir"] = $remote->SendCommand('ls');

        var_dump($responce);
        echo json_encode($responce);
    }
}