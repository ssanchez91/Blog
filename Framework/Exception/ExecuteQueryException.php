<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 03/08/2020
 * Time: 17:08
 */

namespace App\Framework\Exception;

/**
 * Class ExecuteQueryException
 *
 * @package App\Framework\Exception
 */
class ExecuteQueryException extends \Exception
{
    /**
     * Variable errorInfo
     * @var string
     */
    private $errorInfo;
    /**
     * Variable requestType
     * @var int
     */
    private $requestType;

    /**
     * Constructor
     *
     * @param string $errorInfo error info request
     * @param int $requestType Request Type
     * @param string $message error message
     */
    public function __construct($errorInfo, $requestType, $message = 'Database Error')
    {
        parent::__construct($message, '0500');
        $this->errorInfo = $errorInfo;
        $this->requestType = $requestType;
    }

    /**
     * Method getDetails
     *
     * @return mixed
     */
    public function getDetails()
    {
        return $this->errorInfo[2];
    }

    /**
     * Method getRequestType
     *
     * @return int
     */
    public function getRequestType()
    {
        return $this->requestType;
    }
}