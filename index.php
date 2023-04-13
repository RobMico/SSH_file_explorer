<?php

require_once __DIR__ . '/src/core/Application.php';
require_once __DIR__ . '/src/controllers/ExplorerController.php';
require_once __DIR__ . '/src/controllers/TerminalController.php';
require_once __DIR__ . '/src/controllers/ServerController.php';

use mymvc\core\Application;
use app\ExplorerController;
use app\TerminalController;
use app\ServerController;

$explorerController = new ExplorerController();
$terminalController = new TerminalController();
$serverController = new ServerController();


$app = new Application();

$app->setViewsPath(__DIR__ . '/src/views');

$app->router->get('/connect', [$serverController, 'Connect']);
$app->router->get('/', [$serverController, 'GetView']);
$app->router->post('/explorer', [$explorerController, 'sendCommand']);
$app->router->post('/terminal', [$terminalController, 'sendCommand']);

$app->run();