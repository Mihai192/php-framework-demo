<?php


error_reporting(E_ERROR);

require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Core\Router;

Router::get('/', "App\Controllers\PublicController::index");
Router::post('/post-comment', "App\Controllers\PublicController::post");

Router::execute();
