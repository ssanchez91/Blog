<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 27/07/2020
 * Time: 10:50
 */

namespace App\Controller;


use App\Framework\BaseController;
use App\Framework\Exception\DisabledUserException;
use App\Framework\Exception\NoUserFoundException;
use App\Framework\Exception\PageNotFoundException;
use App\Framework\Exception\UserAlreadyExistException;
use App\Framework\Exception\WrongSecondPasswordException;
use App\Model\Entity\Alert;
use App\Model\Entity\Role;
use App\Model\Entity\User;
use App\Model\Manager\RoleManager;
use App\Model\Manager\UserManager;

class UserController extends BaseController
{
    /**
     * @throws \App\Framework\Exception\NoViewFoundException
     */
    public function showFormCreateUserAction()
    {
        $this->view('showFormCreateUser');
    }

    /**
     * @param $salutation
     * @param $firstName
     * @param $lastName
     * @param $login
     * @param $password
     * @param $confirmPassword
     * @throws UserAlreadyExistException
     * @throws WrongSecondPasswordException
     * @throws \Exception
     */
    public function createUserAction($salutation, $firstName, $lastName, $login, $password, $confirmPassword)
    {
        $verifyUserExist = $this->UserManager->getByMail($login);

        if ($verifyUserExist) {
            throw new UserAlreadyExistException();
        } else {
            if ($password == $confirmPassword) {
                $user = new User();
                $user->setSalutation($salutation);
                $user->setFirstname($firstName);
                $user->setLastname($lastName);
                $user->setMail($login);
                $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $user->setEnabled(true);

                try {
                    $insertUser = $this->UserManager->insert($user, array('salutation', 'firstname', 'lastname', 'mail', 'password', 'enabled'));
                    $this->alertManager->addAlert('Your account has just been created ! Now Login.', 'success');
                    header('location: ' . $this->getConfig()->basePath . '/default');
                } catch (\Exception $e) {
                    throw $e;
                }
            } else {
                throw new WrongSecondPasswordException();
            }
        }
    }
}