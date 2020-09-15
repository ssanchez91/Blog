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

/**
 * Class AdminController
 * 
 * @package App\Controller
 */
class AdminController extends BaseController
{
    /**
     * Method showAdminSettings
     * @throws \App\Framework\Exception\NoViewFoundException No view found with this name
     */
    public function showAdminSettingsAction()
    {
        $stats = $this->AdminManager->getStats($this->user);
        $this->addParam('stats', $stats);
        return $this->view('admin');
    }
}