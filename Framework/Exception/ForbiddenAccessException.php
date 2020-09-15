<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 10/08/2020
 * Time: 16:08
 */

namespace App\Framework\Exception;

/**
 * Class ForbiddenAccessException
 *
 * @package App\Framework\Exception
 */
class ForbiddenAccessException extends \Exception
{
    /**
     * Constructor
     *
     * @param string $message error message
     */
    public function __construct($message = 'You are not authorized to access to this url !')
    {
        parent::__construct($message, '0520');
    }
}