<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 15/07/2020
 * Time: 11:00
 */

namespace App\Framework\Exception;

/**
 * Class NoViewFoundException
 *
 * @package App\Framework\Exception
 */
class NoViewFoundException extends \Exception
{
    /**
     * Constructor
     *
     * @param string $message error message
     */
    public function __construct($message = 'No view found with this name')
    {
        parent::__construct($message, '0003');
    }
}