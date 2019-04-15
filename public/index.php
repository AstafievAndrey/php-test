<?php

define("PATH_VIEWS", __DIR__ . '/../views/');
define("PATH_COMMON", __DIR__ . '/../common/');
define("PATH_CONTROLLERS", __DIR__ . '/../controllers/');
define("PATH_MODELS", __DIR__ . '/../models/');

global $config; 
$config = require __DIR__ . '/../config/config.php';
require __DIR__ . '/../common/App.php';

$app = new App($config);
$route = filter_input(INPUT_GET, 'r');

if(!empty($route)) {
    $route = explode('/', $route);
    $res = $app->loadController($route);
    if (!is_null($res)) {
        switch ($res['type']) {
            case 'json':
                $app->loadJson($res['data']);
                break;
            default:
                $app->loadView($res[0], $res[1]);
        }
    } else {
        header('Location: index.php');
    }
} else {
    $app->loadDefault();
}