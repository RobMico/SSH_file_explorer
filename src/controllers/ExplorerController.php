<?php
namespace app;
//require_once __DIR__ . '/../autoloadApp.php';

class ExplorerController{
    public function sendCommand($body){
        if(!$body['command']??false)
        {
            echo "Command not specified";
            return;
        }
        session_start();
        $responce=array();
        $command = $body['command'];
        $dir = $body['dir']??'';

        $remote = new RemoteServer($_SESSION);
        if($dir)
        {
            //echo 'cd '.$dir;
            $remote->SendCommand('cd '.$dir.';');
        }
        $responce["result"] = $remote->SendCommand('cd '.$dir.';'.$command);
        $responce["dir"] = $remote->SendCommand('cd '.$dir.';ls');

        echo json_encode($responce);
    }
}