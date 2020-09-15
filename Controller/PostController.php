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
 * Class PostController
 *
 * @package App\Controller
 */
class PostController extends BaseController
{
    /**
     * Method showFormAddPost
     *
     * Display form to add a post.
     *
     * @throws \App\Framework\Exception\NoViewFoundException No view found with this name
     */
    public function showFormAddPostAction()
    {
        $this->view('showFormAddPost');
    }

    /**
     * Method addPost
     *
     * Insert the post in database.
     *
     * @param string $title Title post
     * @param string $hat Hat post
     * @param string $content Content post
     * @throws \Exception Display default exception
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
     * Method deletePost
     *
     * Delete post in database.
     *
     * @param int $id Post Id
     * @throws \Exception Display default exception
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
     * Method editPost
     *
     * Display form to edit a post
     *
     * @param int $id Post Id
     * @throws ForbiddenAccessActionException You are not authorized to execute this action on this object !
     * @throws \App\Framework\Exception\NoViewFoundException No view found with this name
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
     * Method updatePost
     *
     * Update the post in database.
     *
     * @param int $id Post Id
     * @param string $title Post Title
     * @param string $hat Post Hat
     * @param string $content Post Content
     * @param int $author Post User Id
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

    /**
     * Method showPost
     *
     * Display a post with comments
     *
     * @param int $id Post id
     * @param int $page Page number asked
     * @throws PageNotFoundException The page number X is not found ! The number of pages is Y.
     * @throws \App\Framework\Exception\NoViewFoundException No view found with this name
     */
    public function showPostAction($id, $page = 1)
    {
        $result = $this->CommentManager->getByPostId($id, $page, $this->getConfig()->nbCommentByPage);

        if ($result->nbPage != 0 && $page > $result->nbPage) {
            throw new PageNotFoundException($page, $result->nbPage);
        } else {
            $post = $this->PostManager->getById($id);
            $post->setAuthor($this->UserManager->getById($post->user_id));
            $this->addParam('listComment', $result->listComment);
            $this->addParam('nbPage', $result->nbPage);
            $this->addParam('pageSelected', $page);
            $this->addParam('post', $post);
            $this->addParam('nbComments', $result->nbComments);
            $this->view('showPost');
        }
    }

    /**
     * Method listPost
     *
     * Display list of posts for admin in back-office
     *
     * @param int $page Page number asked
     * @throws PageNotFoundException The page number X is not found ! The number of pages is Y.
     * @throws \App\Framework\Exception\NoViewFoundException No view found with this name
     */
    public function listPostAction($page = 1)
    {
        if ($this->user->hasRole('admin')) {
            $result = $this->PostManager->listPostByPage($page, $this->getConfig()->nbPostByPage);
        } else if ($this->user->hasRole('author')) {
            $result = $this->PostManager->listPostByPageByAuthor($page, $this->getConfig()->nbPostByPage, $this->user->getId());
        }

        if ($result->nbPage != 0 && $page > $result->nbPage) {
            throw new PageNotFoundException($page, $result->nbPage);
        } else {
            $this->addParam('listPost', $result->listPost);
            $this->addParam('nbPage', $result->nbPage);
            $this->addParam('pageSelected', $page);
            $this->addParam('url', $this->getConfig()->basePath.'/listPost/');
            $this->view('listPost');
        }
    }

    /**
     * Method listPostPublic
     *
     * Display list of posts for visitor or user
     *
     * @param int $page Page number asked
     * @throws PageNotFoundException The page number X is not found ! The number of pages is Y.
     * @throws \App\Framework\Exception\NoViewFoundException No view found with this name
     */
    public function listPostPublicAction($page = 1)
    {
        $result = $this->PostManager->listPostByPage($page, $this->getConfig()->nbPostByPage);

        if ($result->nbPage != 0 && $page > $result->nbPage) {
            throw new PageNotFoundException($page, $result->nbPage);
        } else {
            $this->addParam('listPost', $result->listPost);
            $this->addParam('nbPage', $result->nbPage);
            $this->addParam('pageSelected', $page);
            $this->addParam('url', $this->getConfig()->basePath.'/listPostPublic/');
            $this->view('listPostPublic');
        }
    }
}