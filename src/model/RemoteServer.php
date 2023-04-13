<?php
namespace app;

use phpseclib3\Net\SSH2;
use phpseclib3\Crypt\PublicKeyLoader;

//sudo ssh -i "Email_server_key.pem" ubuntu@ec2-54-154-51-197.eu-west-1.compute.amazonaws.com

//exit();

class RemoteServer
{

    public function __construct($connectArgs)
    {
        session_start();
        if (isset($_SESSION['ssh'])) {
            $ssh = $_SESSION['ssh'];
        } else {
            $key = null;
            if (isset($_FILES['key']) && $_FILES['key']['error'] == UPLOAD_ERR_OK) {
                // get the uploaded file path
                $tmp_name = $_FILES['key']['tmp_name'];
                // load the private key from the uploaded file
                $key = PublicKeyLoader::load(file_get_contents($tmp_name));
            } elseif (array_key_exists('key', $connectArgs)) {
                $key = $connectArgs['key'];
            }

            if ($key === null || !array_key_exists('host', $connectArgs)||!array_key_exists('port', $connectArgs)||!array_key_exists('username', $connectArgs)) {
                exit('Something was missed');
            }
            // create a new SSH2 instance and connect to the remote server
            $ssh = new SSH2($connectArgs["host"], $connectArgs["port"]);
            if (!$ssh->login($connectArgs['username'], $key)) {
                exit('Login Failed');
            }
            // save the SSH connection object to the session variable
            $_SESSION['ssh'] = $ssh;
        }
        $ssh = $_SESSION['ssh'];
        echo $ssh->exec('pwd');


        // if (isset($_SESSION['ssh'])) {
        //     $ssh = $_SESSION['ssh'];
        // } else {
        //     // check if a file was uploaded
        //     if (isset($_FILES['private_key']) && $_FILES['private_key']['error'] == UPLOAD_ERR_OK) {
        //         // get the uploaded file path
        //         $tmp_name = $_FILES['private_key']['tmp_name'];

        //         // load the private key from the uploaded file
        //         $key = PublicKeyLoader::load(file_get_contents($tmp_name));

        //         // create a new SSH2 instance and connect to the remote server
        //         $ssh = new SSH2('example.com');
        //         if (!$ssh->login('username', $key)) {
        //             exit('Login Failed');
        //         }

        //         // save the SSH connection object to the session variable
        //         $_SESSION['ssh'] = $ssh;
        //     } else {
        //         exit('No file uploaded or file upload error.');
        //     }
        // }



        //$key = PublicKeyLoader::load(file_get_contents(__DIR__.'/../../Email_server_key.pem'));
        //$ssh = new SSH2('ec2-54-154-51-197.eu-west-1.compute.amazonaws.com', 22);
        //if (!$ssh->login('ubuntu', $key)){
        //  exit('Login Failed');
        //}
        //echo $ssh->exec('pwd');
        //$this->connectArgs = $connectArgs;
    }

    public $connectArgs;

    public function SendCommand($command, $isLS = false)
    {
        //send command via ssh
        //if not ls, call ls and return current dir
        //return responce
    }
}