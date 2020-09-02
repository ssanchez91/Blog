<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 23/07/2020
 * Time: 09:58
 */

namespace App\Framework\Exception;


class ActionNotFoundException extends \Exception
{
    public function __construct($message = 'This Method has been not found')
    {
        parent::__construct($message, "0090");
    }
}