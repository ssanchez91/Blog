<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 03/08/2020
 * Time: 15:58
 */

namespace App\Controller;


use App\Framework\BaseController;
use App\Framework\Exception\ForbiddenAccessActionException;
use App\Framework\Exception\ForbiddenAccessException;
use App\Framework\Exception\PageNotFoundException;
use App\Model\Entity\Alert;
use App\Model\Entity\Post;

/**
 * Class AchievementController
 *
 * @package App\Controller
 */
class AchievementController extends BaseController
{
    /**
     * List Achievements
     *
     * @throws \App\Framework\Exception\NoViewFoundException
     */
    public function listAchievementAction()
    {
        //$result = $this->AchievementManager->listAchievement();

        $this->addParam('url', $this->getConfig()->basePath.'/listAchievement/');
        $this->view('listAchievement');

    }
}