<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 15/07/2020
 * Time: 10:47
 */

namespace App\Framework;

use App\Framework\Exception\AuthenticationRequiredException;
use App\Framework\Exception\NoViewFoundException;
use App\Model\Entity\Role;
use App\Model\Manager\RoleManager;

class BaseController
{
    /**
     * @var HttpRequest
     */
    protected $httpRequest;
    private $param;
    private $config;
    protected $fileManager;
    protected $mailManager;
    protected $alertManager;
    protected $manager;
    protected $user;


    public function __construct(HttpRequest $httpRequest, $config)
    {
        $this->httpRequest = $httpRequest;
        $this->config = json_decode($config);
        $this->fileManager = new FileManager();
        $this->mailManager = new MailManager();
        $this->param = array();
        $this->addParam('httpRequest', $this->httpRequest);
        $this->addParam('config', $this->config);
        $this->addParam('controller', $this);
        $this->bindManager();

        if (!empty($_SESSION['alert'])) {
            $this->alertManager = new AlertManager($_SESSION['alert']);
        } else {
            $this->alertManager = new AlertManager();
        }

        $this->user = null;
        if (!empty($_SESSION['user'])) {
            $this->user = $_SESSION['user'];
            $this->addParam('user', $this->user);
        }
    }

    protected function view($filename, $partial = false, $shared = false)
    {
        $this->loadCssAndJsFile($filename);
        if (file_exists("./View/" . $this->httpRequest->getRoute()->getController() . "/" . $filename . 'View.php') || file_exists("./View/" . $filename . 'View.php')) {
            ob_start();
            extract($this->param);
            if (!$shared) {
                include("./View/" . $this->httpRequest->getRoute()->getController() . "/" . $filename . 'View.php');
            } else {
                include("./View/" . $filename . 'View.php');
            }
            $content = ob_get_clean();
            if (!$partial) {
                $this->fileManager->addJsFile($this->config->basePath . '../View/base.js');
                $this->fileManager->addCssFile($this->config->basePath . '../View/base.css');
                extract(array('config' => $this->config, 'fileManager' => $this->fileManager, 'alertManager' => $this->alertManager, 'mailManager' => $this->mailManager, 'user' => $this->user));
                include("./View/base.php");
            } else {
                echo $content;
            }
        } else {
            throw new NoViewFoundException();
        }
    }

    public function partialView($filename)
    {
        $this->view($filename, true);
    }

    public function sharedView($filename, $directory)
    {
        $this->view($directory . '/' . $filename, true, true);
    }

    public function loadCssAndJsFile($filename)
    {
        $listExt = ['css', 'js'];
        foreach ($listExt as $ext) {
            if (file_exists("./View/" . $this->httpRequest->getRoute()->getController() . "/" . $ext . "/" . $filename . "." . $ext . "")) {
                $this->addCss($this->config->basePath . "../View/" . $this->httpRequest->getRoute()->getController() . "/" . $ext . "/" . $filename . "." . $ext . "");
            }
        }
    }

    public function bindManager()
    {
        foreach ($this->httpRequest->getRoute()->getManager() as $manager) {
            $manager = 'App\\Model\\Manager\\' . $manager;
            $instance = new $manager($this->config->dataBase);
            $shortName = (new \ReflectionClass($instance))->getShortName();
            $this->$shortName = $instance;
        }
    }

    public function addParam($key, $value)
    {
        $this->param[$key] = $value;
    }

    public function addCss($file)
    {
        $this->fileManager->addCssFile($file);
    }

    public function addJs($file)
    {
        $this->fileManager->addJsFile($file);
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getConfig()
    {
        return $this->config;
    }
}