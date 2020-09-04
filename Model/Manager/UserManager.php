<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 21/07/2020
 * Time: 10:24
 */

namespace App\Model\Manager;

use App\Framework\BaseManager;
use App\Framework\Exception\NoUserFoundException;
use App\Framework\Exception\WrongPasswordException;

class UserManager extends BaseManager
{
    public function __construct($datasource)
    {
        parent::__construct('user', 'App\\Model\\Entity\\User', $datasource);
    }

    public function getByMail($mail)
    {
        $query = $this->bdd->prepare('SELECT * FROM user WHERE MAIL = :mail');
        $query->execute(array('mail' => $mail));
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\\Model\\Entity\\User');
        return $query->fetch();
    }

    public function insert($obj, $param)
    {
        $idUser = parent::insert($obj, $param);
        $this->addDefaultRole($idUser);
    }

    public function addDefaultRole($userId)
    {
        $query = $this->bdd->prepare('INSERT INTO role_user (user_id, role_id) VALUES (:userId, 2)');
        return $query->execute(array('userId' => $userId));
    }

    public function checkLogin($mail, $password)
    {
        $query = $this->bdd->prepare('SELECT * FROM user WHERE mail = :mail');
        $query->execute(array('mail' => $mail));
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\\Model\\Entity\\User');
        $user = $query->fetch();

        if (!empty($user)) {
            if (password_verify($password, $user->getPassword())) {
                $user->setListRoles($this->listRolesByUserId($user->getId()));
                return $user;
            } else {
                throw new WrongPasswordException();
            }
        } else {
            throw new NoUserFoundException();
        }
    }

    public function listRolesByUserId($userId)
    {
        $query = $this->bdd->prepare('SELECT role.id, role.description, role.slug FROM user INNER JOIN role_user ON role_user.user_id = user.id INNER JOIN role ON role.id = role_user.role_id WHERE user.id = :userId');
        $query->execute(array('userId' => $userId));
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\\Model\\Entity\\Role');
        return $query->fetchAll();
    }

    public function getListUserOrderByName($page, $nbUsersByPage)
    {
        $nbUsers = $this->countUser();
        $limit = ($page * $nbUsersByPage) - $nbUsersByPage;

        $query = $this->bdd->prepare("SELECT user.id, user.lastname, user.firstname, user.mail, user.enabled
            FROM user
            ORDER BY user.lastname DESC LIMIT $limit, $nbUsersByPage");

        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\\Model\\Entity\\User');
        $listUser = $query->fetchAll();

        foreach ($listUser as $user) {
            $user->setListRoles($this->listRolesByUserId($user->getId()));
        }

        $result = new \stdClass();
        $result->listUser = $listUser;
        $result->nbPage = ceil($nbUsers / $nbUsersByPage);

        return $result;

    }

    public function countUser()
    {
        $query = $this->bdd->query("SELECT count(*) nb_user FROM user;");
        $query->execute();
        return $query->fetchColumn();
    }

    public function update($obj, $param)
    {
        $user = parent::update($obj, $param);
        $this->updateRoles($obj->getId(), $obj->getListRoles());
        $user->setListRoles($this->listRolesByUserId($user->getId()));

        return $user;
    }

    public function listUserByRole($role)
    {
        $query = $this->bdd->prepare("SELECT user.id, user.firstname, user.lastname
        FROM user
        INNER JOIN role_user
          ON role_user.user_id = user.id
        INNER JOIN role
          ON role_user.role_id = role.id
        WHERE role.slug = :role");
        $query->execute(array('role' => $role));
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\\Model\\Entity\\User');
        return $query->fetchAll();
    }

    public function countUserEnabled()
    {
        $query = $this->bdd->query("SELECT count(*) nb_user FROM user WHERE enabled = TRUE ;");
        $query->execute();
        return $query->fetchColumn();
    }

    public function countUserDisabled()
    {
        $query = $this->bdd->query("SELECT count(*) nb_user FROM user WHERE enabled = 0 ;");
        $query->execute();
        return $query->fetchColumn();
    }

    public function getUserByIdWithRoles($idUser)
    {
        $user = parent::getById($idUser);
        $user->setListRoles($this->listRolesByUserId($idUser));
        return $user;
    }

    public function updateRoles($userId, $listRoles)
    {
        $listRoleSlug = [];
        foreach($listRoles as $role)
        {
            array_push($listRoleSlug, $role->getSlug());
        }

        $userOrigine = $this->getUserByIdWithRoles($userId);
        $listRolesOrigine = $userOrigine->getListRoles();
        $listRoleSlugOrigin = [];

        foreach($listRolesOrigine as $roleOrigine)
        {
            if(!in_array($roleOrigine->getSlug(), $listRoleSlug))
            {
                $this->deleteRoleByUserIdAndRoleId($userId, $roleOrigine->getId());
            }
            array_push($listRoleSlugOrigin, $roleOrigine->getSlug());
        }

        foreach($listRoles as $role)
        {
            if(!in_array($role->getSlug(), $listRoleSlugOrigin))
            {
                $this->addRoleByUserIdAndRoleId($userId, $role->getId());
            }
        }
    }

    public function deleteRoleByUserIdAndRoleId($userId, $roleId)
    {
        $query = $this->bdd->prepare('DELETE FROM role_user WHERE user_id = :userId AND role_id = :roleId');
        return $query->execute(array('userId' => $userId, 'roleId' => $roleId));
    }

    public function addRoleByUserIdAndRoleId($userId, $roleId)
    {
        $query = $this->bdd->prepare('INSERT INTO role_user SET user_id = :userId, role_id = :roleId');
        return $query->execute(array('userId' => $userId, 'roleId' => $roleId));
    }
}