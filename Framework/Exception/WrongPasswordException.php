<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 28/08/2020
 * Time: 11:58
 */

namespace App\Framework\Exception;

/**
 * Class WrongPasswordException
 *
 * @package App\Framework\Exception
 */
class WrongPasswordException extends \Exception
{
    /**
     * Constructor
     *
     * @param string $message error message
     */
    public function __construct($message = "Wrong Password !")
    {
        parent::__construct($message, '0150');
    }
}