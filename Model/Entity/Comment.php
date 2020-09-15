<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 17/08/2020
 * Time: 16:15
 */

namespace App\Model\Entity;

/**
 * Class Comment
 * @package App\Model\Entity
 */
class Comment
{
    /**
     * Variable id
     * @var
     */
    private $id;
    /**
     * Variable description
     * @var
     */
    private $description;
    /**
     * Variable userId
     * @var
     */
    private $userId;
    /**
     * Variable lastUpdate
     * @var
     */
    private $lastUpdate;
    /**
     * Variable postId
     * @var
     */
    private $postId;
    /**
     * Variable publish
     * @var
     */
    private $publish;


    /**
     * Accessor getId
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Accessor setId
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Accessor  getDescription
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Accessor setDescription
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Accessor getUserId
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Accessor setUserId
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Accessor getPostId
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Accessor setPostId
     * @param mixed $postId
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;
    }


    /**
     * Accessor getLastUpdate
     * @return mixed
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * Accessor setLastUpdate
     * @param mixed $lastUpdate
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
    }

    /**
     * Accessor getPublish
     * @return mixed
     */
    public function getPublish()
    {
        return $this->publish;
    }

    /**
     * Accessor setPublish
     * @param mixed $publish
     */
    public function setPublish($publish)
    {
        $this->publish = $publish;
    }


}