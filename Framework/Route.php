<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 02/07/2020
 * Time: 11:57
 */

namespace App\Framework;

use App\Framework\Exception\ActionNotFoundException;
use App\Framework\Exception\AuthenticationRequiredException;
use App\Framework\Exception\ControllerNotFoundException;
use App\Framework\Exception\ForbiddenAccessException;
use App\Model\Manager\RoleManager;

class Route
{
    private $name;
    private $controller;
    private $url;
    private $method;
    private $action;
    private $params;
    private $manager;
    private $role;


    public function __construct($route)
    {
        $this->setName($route->name);
        $this->setController($route->controller);
        $this->setUrl($route->url);
        $this->setMethod($route->method);
        $this->setAction($route->action);
        $this->setParams($route->params);
        $this->setManager($route->manager);
        $this->setRole((!isset($route->role)) ? null : $route->role);
    }

    public function run($httpRequest, $config)
    {
        if (empty($this->role)) {
            $this->callAction($httpRequest, $config);
        } else {
            if (empty($_SESSION['user'])) {
                throw new AuthenticationRequiredException();
            } else {
                $user = $_SESSION['user'];

                if ($user->hasRole($this->getRole())) {
                    $this->callAction($httpRequest, $config);
                } else {
                    throw new ForbiddenAccessException();
                }
            }
        }
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param mixed $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param mixed $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * @param mixed $manager
     */
    public function setManager($manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    private function callAction($httpRequest, $config)
    {
        $controller = null;
        $controllerName = 'App\\Controller\\' . $this->controller . 'Controller';
        if (class_exists($controllerName)) {
            $controller = new $controllerName($httpRequest, $config);
            if (method_exists($controller, $this->action . 'Action')) {
                return call_user_func_array([$controller, $this->action . 'Action'], $httpRequest->getParams());
            } else {
                throw new ActionNotFoundException();
            }
        } else {
            throw new ControllerNotFoundException();
        }
    }


}