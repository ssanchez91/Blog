<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 23/07/2020
 * Time: 10:21
 */

namespace App\Controller;


use App\Framework\BaseController;

class ErrorController extends BaseController
{
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