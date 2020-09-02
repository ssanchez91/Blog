<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 02/07/2020
 * Time: 11:58
 */
use App\Framework;
use App\Framework\Router;
use App\Framework\HttpRequest;

require 'Model/Autoloader.php';
Autoloader::register();
session_start();
$fileConfig = file_get_contents('Config/config.json');
$routeFiles = json_decode($fileConfig)->routeFiles;
$router = new Router($routeFiles);

try {
    $httpRequest = new HttpRequest();
    $httpRequest->setRoute($router->findRoute($httpRequest, json_decode($fileConfig)->basePath));
    $httpRequest->bindParams(json_decode($fileConfig)->basePath);
    $httpRequest->run($fileConfig);
} catch (Exception $e) {
    $httpRequest = new HttpRequest('/showError', 'GET');
    $httpRequest->setRoute($router->findRoute($httpRequest, json_decode($fileConfig)->basePath));
    $httpRequest->bindParams(json_decode($fileConfig)->basePath);
    $httpRequest->addParams($e);
    $httpRequest->run($fileConfig);
}
