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

class PostController extends BaseController
{
    /**
     * @throws \App\Framework\Exception\NoViewFoundException
     */
    public function showFormAddPostAction()
    {
        $this->view('showFormAddPost');
    }

    /**
     * @param $title
     * @param $hat
     * @param $content
     * @throws \Exception
     */
    public function addPostAction($title, $hat, $content)
    {
        $lastUpdate = new \DateTime();
        $post = new Post();
        $post->setTitle($title);
        $post->setHat($hat);
        $post->setContent($content);
        $post->setAuthor($this->user->getFirstname() . ' ' . $this->user->getLastname());
        $post->setUserId($this->user->getId());
        $post->setLastUpdate($lastUpdate->format('Y-m-d H:i:s'));

        try {
            $this->PostManager->insert($post, array('title', 'hat', 'content', 'user_id', 'last_update'));
            $this->alertManager->addAlert('Your post has been added with success!', 'success');
            header('location: ' . $this->getConfig()->basePath . '/addPost');
        } catch (\Exception $e) {
            throw $e;
        }
    }
}