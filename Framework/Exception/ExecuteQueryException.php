<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 03/08/2020
 * Time: 17:08
 */

namespace App\Framework\Exception;


class ExecuteQueryException extends \Exception
{
    /**
     * @var string
     */
    private $errorInfo;
    /**
     * @var int
     */
    private $requestType;

    public function __construct($errorInfo, $requestType, $message = 'Database Error')
    {
        parent::__construct($message, '0500');
        $this->errorInfo = $errorInfo;
        $this->requestType = $requestType;
    }

    public function getDetails()
    {
        return $this->errorInfo[2];
    }

    public function getRequestType()
    {
        return $this->requestType;
    }
}