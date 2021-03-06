<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 15/07/2020
 * Time: 14:08
 */

namespace App\Framework;

use App\Framework\BDD;
use App\Framework\Exception\ExecuteQueryException;
use App\Framework\Exception\PropertyNotFoundException;

/**
 * Class BaseManager
 *
 * @package App\Framework
 */
class BaseManager
{
    /**
     * Property table
     * @var
     */
    private $table;

    /**
     * Property object
     * @var
     */
    private $object;

    /**
     * Property PDO
     * @var \PDO
     */
    protected $bdd;

    /**
     * Constructor
     *
     * @param string $table Table name
     * @param object $object object
     * @param string $datasource connection information
     */
    public function __construct($table, $object, $datasource)
    {
        $this->table = $table;
        $this->object = $object;
        $this->bdd = BDD::getInstance($datasource);
    }

    /**
     * Method getById
     *
     * @param int $id Object Id
     * @return mixed
     */
    public function getById($id)
    {
        $query = $this->bdd->prepare('SELECT * FROM ' . $this->table . ' WHERE id= :id');
        $query->execute(array('id' => $id));
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->object);
        return $query->fetch();
    }

    /**
     * Method listAll
     *
     * @return array
     */
    public function listAll()
    {
        $query = $this->bdd->prepare('SELECT * FROM ' . $this->table);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->object);
        return $query->fetchAll();
    }

    /**
     * Method insert
     *
     * @param object $obj Object Class
     * @param array $param List of column
     * @return string
     * @throws ExecuteQueryException Database Error
     * @throws PropertyNotFoundException This property has been not found
     */
    public function insert($obj, $param)
    {
        $paramNumber = count($param);
        $valueArray = array_fill(1, $paramNumber, '?');
        $valueString = implode(',', $valueArray);
        $sql = 'INSERT INTO ' . $this->table . ' (' . implode(',', $param) . ') VALUES (' . $valueString . ')';
        $query = $this->bdd->prepare($sql);

        $boundParam = $this->boundParam($param, $obj);

        if ($query->execute($boundParam)) {
            return $this->bdd->lastInsertId($this->table);
        } else {
            throw new Exception\ExecuteQueryException($query->errorInfo(), 'insert');
        }
    }

    /**
     * Method update
     *
     * @param object $obj Object Class
     * @param array $param List of column
     * @return string
     * @throws ExecuteQueryException Database Error
     * @throws PropertyNotFoundException This property has been not found
     */
    public function update($obj, $param)
    {
        $sql = "UPDATE " . $this->table . " SET";
        $params = [];
        foreach ($param as $paramName) {
            $params[] = ' ' . $paramName . ' = ?';
        }
        $sql .= implode(',', $params);
        $sql .= " WHERE id = ? ";
        $req = $this->bdd->prepare($sql);
        $param[] = 'id';
        $boundParam = $this->boundParam($param, $obj);

        if ($req->execute($boundParam)) {
            return $this->getById($obj->getId());
        } else {
            throw new ExecuteQueryException($req->errorInfo(), 'update');
        }
    }

    /**
     * Method delete
     *
     * @param object $obj Object Class
     * @return bool
     */
    public function delete($obj)
    {
        if (property_exists($obj, 'id')) {
            $query = $this->bdd->prepare('DELETE FROM ' . $this->table . ' WHERE id = :id');
            return $query->execute(array('id' => $obj->getId()));
        } else {
            $ex = new PropertyNotFoundException($this->object, 'id');
            throw $ex->getDetails();
        }
    }

    /**
     * Method boundParam
     *
     * @param array $param
     * @param object $obj Object
     * @return array
     * @throws PropertyNotFoundException This property has been not found
     */
    private function boundParam($param, $obj)
    {
        $boundParam = array();
        foreach ($param as $paramName) {
            while (strstr($paramName, '_')) {
                $positionUpperCase = strpos($paramName, '_');
                $paramName = str_replace(substr($paramName, $positionUpperCase, 2), strtoupper(substr($paramName, $positionUpperCase + 1, 1)), $paramName);
                $paramName = substr($paramName, 0, $positionUpperCase) . strtoupper(substr($paramName, $positionUpperCase, 1)) . substr($paramName, $positionUpperCase + 1);
            }
            if (property_exists($obj, $paramName))
            {
                $boundParam[] = $obj->{'get' . ucfirst($paramName)}();
            }
            else
            {
                throw new PropertyNotFoundException($this->object, $paramName);
            }
        }
        return $boundParam;
    }
}