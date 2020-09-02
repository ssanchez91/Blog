<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 02/07/2020
 * Time: 11:56
 */

namespace App\Framework;


class HttpRequest
{
    private $url;
    private $params;
    private $method;
    private $route;


    public function __construct($url = null, $method = null)
    {
        $this->url = ($url === null) ? $_SERVER['REQUEST_URI'] : $url;
        $this->method = ($method === null) ? $_SERVER['REQUEST_METHOD'] : $method;
        $this->params = array();
    }

    public function bindParams($basepath)
    {
        $this->bindRouteParam($basepath);
        $this->bindHttpParam();
    }

    public function bindRouteParam($basepath)
    {
        $url = str_replace($basepath, "", $this->url);
        preg_match_all('#^' . $this->route->getUrl() . '$#', $url, $listParam);

        for ($i = 1; $i < count($listParam); $i++) {
            $this->params[] = htmlspecialchars($listParam[$i][0]);
        }
    }

    public function bindHttpParam()
    {
        switch ($this->method) {
            case 'GET':
            case 'DELETE':
                foreach ($this->route->getParams() as $key => $param) {
                    if (!empty($_GET[$param])) {
                        $this->params[$param] = htmlspecialchars($_GET[$param]);
                    } else {
                        throw new \Exception('Parameter not found !');
                    }
                };
                break;

            case 'POST':
            case 'PUT':
                foreach ($this->route->getParams() as $key => $param) {
                    if (!empty($_POST[$param])) {
                        $this->params[$param] = htmlspecialchars($_POST[$param]);
                    } else {
                        throw new \Exception('Parameter not found ' . $_POST[$param] . ' !');
                    }
                };
                break;
        }
    }

    public function run($config)
    {
        $this->route->run($this, $config);
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    public function addParams($value)
    {
        $this->params[] = $value;
    }
}