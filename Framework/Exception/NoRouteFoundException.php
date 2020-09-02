<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 15/07/2020
 * Time: 10:36
 */

namespace App\Framework\Exception;


class NoRouteFoundException extends \Exception
{
    public function __construct($message = 'No route has been found')
    {
        parent::__construct($message, '0002');
    }
}