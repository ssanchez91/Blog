<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 15/07/2020
 * Time: 11:00
 */

namespace App\Framework\Exception;


class NoRouteFileFoundException extends \Exception
{
    public function __construct($message = 'No route file found with for this name controller')
    {
        parent::__construct($message, '0004');
    }
}