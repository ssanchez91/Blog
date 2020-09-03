<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 03/08/2020
 * Time: 15:51
 */

namespace App\Model\Entity;


class Post
{
    private $id;
    private $title;
    private $hat;
    private $content;
    private $author;
    private $lastUpdate;
    private $userId;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * @param mixed $lastUpdate
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getHat()
    {
        return $this->hat;
    }

    /**
     * @param mixed $hat
     */
    public function setHat($hat)
    {
        $this->hat = $hat;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

}