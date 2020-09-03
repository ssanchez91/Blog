<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 26/08/2020
 * Time: 15:50
 */

namespace App\Model\Manager;


class AdminManager
{

    private $userManager;
    private $roleManager;

    public function __construct()
    {
        $config = file_get_contents('Config/config.json');
        $this->userManager = new UserManager($config);
        $this->roleManager = new RoleManager($config);
        $this->commentManager = new CommentManager($config);
        $this->postManager = new PostManager($config);
    }
}