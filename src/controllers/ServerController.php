<?php
namespace app;
//require_once __DIR__ . '/../autoloadApp.php';

class ServerController{
    public function Connect($body){
        session_start();
        $rempte = new RemoteServer($_POST);
        header('Location: /');
    }

    public function GetView($args){
        session_start();
        if(isset($_SESSION['ssh']))
        {
            require __DIR__.'/../views/main.html';
        }
        else{
            require __DIR__.'/../views/connect.html';
        }
    }
}