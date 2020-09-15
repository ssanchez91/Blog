<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 17/08/2020
 * Time: 16:19
 */

namespace App\Model\Manager;

use App\Framework\BaseManager;

/**
 * Class CommentManager
 * @package App\Model\Manager
 */
class CommentManager extends BaseManager
{
    /**
     * Constructor
     * @param string $datasource string connexion
     */
    public function __construct($datasource)
    {
        parent::__construct('comment', 'App\\Model\\Entity\\Comment', $datasource);
    }

    /**
     * Method getByPostId
     * @param int $id Post Id
     * @param int $page page number asked
     * @param int $nbCommentsByPage number of comments by page
     * @return \stdClass
     */
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

    /**
     * Method countCommentByPostId
     * @param int $postId Post id
     * @return string
     */
    public function countCommentByPostId($postId)
    {
        $query = $this->bdd->prepare("SELECT count(*) nb_comment FROM comment WHERE post_id = ? AND publish = 1;");
        $query->execute(array($postId));
        return $query->fetchColumn();
    }

    /**
     * Method getListCommentOrderByDate
     * @param int $page page number asked
     * @param int $nbCommentsByPage number of comments by page
     * @return \stdClass
     */
    public function getListCommentOrderByDate($page, $nbCommentsByPage)
    {
        $nbComments = $this->countCommentWithUserAndPostExist();
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

    /**
     * Method countComment
     * @param null $idUser
     * @return string
     */
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

    /**
     * Method countCommentWithUserAndPostExist
     * @return string
     */
    public function countCommentWithUserAndPostExist()
    {
        $query = $this->bdd->prepare("SELECT count(*) nb_comment
        FROM comment
        INNER JOIN user
          ON user.id = comment.user_id
        INNER JOIN post
          ON post.id = comment.post_id
        ;");
        $query->execute();

        return $query->fetchColumn();
    }

    /**
     * Method publishCommentById
     *
     * Allow to publish a comment
     *
     * @param int $id Comment Id
     * @param bool $state State of comment
     * @return bool
     */
    public function publishCommentById($id, $state)
    {
        if ($state == 'publish') {
            $publish = true;
        } else {
            $publish = 0;
        }

        $query = $this->bdd->prepare("UPDATE comment SET publish = :publish WHERE id = :id");
        return $query->execute(array('publish' => $publish, 'id' => $id));
    }

    /**
     * Method countCommentPublished
     * @param bool $state state of comment
     * @return string
     */
    public function countCommentPublished($state)
    {
        $query = $this->bdd->prepare("SELECT count(*) nb_comment FROM comment WHERE publish = ?;");
        $query->execute(array($state));
        return $query->fetchColumn();
    }

}