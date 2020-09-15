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

/**
 * Class BaseController
 *
 * @package App\Framework
 */
class BaseController
{
    /**
     * HttpRequest Object
     *
     * @var HttpRequest
     */
    protected $httpRequest;

    /**
     * List of param
     *
     * @var array
     */
    private $param;

    /**
     * Config Json File
     *
     * @var mixed
     */
    private $config;

    /**
     * FileManager Object
     *
     * @var FileManager
     */
    protected $fileManager;

    /**
     * MailManager Object
     *
     * @var MailManager
     */
    protected $mailManager;

    /**
     * AlertManager Object
     *
     * @var AlertManager
     */
    protected $alertManager;

    /**
     * Variable manager
     *
     * @var
     */
    protected $manager;

    /**
     * Variable User
     *
     * @var
     */
    protected $user;

    /**
     * Constructor
     *
     * @param HttpRequest $httpRequest Content HttpRequest Object
     * @param object $config Config Json File
     */
    public function __construct(HttpRequest $httpRequest, $config)
    {
        $this->httpRequest = $httpRequest;
        $this->config = json_decode($config);
        $this->fileManager = new FileManager();
        $this->mailManager = new MailManager(json_decode($config)->mailManager);
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

    /**
     * Method view
     *
     * Display asked view
     *
     * @param string $filename filename of the view
     * @param bool|false $partial if you want include partial view
     * @param bool|false $shared if you want include shared view
     * @throws NoViewFoundException No view found with this name
     */
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

    /**
     * Method partialView
     *
     * @param string $filename filename of the view
     * @throws NoViewFoundException No view found with this name
     */
    public function partialView($filename)
    {
        $this->view($filename, true);
    }

    /**
     * Method sharedView
     *
     * @param string $filename filename of the shared view
     * @param string $directory folder of this view
     * @throws NoViewFoundException No view found with this name
     */
    public function sharedView($filename, $directory)
    {
        $this->view($directory . '/' . $filename, true, true);
    }

    /**
     * Method loadCssAndJsFile
     *
     * @param string $filename filename of the js or css file to load
     */
    public function loadCssAndJsFile($filename)
    {
        $listExt = ['css', 'js'];
        foreach ($listExt as $ext) {
            if (file_exists("./View/" . $this->httpRequest->getRoute()->getController() . "/" . $ext . "/" . $filename . "." . $ext . "")) {
                $this->addCss($this->config->basePath . "../View/" . $this->httpRequest->getRoute()->getController() . "/" . $ext . "/" . $filename . "." . $ext . "");
            }
        }
    }

    /**
     * Method BindManager
     *
     * Allow to instance manager
     */
    public function bindManager()
    {
        foreach ($this->httpRequest->getRoute()->getManager() as $manager) {
            $manager = 'App\\Model\\Manager\\' . $manager;
            $instance = new $manager($this->config->dataBase);
            $shortName = (new \ReflectionClass($instance))->getShortName();
            $this->$shortName = $instance;
        }
    }

    /**
     * Method addParam
     *
     * @param string $key Key of array
     * @param string $value value or array
     */
    public function addParam($key, $value)
    {
        $this->param[$key] = $value;
    }

    /**
     * Method addCss
     *
     * @param mixed $file Add css File
     */
    public function addCss($file)
    {
        $this->fileManager->addCssFile($file);
    }

    /**
     * Method addJs
     *
     * @param mixed $file Add js file
     */
    public function addJs($file)
    {
        $this->fileManager->addJsFile($file);
    }

    /**
     * Method setUser
     *
     * @param \App\Model\Entity\User $user User Object
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Method getConfig
     *
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }
}