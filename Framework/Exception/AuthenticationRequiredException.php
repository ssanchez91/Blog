<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 09/08/2020
 * Time: 15:22
 */

namespace App\Framework\Exception;

/**
 * Class AuthenticationRequiredException
 *
 * @package App\Framework\Exception
 */
class AuthenticationRequiredException extends \Exception
{
    /**
     * Constructor
     * @param string $message error message
     */
    public function __construct($message = 'Authentication required to go to this url')
    {
        parent::__construct($message, "0510");
    }
}