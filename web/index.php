<?php

// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

define('ROOTDIR', __DIR__ . '/..');

spl_autoload_register(function($className) {
    $class = str_replace('\\', '/', $className);
    $file = current(array_filter([
        ROOTDIR . '/src/' . $class . '.php',
        ROOTDIR . '/vendor/' . $class . '.php',
    ], 'file_exists'));
    if (false !== $file) {
        require_once($file);
    }
});

use PHPSkel\Router;
use PHPSkel\Request;
use PHPSkel\Response;

session_start();

$request = Request::generate();

$router = new Router(__DIR__ . '/..');
$response = $router->route($request);
if ($response instanceof Response) {
    $response->send();
}
