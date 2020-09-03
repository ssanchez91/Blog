<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 21/07/2020
 * Time: 10:17
 */

namespace App\Model\Entity;


use App\Model\Manager\RoleManager;

class User
{
    private $id;
    private $salutation;
    private $firstname;
    private $lastname;
    private $mail;
    private $password;
    private $enabled;
    private $listRoles;

    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
    public function getSalutation()
    {
        return $this->salutation;
    }

    /**
     * @param mixed $salutation
     */
    public function setSalutation($salutation)
    {
        $this->salutation = $salutation;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param mixed $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @return mixed
     */
    public function getListRoles()
    {
        return $this->listRoles;
    }

    /**
     * @param mixed $listRoles
     */
    public function setListRoles($listRoles)
    {
        $this->listRoles = $listRoles;
    }

    public function hasRole($role)
    {
        $result = array_filter($this->getListRoles(), function ($myRole) use ($role) {
            return $role == $myRole->getSlug();
        });

        return count($result) > 0;
    }

}