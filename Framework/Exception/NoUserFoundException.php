<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 27/07/2020
 * Time: 15:01
 */

namespace App\Framework\Exception;


class NoUserFoundException extends \Exception
{
    public function __construct($message = 'This user doesn\'t exist !')
    {
        parent::__construct($message, '0100');
    }
}