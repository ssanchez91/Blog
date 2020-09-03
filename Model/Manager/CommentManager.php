<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 17/08/2020
 * Time: 16:19
 */

namespace App\Model\Manager;


use App\Framework\BaseManager;

class CommentManager extends BaseManager
{
    public function __construct($datasource)
    {
        parent::__construct('comment', 'App\\Model\\Entity\\Comment', $datasource);
    }

    public function getByPostId($id, $page, $nbCommentsByPage)
    {
        $nbComments = $this->countCommentByPostId($id);
        $limit = ($page * $nbCommentsByPage) - $nbCommentsByPage;

        $query = $this->bdd->prepare("SELECT comment.id, comment.description, comment.user_id, DATE_FORMAT(comment.last_update, '%d/%m/%Y à %Hh%imin%ss') AS last_update, CONCAT(user.firstname, ' ', user.lastname) as author
            FROM comment
            INNER JOIN user
                ON comment.user_id = user.id
            INNER JOIN post
                ON comment.post_id = post.id
            WHERE comment.post_id = ?
            AND comment.publish = 1
            ORDER BY comment.last_update DESC LIMIT $limit, $nbCommentsByPage");

        $query->execute(array($id));
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\\Model\\Entity\\Comment');
        $result = new \stdClass();
        $result->listComment = $query->fetchAll();
        $result->nbPage = ceil($nbComments / $nbCommentsByPage);
        $result->nbComments = $nbComments;

        return $result;
    }

    public function countCommentByPostId($postId)
    {
        $query = $this->bdd->prepare("SELECT count(*) nb_comment FROM comment WHERE post_id = ? AND publish = 1;");
        $query->execute(array($postId));
        return $query->fetchColumn();
    }

    public function getListCommentOrderByDate($page, $nbCommentsByPage)
    {
        $nbComments = $this->countComment();
        $limit = ($page * $nbCommentsByPage) - $nbCommentsByPage;

        $query = $this->bdd->prepare("SELECT comment.id, comment.description, comment.user_id, comment.post_id, DATE_FORMAT(comment.last_update, '%d/%m/%Y à %Hh%imin%ss') AS last_update, CONCAT(user.firstname, ' ', user.lastname) as author, comment.publish
            FROM comment
            INNER JOIN user
                ON comment.user_id = user.id
            INNER JOIN post
                ON comment.post_id = post.id
            ORDER BY comment.last_update DESC LIMIT $limit, $nbCommentsByPage");
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\\Model\\Entity\\Comment');

        $result = new \stdClass();
        $result->listComment = $query->fetchAll();
        $result->nbPage = ceil($nbComments / $nbCommentsByPage);

        return $result;
    }

    public function countComment($idUser = null)
    {
        if (empty($idUser)) {
            $query = $this->bdd->query("SELECT count(*) nb_comment FROM comment;");
        } else {
            $query = $this->bdd->prepare("SELECT count(*) nb_comment FROM comment WHERE user_id = ?;");
            $query->execute(array($idUser));
        }

        return $query->fetchColumn();
    }

}