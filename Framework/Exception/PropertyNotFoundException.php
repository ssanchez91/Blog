<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 15/07/2020
 * Time: 14:38
 */

namespace App\Framework\Exception;

/**
 * Class PropertyNotFoundException
 *
 * @package App\Framework\Exception
 */
class PropertyNotFoundException extends \Exception
{
    /**
     * Variable property
     *
     * @var string
     */
    private $property;

    /**
     * Variable className
     *
     * @var string
     */
    private $className;

    /**
     * Constructor
     *
     * @param string $className The name of class
     * @param string $property The property asked
     * @param string $message error message
     */
    public function __construct($className, $property, $message = 'This property has been not found')
    {
        $this->className = $className;
        $this->property = $property;
        parent::__construct($message, '0004');
    }

    /**
     * Method getDetails
     *
     * @return string
     */
    public function getDetails()
    {
        return 'Property ' . $this->property . ' does not exist in class ' . $this->className;
    }
}