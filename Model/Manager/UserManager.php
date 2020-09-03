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
        $user->setListRoles($this->listRolesByUserId($user->getId()));

        return $user;
    }
}