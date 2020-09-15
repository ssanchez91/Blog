<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 15/07/2020
 * Time: 10:40
 */

namespace App\Framework\Exception;

/**
 * Class MultipleRouteFoundException
 *
 * @package App\Framework\Exception
 */
class MultipleRouteFoundException extends \Exception
{
    /**
     * Constructor
     *
     * @param string $message error message
     */
    public function __construct($message = 'More than one route has been found')
    {
        parent::__construct($message, '0001');
    }
}