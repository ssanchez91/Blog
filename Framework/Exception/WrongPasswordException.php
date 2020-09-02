<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 28/08/2020
 * Time: 11:58
 */

namespace App\Framework\Exception;


class WrongPasswordException extends \Exception
{
    public function __construct($message = "Wrong Password !")
    {
        parent::__construct($message, '0150');
    }
}