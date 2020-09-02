<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 02/07/2020
 * Time: 14:14
 */
namespace App\Controller;

use App\Framework\BaseController;
use App\Framework\Exception\NoRouteFileFoundException;
use App\Framework\HttpRequest;
use App\Framework\Router;
use App\Model\Entity\Alert;


class DefaultController extends BaseController
{
    public function defaultAction()
    {
        $this->view('default');
    }
}