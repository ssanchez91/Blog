<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 15/07/2020
 * Time: 11:06
 */

namespace App\Framework;

/**
 * Class BDD
 *
 * @package App\Framework
 */
class BDD
{
    /**
     * Variable bdd
     * @var \PDO
     */
    private $bdd;

    /**
     * Static Variable instance
     * @var
     */
    private static $instance;

    /**
     * Method getInstance
     *
     * @param object $dataSource Config Json Object
     * @return \PDO
     */
    public static function getInstance($dataSource)
    {
        if (empty(self::$instance)) {
            self::$instance = new BDD($dataSource);
        }
        return self::$instance->bdd;
    }

    /**
     * Constructor
     *
     * @param object $dataSource Config JSON object
     */
    private function __construct($dataSource)
    {
        $this->bdd = new \PDO('mysql:dbname=' . $dataSource->dbname . ';host=' . $dataSource->host,
            $dataSource->user,
            $dataSource->password,
            array(1002 => 'SET NAMES utf8'));
    }

}