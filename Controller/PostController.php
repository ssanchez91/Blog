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

    /**
     * @param $id
     * @throws \Exception
     */
    public function deletePostAction($id)
    {
        try {
            $post = $this->PostManager->getById($id);
            if ($this->user->hasRole('admin') || ($this->user->hasRole('author') && $post->user_id == $this->user->getId())) {
                $deletePost = $this->PostManager->delete($post);
                $this->alertManager->addAlert('The post with Id ' . $id . ' has just been deleted.', 'danger');
                header('location: ' . $this->getConfig()->basePath . '/listPost/1');
            } else {
                throw new ForbiddenAccessActionException();
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $id
     * @throws ForbiddenAccessActionException
     * @throws \App\Framework\Exception\NoViewFoundException
     */
    public function editPostAction($id)
    {
        $post = $this->PostManager->getById($id);
        if (($this->user->hasRole('admin')) || ($this->user->hasRole('author') && $post->user_id == $this->user->getId())) {
            $this->addParam('post', $this->PostManager->getById($id));
            $this->addParam('listAuthor', $this->UserManager->listUserByRole('author'));
            $this->view('editPost');
        } else {
            throw new ForbiddenAccessActionException();
        }
    }

    /**
     * @param $id
     * @param $title
     * @param $hat
     * @param $content
     * @param $author
     * @throws \Exception
     */
    public function updatePostAction($id, $title, $hat, $content, $author)
    {
        $lastUpdate = new \DateTime();

        $post = new Post();
        $post->setId($id);
        $post->setTitle($title);
        $post->setContent($content);
        $post->setHat($hat);
        $post->setUserId($author);
        $post->setLastUpdate($lastUpdate->format('Y-m-d H:i:s'));

        try {
            $updatePost = $this->PostManager->update($post, array('title', 'hat', 'content', 'user_id', 'last_update'));
            $this->alertManager->addAlert('Your post has been update with success!', 'success');
            $this->addParam('post', $post);
            header('location: ' . $this->getConfig()->basePath . '/showPost/' . $post->getId() . '/1');
        } catch (\Exception $e) {
            throw $e;
        }
    }
}