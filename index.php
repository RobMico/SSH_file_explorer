<?php

require __DIR__ . '/src/autoloadApp.php';
require __DIR__ . '/vendor/autoload.php';
require __DIR__.'/src/core/Application.php';

use mymvc\core\Application;
use app\ExplorerController;
use app\TerminalController;
use app\ServerController;


$explorerController = new ExplorerController();
$terminalController = new TerminalController();
$serverController = new ServerController();


$app = new Application();

$app->setViewsPath(__DIR__ . '/src/views');


$app->router->get('/auth', 'connect.html');


$app->router->post('/connect', [$serverController, 'Connect']);
$app->router->get('/', [$serverController, 'GetView']);
$app->router->post('/explorer', [$explorerController, 'sendCommand']);
$app->router->post('/terminal', [$terminalController, 'sendCommand']);

$app->run();