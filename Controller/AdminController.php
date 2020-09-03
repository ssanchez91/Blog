<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 26/08/2020
 * Time: 12:02
 */

namespace App\Controller;


use App\Framework\BaseController;
use App\Model\Manager\AdminManager;

class AdminController extends BaseController
{
    public function showAdminSettingsAction()
    {
        return $this->view('admin');
    }
}