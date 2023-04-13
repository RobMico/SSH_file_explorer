<?php
namespace mymvc\core;

class Request
{
    public function getPath()
    {
        $path = $_SERVER["REQUEST_URI"] ?? '/';
        $position = strpos($path, '?');
        if($position === false){
            return $path;
        }
        $path = substr($path, 0, $position);
        return $path;
    }


    public function getArgs(){
        if($this->getMethod()==="POST")
        {
            return file_get_contents('php://input');
        }
        else{
            return $_GET;
        }
    }

    public function getMethod()
    {
        return $_SERVER["REQUEST_METHOD"];
    }
}



// array(26) { 
//     ["DOCUMENT_ROOT"]=> string(26) "/home/qwerty/Desktop/MySsh" 
//     ["REMOTE_ADDR"]=> string(9) "127.0.0.1" 
//     ["REMOTE_PORT"]=> string(5) "52994" 
//     ["SERVER_SOFTWARE"]=> string(40) "PHP 8.1.2-1ubuntu2.11 Development Server" 
//     ["SERVER_PROTOCOL"]=> string(8) "HTTP/1.1" 
//     ["SERVER_NAME"]=> string(9) "localhost" 
//     ["SERVER_PORT"]=> string(4) "7575" 
//     ["REQUEST_URI"]=> string(8) "/nnn/sss" 
//     ["REQUEST_METHOD"]=> string(3) "GET" 
//     ["SCRIPT_NAME"]=> string(10) "/index.php" 
//     ["SCRIPT_FILENAME"]=> string(36) "/home/qwerty/Desktop/MySsh/index.php" 
//     ["PATH_INFO"]=> string(8) "/nnn/sss" 
//     ["PHP_SELF"]=> string(18) "/index.php/nnn/sss" 
//     ["HTTP_HOST"]=> string(14) "localhost:7575" 
//     ["HTTP_USER_AGENT"]=> string(70) "Mozilla/5.0 (X11; Linux x86_64; rv:106.0) Gecko/20100101 Firefox/106.0" 
//     ["HTTP_ACCEPT"]=> string(85) "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8" 
//     ["HTTP_ACCEPT_LANGUAGE"]=> string(14) "en-US,en;q=0.5" 
//     ["HTTP_ACCEPT_ENCODING"]=> string(17) "gzip, deflate, br" 
//     ["HTTP_CONNECTION"]=> string(10) "keep-alive" 
//     ["HTTP_UPGRADE_INSECURE_REQUESTS"]=> string(1) "1" 
//     ["HTTP_SEC_FETCH_DEST"]=> string(8) "document" 
//     ["HTTP_SEC_FETCH_MODE"]=> string(8) "navigate" 
//     ["HTTP_SEC_FETCH_SITE"]=> string(4) "none" 
//     ["HTTP_SEC_FETCH_USER"]=> string(2) "?1" 
//     ["REQUEST_TIME_FLOAT"]=> float(1681152972.577306) 
//     ["REQUEST_TIME"]=> int(1681152972) 
// } 