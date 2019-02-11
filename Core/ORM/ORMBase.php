<?php

namespace Core\ORM;

use Couchbase\Exception;
use \PDO;

class ORMBase
{
    private $pdo;
    private $where = '';
    private $select = '*';
    private $table;
    private $data;

    public function __construct($table) {
        $this->table = $table;

        $dbConfig = base_path('Core/db');
        require_once "$dbConfig";
        $this->pdo = new PDO(driver . ":host=" . host . ';dbname=' . db_name . ';charset=' . charset, user_name,password);
    }

    public function get() {
        $sql = 'SELECT ' . $this->select . ' FROM ' . $this->table . $this->where;
        $this->data = $this->executeStatment($sql);
        return $this;
    }

    public function create (array $columns, array $values) {
        $this->insert($columns,$values);
        return $this;
    }

    public function where($columnName, $statment, $arg){
        $this->where = ' where ' . ' ' . $columnName . ' ' . $statment . '"' . $arg .'"';
        return $this;
    }

    public function select($fields){
        $this->select = $fields;
        return $this;
    }

    public  function insert(array $columns, array $values) {
        $column = implode(' , ',$columns);
        $values = array_map(function ($val) {
            return "'" . $val . "'";
        },$values);
        $value = implode(' , ',  $values);
        $sql = "INSERT INTO " . $this->table . " (" . $column . " ) VALUES ( " . $value . " ) ";
        $this->pdo->query($sql);
    }

    public function update($data) {
        $list = [];

        foreach($data as $key => $value) {
            $list[$key] =  "$key='$value'";
        }

        $list = implode(' , ',$list);
        $sql = "UPDATE $this->table SET $list $this->where";
        $this->executeStatment($sql);
    }

    public function executeStatment($sql) {
        try {
            $result = $this->pdo->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function first() {
        return isset($this->data[0]) ? $this->data[0] : $this->data;
    }

    public function getTableName() {
        $classPath = get_called_class();
        $parts = explode('\\',$classPath);
        $count = count($parts);
        $tableName = lcfirst($parts[$count - 1]);
        return $tableName;
    }

    public static function query(){
        $table  = self::getTableName();
        return new ORMBase($table);
    }
}
