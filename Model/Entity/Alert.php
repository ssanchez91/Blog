<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 25/08/2020
 * Time: 16:08
 */

namespace App\Model\Entity;

/**
 * Class Alert
 *
 * Allow to create new Alert Object
 *
 * @package App\Model\Entity
 */
class Alert
{
    /**
     * Variable message
     * @var
     */
    private $message;
    /**
     * Variable type of alert (success - warning - danger - info )
     * @var
     */
    private $type;
    /**
     * Variable listType (List Type of alert allowed)
     *
     * @var
     */
    private $listType;

    /**
     * Constructor
     *
     * @param string $message message to display for user
     * @param string $type type of alert
     */
    public function __construct($message, $type)
    {
        $config = file_get_contents('Config/config.json');
        $this->listType = json_decode($config)->listTypeAlert;
        $this->setMessage($message);
        $this->setType($type);
    }

    /**
     * Accessor getMessage
     *
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Accessor setMessage
     *
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Accessor getType
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Accessor setType
     *
     * @param mixed $type
     */
    public function setType($type)
    {
        if (in_array($type, $this->listType)) {
            $this->type = $type;
        } else {
            $this->type = 'info';
        }
    }
}