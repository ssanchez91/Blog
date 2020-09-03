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

    public function getStats($user)
    {
        $stats = new \stdClass();

        if ($user->hasRole('admin')) {
            $stats->nbUserTot = $this->userManager->countUser();
            $stats->nbUserEnabled = $this->userManager->countUserEnabled();
            $stats->nbUserDisabled = $this->userManager->countUserDisabled();
            $stats->nbPost = $this->postManager->countPosts();
            $stats->nbCommentTot = $this->commentManager->countComment();
            $stats->nbCommentPublished = $this->commentManager->countCommentPublished(1);
            $stats->nbCommentBanned = $this->commentManager->countCommentPublished(0);;
        }

        $stats->nbPostWritten = $this->postManager->countPosts($user->getId());
        $stats->nbCommentWritten = $this->commentManager->countComment($user->getId());

        return $stats;
    }
}