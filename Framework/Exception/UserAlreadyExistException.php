<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 07/08/2020
 * Time: 16:33
 */

namespace App\Framework\Exception;


class UserAlreadyExistException extends \Exception
{
    public function __construct($message = "This account already exist !")
    {
        parent::__construct($message, '0110');
    }
}