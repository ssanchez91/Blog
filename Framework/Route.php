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

/**
 * Class Route
 *
 * @package App\Framework
 */
class Route
{

    /**
     * Variable name
     * @var
     */
    private $name;
    /**
     * Variable controller
     * @var
     */
    private $controller;
    /**
     * Variable url
     * @var
     */
    private $url;
    /**
     * Variable method
     * @var
     */
    private $method;
    /**
     * variable action
     * @var
     */
    private $action;
    /**
     * variable params
     * @var
     */
    private $params;
    /**
     * variable manager
     * @var
     */
    private $manager;
    /**
     * variable role
     * @var
     */
    private $role;

    /**
     * Constructor
     * @param object $route route object
     */
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

    /**
     * Method run
     *
     * @param object $httpRequest HttpRequest Object
     * @param Object $config Json File Config
     * @throws ActionNotFoundException
     * @throws AuthenticationRequiredException
     * @throws ControllerNotFoundException
     * @throws ForbiddenAccessException
     *
     */
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
     * Accessor getName
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Accessor setName
     *
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Accessor getController
     *
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Accessor setController
     *
     * @param mixed $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * Accessor getUrl
     *
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Accessor setUrl
     *
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Accessor getMethod
     *
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Accessor setMethod
     *
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * Accessor getParams
     *
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Accessor setParams
     *
     * @param mixed $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * Accessor getAction
     *
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Accessor setAction
     *
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * Accessor getManager
     *
     * @return mixed
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * Accessor setManager
     *
     * @param mixed $manager
     */
    public function setManager($manager)
    {
        $this->manager = $manager;
    }

    /**
     * Accessor getRole
     *
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Accessor setRole
     *
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * Method Call
     *
     * @param object $httpRequest HttpRequest Object
     * @param object $config Json File object
     * @return mixed
     * @throws ActionNotFoundException
     * @throws ControllerNotFoundException
     */
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