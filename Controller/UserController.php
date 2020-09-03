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
                    header('location: ' . $this->getConfig()->basePath . '/login');
                } catch (\Exception $e) {
                    throw $e;
                }
            } else {
                throw new WrongSecondPasswordException();
            }
        }
    }

    /**
     * @throws \App\Framework\Exception\NoViewFoundException
     *
     */
    public function loginAction()
    {
        $this->view('login');
    }

    /**
     * @param $login user mail
     * @param $password user password
     * @throws DisabledUserException
     */
    public function authenticateAction($login, $password)
    {
        $user = $this->UserManager->checkLogin($login, $password);

        if (!empty ($user)) {
            if ($user->getEnabled()) {
                $_SESSION['user'] = $user;
                $this->setUser($user);
                $this->alertManager->addAlert('Welcome ' . $user->getFirstname() . ' ' . $user->getLastname() . ' you are connected.', 'info');
                header('location: ' . $this->getConfig()->basePath . '/default');
            } else {
                throw new DisabledUserException();
            }
        }

    }

    /**
     * @return null redirect to default page
     */
    public function logoutAction()
    {
        unset($_SESSION['user']);
        $this->setUser(null);
        header('location: ' . $this->getConfig()->basePath . '/default');
    }

    /**
     * @throws \App\Framework\Exception\NoViewFoundException
     */
    public function showUserProfileAction()
    {
        $this->view('showUserProfile');
    }

    /**
     * @param int $page
     * @throws PageNotFoundException
     * @throws \App\Framework\Exception\NoViewFoundException
     */
    public function listUserAction($page = 1)
    {
        $result = $this->UserManager->getListUserOrderByName($page, $this->getConfig()->nbUserByPage);

        if ($result->nbPage != 0 && $page > $result->nbPage) {
            throw new PageNotFoundException($page, $result->nbPage);
        } else {
            $this->addParam('listUser', $result->listUser);
            $this->addParam('nbPage', $result->nbPage);
            $this->addParam('pageSelected', $page);
            $this->addParam('url', $this->getConfig()->basePath.'/listUser/');
            $this->view('listUser');
        }
    }
}