<?php

use App\Router;
use App\Request;

require_once "./vendor/autoload.php";
$request = new Request();
$request->init();
$router = Router::getInstance();
$router->dispatch($request);