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


/**
 * Class UserController
 *
 * @package App\Controller
 */
class UserController extends BaseController
{
    /**
     * Method showFormCreateUser
     *
     * Display form to register a new user
     *
     * @throws \App\Framework\Exception\NoViewFoundException No view found with this name
     */
    public function showFormCreateUserAction()
    {
        $this->view('showFormCreateUser');
    }

    /**
     * Method createUser
     *
     * Insert the new user in database
     *
     * @param string $salutation User salutation
     * @param string $firstName User firstname
     * @param string $lastName User lastname
     * @param string $login User mail
     * @param string $password User password
     * @param string $confirmPassword User confirm password
     * @throws UserAlreadyExistException This account already exist !
     * @throws WrongSecondPasswordException The confirm password is wrong !
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
     * Method login
     *
     * display form to login
     *
     * @throws \App\Framework\Exception\NoViewFoundException No view found with this name
     */
    public function loginAction()
    {
        $this->view('login');
    }

    /**
     * Method authentication
     *
     * check authentication and stock user in session
     *
     * @param string $login User mail
     * @param string $password User password
     * @throws DisabledUserException Sorry, this account is disabled
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
     * Method logout
     *
     * @return null redirect to default page
     */
    public function logoutAction()
    {
        unset($_SESSION['user']);
        $this->setUser(null);
        header('location: ' . $this->getConfig()->basePath . '/default');
    }

    /**
     * Method showUserProfile
     *
     * Display logged user profile
     *
     * @throws \App\Framework\Exception\NoViewFoundException No view found with this name
     */
    public function showUserProfileAction()
    {
        $this->view('showUserProfile');
    }

    /**
     * Method listUser
     *
     * Only for the admin from back-office
     *
     * @param int $page Page number asked
     * @throws PageNotFoundException The page number X is not found ! The number of pages is Y.
     * @throws \App\Framework\Exception\NoViewFoundException No view found with this name
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

    /**
     * Method deleteUser
     *
     * Only for the admin from back-office
     *
     * @param int $id User Id to delete
     * @throws \Exception
     */
    public function deleteUserAction($id)
    {
        try {
            $user = $this->UserManager->getById($id);
            $deleteUser = $this->UserManager->delete($user);
            $this->alertManager->addAlert('The user with Id ' . $id . ' has just been deleted.', 'danger');
            header('location: ' . $this->getConfig()->basePath . '/listUser/1');
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Method editUserProfile
     *
     * View the currently logged in user profile form
     *
     * @throws \App\Framework\Exception\NoViewFoundException No view found with this name
     */
    public function editUserProfileAction()
    {
        $this->view('editUserProfile');
    }

    /**
     * Method updateUserProfile
     *
     * Update user profile logged in database
     *
     * @param string $salutation User salutation
     * @param string $firstName User firstname
     * @param string $lastName User lastname
     * @param string $login User mail
     * @throws \Exception
     */
    public function updateUserProfileAction($salutation, $firstName, $lastName, $login)
    {
        $user = new User();
        $user->setId($this->user->getId());
        $user->setSalutation($salutation);
        $user->setFirstname($firstName);
        $user->setLastname($lastName);
        $user->setMail($login);

        try {
            $updateUser = $this->UserManager->update($user, array('mail', 'salutation', 'firstname', 'lastname'));
            $this->addParam('user', $updateUser);
            $_SESSION['user'] = $updateUser;
            $this->alertManager->addAlert("Your profile has just been updated successfully!", "success");
            header('location: ' . $this->getConfig()->basePath . '/showUserProfile');
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Method editUser
     *
     * Display form user from back-office. Only for the admin
     *
     * @param int $id User Id to update
     * @throws \App\Framework\Exception\NoViewFoundException No view found with this name
     */
    public function editUserAction($id)
    {
        $user = $this->UserManager->getUserByIdWithRoles($id);
        $this->addParam('user', $user);
        $this->view('editUser');
    }

    /**
     * Method updateUser
     *
     * Update user in database from back-office only for the admin
     *
     * @param int $id User Id
     * @param string $salutation User salutation
     * @param string $firstName User firstname
     * @param string $lastName User lastname
     * @param string $login User mail
     * @param boolean $enabled User state (enable or disable) from edit form user
     * @param boolean $enabledOrigin User State before edit
     * @param string $role Role Slug from edit form user
     * @throws \Exception
     */
    public function updateUserAction($id, $salutation, $firstName, $lastName, $login, $enabled, $enabledOrigin, $role)
    {
        $user = new User();
        $user->setId($id);
        $user->setSalutation($salutation);
        $user->setFirstname($firstName);
        $user->setLastname($lastName);
        $user->setMail($login);
        if ($enabled == 'false') {
            $user->setEnabled(0);
        } else {
            $user->setEnabled($enabled);
        }
        $user->setListRoles($this->RoleManager->createListRoles($role));
        try {
            $updateUser = $this->UserManager->update($user, array('mail', 'salutation', 'firstname', 'lastname', 'enabled'));
            $this->alertManager->addAlert('The user with Id ' . $id . ' has just been updated.', 'success');
            if ($enabled != $enabledOrigin) {
                if ($enabled == 'false') {
                    $this->alertManager->addAlert('The user with Id ' . $id . ' has just been disabled.', 'warning');
                } else {
                    $this->alertManager->addAlert('The user with Id ' . $id . ' has just been enabled.', 'warning');
                }
            }
            header('location: ' . $this->getConfig()->basePath . '/listUser/1');
        } catch (\Exception $e) {
            throw $e;
        }
    }
}