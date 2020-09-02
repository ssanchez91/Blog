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
}