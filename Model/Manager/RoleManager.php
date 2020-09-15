<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 21/07/2020
 * Time: 10:24
 */

namespace App\Model\Manager;

use App\Framework\BaseManager;
use App\Model\Entity\Role;

/**
 * Class RoleManager
 * @package App\Model\Manager
 */
class RoleManager extends BaseManager
{
    /**
     * Constructor
     * @param string $datasource connexion string
     */
    public function __construct($datasource)
    {
        parent::__construct('role', 'App\\Model\\Entity\\Role', $datasource);
    }

    /**
     * Method createListRoles
     * @param string $roleSlug code of role
     * @return array
     */
    public function createListRoles($roleSlug)
    {
        $listRoleSlug = [];
        switch($roleSlug)
        {
            case "admin":
                array_push($listRoleSlug, 'admin', 'author', 'member');
                break;
            case "author";
                array_push($listRoleSlug, 'author', 'member');
                break;
            case "member";
                array_push($listRoleSlug, 'member');
                break;
        }

        $listRoles = [];
        foreach($listRoleSlug as $roleSlug)
        {
            array_push($listRoles, $this->addRole($roleSlug));
        }

        return($listRoles);
    }

    /**
     * Method addRole
     *
     * Allow to add a role for a user
     *
     * @param string $roleSlug code of role
     * @return Role
     */
    public function addRole($roleSlug)
    {
        $role = new Role();
        switch($roleSlug)
        {
            case "admin":
                $idRole = 1;
                $description = 'Administrator';
                break;
            case "author";
                $idRole = 3;
                $description = 'Author';
                break;
            case "member";
                $idRole = 2;
                $description = 'Member';
                break;
        }
        $role->setId($idRole);
        $role->setDescription($description);
        $role->setSlug($roleSlug);

        return $role;
    }
}