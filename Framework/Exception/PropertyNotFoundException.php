<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 15/07/2020
 * Time: 14:38
 */

namespace App\Framework\Exception;


class PropertyNotFoundException extends \Exception
{
    /**
     * @var int
     */
    private $property;
    /**
     * @var string
     */
    private $className;

    public function __construct($className, $property, $message = 'This property has been not found')
    {
        $this->className = $className;
        $this->property = $property;
        parent::__construct($message, '0004');
    }

    public function getDetails()
    {
        return 'Property ' . $this->property . ' does not exist in class ' . $this->className;
    }
}