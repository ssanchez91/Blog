<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 25/08/2020
 * Time: 16:08
 */

namespace App\Model\Entity;


class Alert
{
    private $message;
    private $type;
    private $listType;

    public function __construct($message, $type)
    {
        $config = file_get_contents('Config/config.json');
        $this->listType = json_decode($config)->listTypeAlert;
        $this->setMessage($message);
        $this->setType($type);
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
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