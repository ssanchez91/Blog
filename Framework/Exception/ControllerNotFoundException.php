<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 23/07/2020
 * Time: 09:58
 */

namespace App\Framework\Exception;

/**
 * Class ControllerNotFoundException
 *
 * @package App\Framework\Exception
 */
class ControllerNotFoundException extends \Exception
{
    /**
     * Constructor
     * @param string $message error message
     */
    public function __construct($message = 'This Controller has been not found')
    {
        parent::__construct($message, "0080");
    }
}