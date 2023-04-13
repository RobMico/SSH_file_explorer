<?php
namespace mymvc\core;
require __DIR__.'/Router.php';
require __DIR__.'/Request.php';

class Application{
    public Router $router;
    public Request $request;

    public function setViewsPath($path){
        $this->router->viewsPath = $path;
    }

    public function __construct(){
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function run(){
        echo $this->router->resolve();
    }

}