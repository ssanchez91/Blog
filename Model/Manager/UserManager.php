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

/**
 * Class UserManager
 * @package App\Model\Manager
 */
class UserManager extends BaseManager
{
    /**
     * Constructor
     * @param string $datasource string connexion
     */
    public function __construct($datasource)
    {
        parent::__construct('user', 'App\\Model\\Entity\\User', $datasource);
    }

    /**
     * Method getByMail
     * @param string $mail login of user
     * @return mixed
     */
    public function getByMail($mail)
    {
        $query = $this->bdd->prepare('SELECT * FROM user WHERE MAIL = :mail');
        $query->execute(array('mail' => $mail));
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\\Model\\Entity\\User');
        return $query->fetch();
    }

    /**
     * Method insert
     * @param object $obj
     * @param array $param
     * @throws \App\Framework\Exception\ExecuteQueryException
     */
    public function insert($obj, $param)
    {
        $idUser = parent::insert($obj, $param);
        $this->addDefaultRole($idUser);
    }

    /**
     * Method addDefaultRole
     * @param int $userId User Id
     * @return bool
     */
    public function addDefaultRole($userId)
    {
        $query = $this->bdd->prepare('INSERT INTO role_user (user_id, role_id) VALUES (:userId, 2)');
        return $query->execute(array('userId' => $userId));
    }

    /**
     * Method checkLogin
     *
     * Select user and check if the password is right
     *
     * @param string $mail used like login
     * @param string $password password of the user
     * @return mixed
     * @throws NoUserFoundException
     * @throws WrongPasswordException
     */
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

    /**
     * Method listRolesByUserId
     *
     * Allow to list Roles by User Id
     * @param int $userId User Id
     * @return array
     */
    public function listRolesByUserId($userId)
    {
        $query = $this->bdd->prepare('SELECT role.id, role.description, role.slug FROM user INNER JOIN role_user ON role_user.user_id = user.id INNER JOIN role ON role.id = role_user.role_id WHERE user.id = :userId');
        $query->execute(array('userId' => $userId));
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\\Model\\Entity\\Role');
        return $query->fetchAll();
    }

    /**
     * Method getListUserOrderByName
     *
     * Allow to list users order by name asc
     * @param int $page page number asked ( used for the paginate)
     * @param int $nbUsersByPage Number of user displayed by page
     * @return \stdClass
     */
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

    /**
     * Method countUser
     *
     * @return string
     */
    public function countUser()
    {
        $query = $this->bdd->query("SELECT count(*) nb_user FROM user;");
        $query->execute();
        return $query->fetchColumn();
    }

    /**
     * Method update
     *
     * @param object $obj
     * @param array $param
     * @return string
     * @throws \App\Framework\Exception\ExecuteQueryException
     */
    public function update($obj, $param)
    {
        $user = parent::update($obj, $param);
        $this->updateRoles($obj->getId(), $obj->getListRoles());
        $user->setListRoles($this->listRolesByUserId($user->getId()));

        return $user;
    }

    /**
     * Method listUserByRole
     *
     * @param string $role this param content the slug of the role
     * @return array
     */
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

    /**
     * Method countUserEnabled
     *
     * @return string
     */
    public function countUserEnabled()
    {
        $query = $this->bdd->query("SELECT count(*) nb_user FROM user WHERE enabled = TRUE ;");
        $query->execute();
        return $query->fetchColumn();
    }

    /**
     * Method countUserDisabled
     * @return string
     */
    public function countUserDisabled()
    {
        $query = $this->bdd->query("SELECT count(*) nb_user FROM user WHERE enabled = 0 ;");
        $query->execute();
        return $query->fetchColumn();
    }

    /**
     * Method getUserByIdWithRoles
     *
     * Allow to list Users with their roles
     *
     * @param int $idUser User Id
     * @return mixed
     */
    public function getUserByIdWithRoles($idUser)
    {
        $user = parent::getById($idUser);
        $user->setListRoles($this->listRolesByUserId($idUser));
        return $user;
    }

    /**
     * Method updateRoles
     *
     * @param int $userId User Id
     * @param array $listRoles List of roles
     */
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

    /**
     * Methode deleteRoleByUserIdAndRoleId
     *
     * @param int $userId User Id
     * @param int $roleId Role Id
     * @return bool
     */
    public function deleteRoleByUserIdAndRoleId($userId, $roleId)
    {
        $query = $this->bdd->prepare('DELETE FROM role_user WHERE user_id = :userId AND role_id = :roleId');
        return $query->execute(array('userId' => $userId, 'roleId' => $roleId));
    }

    /**
     * Method addRoleByUserIdAndRoleId
     *
     * @param int $userId User Id
     * @param int $roleId Role Id
     * @return bool
     */
    public function addRoleByUserIdAndRoleId($userId, $roleId)
    {
        $query = $this->bdd->prepare('INSERT INTO role_user SET user_id = :userId, role_id = :roleId');
        return $query->execute(array('userId' => $userId, 'roleId' => $roleId));
    }
}