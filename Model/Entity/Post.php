<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 03/08/2020
 * Time: 15:51
 */

namespace App\Model\Entity;

/**
 * Class Post
 * @package App\Model\Entity
 */
class Post
{
    /**
     * Variable id
     * @var
     */
    private $id;
    /**
     * Variable title
     * @var
     */
    private $title;
    /**
     * Variable hat
     * @var
     */
    private $hat;
    /**
     * Variable content
     * @var
     */
    private $content;
    /**
     * Variable author
     * @var
     */
    private $author;
    /**
     * Variable lastUpdate
     * @var
     */
    private $lastUpdate;
    /**
     * Variable userId
     * @var
     */
    private $userId;

    /**
     * Accessor  getId
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Accessor getLastUpdate
     *
     * @return mixed
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * Accessor setLastUpdate
     *
     * @param mixed $lastUpdate
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
    }

    /**
     * Accessor getContent
     *
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Accessor setContent
     *
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Accessor getHat
     *
     * @return mixed
     */
    public function getHat()
    {
        return $this->hat;
    }

    /**
     * Accessor setHat
     *
     * @param mixed $hat
     */
    public function setHat($hat)
    {
        $this->hat = $hat;
    }

    /**
     * Accessor getTitle
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * Accessor setTitle
     *
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Accessor getAuthor
     *
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Accessor setAuthor
     *
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * Accessor setId
     *
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Accessor getUserId
     *
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Accessor setUserId
     *
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

}