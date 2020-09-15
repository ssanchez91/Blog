<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 05/08/2020
 * Time: 22:34
 */

namespace App\Model\Entity;

/**
 * Class Role
 * @package App\Model\Entity
 */
class Role
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
     * Variable slug
     * @var
     */
    private $slug;

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
     * Accessor getDescription
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
     * Accessor getSlug
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Accessor setSlug
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
}