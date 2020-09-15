<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 21/07/2020
 * Time: 10:17
 */

namespace App\Model\Entity;


use App\Model\Manager\RoleManager;

/**
 * Class User
 *
 * @package App\Model\Entity
 */
class User
{
    /**
     * Property Id
     * @var
     */
    private $id;

    /**
     * Property salutation
     * @var
     */
    private $salutation;

    /**
     * Property firstname
     * @var
     */
    private $firstname;

    /**
     * Property lastname
     * @var
     */
    private $lastname;

    /**
     * Property mail
     * @var
     */
    private $mail;

    /**
     * Property password
     * @var
     */
    private $password;

    /**
     * Property enabled
     * @var
     */
    private $enabled;

    /**
     * Property listRoles
     * @var
     */
    private $listRoles;

    /**
     * Constructor
     */
    public function __construct()
    {

    }

    /**
     * Accessor getId
     *
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * Accessor setId
     *
     * @param int $id User Id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * Accessor getSalutation
     *     *
     * @return string
     */
    public function getSalutation():string
    {
        return $this->salutation;
    }

    /**
     *  Accessor setSalutation
     *
     * @param string $salutation User salutation
     */
    public function setSalutation(string $salutation)
    {
        $this->salutation = $salutation;
    }

    /**
     * Accessor getFirstname
     *
     * @return string
     */
    public function getFirstname():string
    {
        return $this->firstname;
    }

    /**
     * Accessor setFirstname
     *
     * @param string $firstname User firstname
     */
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * Accessor getLastname
     *
     * @return string
     */
    public function getLastname():string
    {
        return $this->lastname;
    }

    /**
     * Accessor setLastname
     *
     * @param string $lastname User lastname
     */
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * Accessor getMail
     *
     * @return string
     */
    public function getMail():string
    {
        return $this->mail;
    }

    /**
     * Accessor setMail
     *
     * @param string $mail User mail
     */
    public function setMail(string $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Accessor getPassword
     *
     * @return string
     */
    public function getPassword():string
    {
        return $this->password;
    }

    /**
     * Accessor setPassword
     *
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * Accessor getEnabled
     *
     * @return string
     */
    public function getEnabled():string
    {
        return $this->enabled;
    }

    /**
     * Accessor setEnabled
     *
     * @param string $enabled User State
     */
    public function setEnabled(string $enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * Method getListRoles
     *
     * @return array
     */
    public function getListRoles():array
    {
        return $this->listRoles;
    }

    /**
     * Method setListRoles
     *
     * @param array $listRoles List roles of user
     */
    public function setListRoles(array $listRoles)
    {
        $this->listRoles = $listRoles;
    }

    /**
     * Method hasRole
     *
     * Check if user has role
     *
     * @param string $role Role User
     * @return bool
     */
    public function hasRole($role)
    {
        $result = array_filter($this->getListRoles(), function ($myRole) use ($role) {
            return $role == $myRole->getSlug();
        });

        return count($result) > 0;
    }
}