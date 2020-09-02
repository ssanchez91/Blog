<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 02/07/2020
 * Time: 11:57
 */

namespace App\Framework;

use App\Framework\Exception\MultipleRouteFoundException;
use App\Framework\Exception\NoRouteFoundException;
use App\Framework\HttpRequest;


class Router
{
    private $routeFiles;
    private $listRoutes = [];

    public function __construct($routeFiles)
    {
        foreach ($routeFiles as $route) {
            $this->routeFiles[] = file_get_contents($route . 'Controller.json');
        }

        foreach ($this->routeFiles as $routeFile) {
            $routeFile = json_decode($routeFile);
            foreach ($routeFile as $routeRow) {
                array_push($this->listRoutes, $routeRow);
            }
        }
    }

    public function findRoute($httpRequest, $basepath, $fullRoute = true)
    {
        $url = str_replace($basepath, "", $httpRequest->getUrl());
        $method = $httpRequest->getMethod();

        $resultRoute = array_filter($this->listRoutes, function ($route) use ($url, $method, $fullRoute) {
            if ($fullRoute) {
                return preg_match('#^' . $route->url . '$#', $url) && $route->method == $method;
            } else {
                return preg_match('#' . $url . '#', $route->url) && $route->method == $method;
            }
        });

        $nbrResultRoute = count($resultRoute);
        if ($nbrResultRoute > 1) {
            throw new MultipleRouteFoundException();
        } else if ($nbrResultRoute == 0) {
            throw new NoRouteFoundException();
        } else {
            return new Route(array_shift($resultRoute));
        }
    }
}