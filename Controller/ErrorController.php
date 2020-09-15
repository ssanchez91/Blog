<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 23/07/2020
 * Time: 10:21
 */

namespace App\Controller;


use App\Framework\BaseController;

/**
 * Class ErrorController
 *
 * @package App\Controller
 */
class ErrorController extends BaseController
{
    /**
     * Method showError
     *
     * Display error for user
     *
     * @param \App\Framework\Exception\ $exception class name exception
     * @throws \App\Framework\Exception\NoViewFoundException No view found with this name
     */
    public function showErrorAction($exception)
    {
        $className = str_replace('App\\Framework\\Exception\\', '', get_class($exception));

        if (file_exists('..' . $this->getConfig()->basePath . '/View/Error/' . $className . 'View.php')) {
            $this->addParam('exception', $exception);
            $this->view($className);
        } else {
            $this->addParam('exception', $exception);
            $this->view('showError');
        }
    }
}