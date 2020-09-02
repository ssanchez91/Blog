<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 10/08/2020
 * Time: 23:35
 */

namespace App\Framework\Exception;


class WrongSecondPasswordException extends \Exception
{
    public function __construct($message = 'The confirm password is wrong !')
    {
        parent::__construct($message, '0150');
    }
}