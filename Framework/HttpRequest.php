<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 02/07/2020
 * Time: 11:56
 */

namespace App\Framework;

/**
 * Class HttpRequest
 *
 * @package App\Framework
 */
class HttpRequest
{
    /**
     * Variable url
     *
     * @var null
     */
    private $url;

    /**
     * Variable params
     *
     * @var
     */
    private $params;

    /**
     * Variable method
     * @var
     */
    private $method;

    /**
     * Variable route
     * @var
     */
    private $route;

    /**
     * Constructor
     *
     * @param null $url
     * @param null $method
     */
    public function __construct($url = null, $method = null)
    {
        $this->url = ($url === null) ? $_SERVER['REQUEST_URI'] : $url;
        $this->method = ($method === null) ? $_SERVER['REQUEST_METHOD'] : $method;
        $this->params = array();
    }

    /**
     * Method bindParams
     *
     * @param string $basepath basepath of the app
     * @throws \Exception
     */
    public function bindParams($basepath)
    {
        $this->bindRouteParam($basepath);
        $this->bindHttpParam();
    }

    /**
     * method bindRouteParam
     * @param string $basepath basepath of the app
     */
    public function bindRouteParam($basepath)
    {
        $url = str_replace($basepath, "", $this->url);
        preg_match_all('#^' . $this->route->getUrl() . '$#', $url, $listParam);

        for ($i = 1; $i < count($listParam); $i++) {
            $this->params[] = htmlspecialchars($listParam[$i][0]);
        }
    }

    /**
     * Method bindHttpParam
     *
     * @throws \Exception
     */
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

    /**
     * Method run
     *
     * @param $config
     */
    public function run($config)
    {
        $this->route->run($this, $config);
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
     * Accessor getMethod
     *
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Accessor getRoute
     *
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Accessor setRoute
     *
     * @param mixed $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
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
     * Method addParams
     *
     * @param mixed $value param
     */
    public function addParams($value)
    {
        $this->params[] = $value;
    }
}