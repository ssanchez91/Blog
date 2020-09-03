<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 17/08/2020
 * Time: 16:27
 */

namespace App\Controller;

use App\Framework\BaseController;
use App\Framework\Exception\PageNotFoundException;
use App\Model\Entity\Alert;
use App\Model\Entity\Comment;

class CommentController extends BaseController
{
    /**
     * @param $description
     * @param $userId
     * @param $postId
     * @throws \Exception
     */
    public function addCommentAction($description, $userId, $postId)
    {
        $datePostComment = new \DateTime();
        $comment = new Comment();
        $comment->setUserId($userId);
        $comment->setDescription($description);
        $comment->setLastUpdate($datePostComment->format('Y-m-d H:i:s'));
        $comment->setPostId($postId);
        $comment->setPublish(0);

        try {
            $addComment = $this->CommentManager->insert($comment, array('description', 'user_id', 'last_update', 'post_id', 'publish'));
            $this->alertManager->addAlert('Your comment has been posted with success! Waiting to webmaster\'s validation.', 'success');
            $this->addParam('alert', $this->alertManager->showAlert());
            header('location: ' . $this->getConfig()->basePath . '/showPost/' . $postId . '/1');
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
