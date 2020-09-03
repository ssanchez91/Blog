<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 03/08/2020
 * Time: 16:04
 */

namespace App\Model\Manager;


use App\Framework\BaseManager;

class PostManager extends BaseManager
{
    public function __construct($datasource)
    {
        parent::__construct('post', 'App\\Model\\Entity\\Post', $datasource);
    }

    public function listPostByPage($page, $nbPostsByPage)
    {
        $nbPosts = $this->countPosts();
        $limit = ($page * $nbPostsByPage) - $nbPostsByPage;

        $query = $this->bdd->query("SELECT id, title, hat, content, DATE_FORMAT(last_update, '%d/%m/%Y à %Hh%imin%ss') AS last_update FROM post ORDER BY last_update DESC LIMIT $limit, $nbPostsByPage");
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\\Model\\Entity\\Post');

        $result = new \stdClass();
        $result->listPost = $query->fetchAll();
        $result->nbPage = ceil($nbPosts / $nbPostsByPage);

        return $result;
    }

    public function listPostByPageByAuthor($page, $nbPostsByPage, $idUser)
    {
        $nbPosts = $this->countPosts($idUser);

        $limit = ($page * $nbPostsByPage) - $nbPostsByPage;

        $query = $this->bdd->prepare("SELECT id, title, hat, DATE_FORMAT(last_update, '%d/%m/%Y à %Hh%imin%ss') AS last_update FROM post WHERE user_id = ? ORDER BY last_update DESC LIMIT $limit, $nbPostsByPage");
        $query->execute(array($idUser));
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\\Model\\Entity\\Post');

        $result = new \stdClass();
        $result->listPost = $query->fetchAll();
        $result->nbPage = ceil($nbPosts / $nbPostsByPage);

        return $result;
    }

    public function countPosts($idUser = null)
    {
        if (empty($idUser)) {
            $query = $this->bdd->query("SELECT count(*) nb_posts FROM post;");
        } else {
            $query = $this->bdd->prepare("SELECT count(*) nb_posts FROM post WHERE user_id = ?;");
            $query->execute(array($idUser));
        }

        return $query->fetchColumn();
    }
}