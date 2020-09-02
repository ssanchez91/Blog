<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 15/07/2020
 * Time: 11:06
 */

namespace App\Framework;


class BDD
{
    private $bdd;
    private static $instance;

    public static function getInstance($dataSource)
    {
        if (empty(self::$instance)) {
            self::$instance = new BDD($dataSource);
        }
        return self::$instance->bdd;
    }

    private function __construct($dataSource)
    {
        $this->bdd = new \PDO('mysql:dbname=' . $dataSource->dbname . ';host=' . $dataSource->host,
            $dataSource->user,
            $dataSource->password,
            array(1002 => 'SET NAMES utf8'));
    }

}