<?php
namespace app;

use phpseclib3\Net\SSH2;
use phpseclib3\Crypt\PublicKeyLoader;
use phpseclib3\Crypt\RSA\PrivateKey;

//sudo ssh -i "Email_server_key.pem" ubuntu@ec2-54-154-51-197.eu-west-1.compute.amazonaws.com

//exit();

class RemoteServer
{
    protected $ssh;
    public function __construct($connectArgs)
    {
        new SSH2('');
        $this->ssh = null;
        if (isset($_SESSION['ssh'])) {
            $this->ssh = $this->__connect($_SESSION);
        } else {
            $this->ssh = $this->__connect($connectArgs);
        }

        if ($this->ssh === null) {
            session_destroy();
            exit("Session is null");
        }

        //echo $this->ssh->exec('pwd');

    }

    protected function __connect($args)
    {
        $key = null;
        
        if (isset($_FILES['key']) && $_FILES['key']['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['key']['tmp_name'];
            $key = file_get_contents($tmp_name);
            $key_password = $args['key_password'] ?? false;

            $_SESSION['key_password'] = $key_password;
            $_SESSION['key'] = $key;
            $_SESSION['Key_not_password'] = true;

            $key = PublicKeyLoader::load($key, $key_password = false);
        } elseif(array_key_exists('key', $args)){
            $key = $args['key'];
            if ($args['Key_not_password'] ?? false) {
                $key_password = $args['key_password'] ?? false;
                $key = PublicKeyLoader::load($key, $key_password = false);
            } else {
                $_SESSION['key'] = $key;
            }
        }

        var_dump(isset($_FILES['key']));
        var_dump(array_key_exists('key', $args));

        $username = $args['username'] ?? null;
        $port = $args["port"];
        $host = $args["host"];

        if ($username === null || $host === null || $port === null || $key === null) {
            session_destroy();
            exit("Some argument missed");
        }

        try {
            $ssh = new SSH2($host, $port);
            if (!$ssh->login($username, $key)) {
                session_destroy();
                exit('Login Failed');
            } { //save to session
                $_SESSION["ssh"] = true;
                $_SESSION["port"] = $port;
                $_SESSION["host"] = $host;
                $_SESSION["username"] = $username;
            }
        } catch (\RuntimeException $e) {
            session_destroy();
            exit('Login Failed');
        } catch (\Throwable $e) {
            session_destroy();
            exit('Login Failed');
        }
        return $ssh;
    }
    public function SendCommand($command, $isLS = false)
    {
        return $this->ssh->exec($command);
        //send command via ssh
        //if not ls, call ls and return current dir
        //return responce
    }
}