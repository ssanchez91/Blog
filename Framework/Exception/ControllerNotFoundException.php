<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 23/07/2020
 * Time: 09:58
 */

namespace App\Framework\Exception;


class ControllerNotFoundException extends \Exception
{
    public function __construct($message = 'This Controller has been not found')
    {
        parent::__construct($message, "0080");
    }
}