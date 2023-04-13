<?php

require __DIR__.'/src/core/Application.php';
use mymvc\core\Application;

$app = new Application();

$app->setViewsPath(__DIR__.'/src/views');

$app->router->get('/', function(){
    return 'HELLO WORLD';
});

$app->router->get('/test', 'contact');

$app->run();