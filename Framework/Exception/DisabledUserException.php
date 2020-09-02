<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 07/08/2020
 * Time: 17:21
 */

namespace App\Framework\Exception;


class DisabledUserException extends \Exception
{
    public function __construct($message = 'Sorry, this account is disabled')
    {
        parent::__construct($message, '0120');
    }
}