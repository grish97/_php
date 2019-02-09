<?php

namespace Core\ORM;

use \PDO;

class ORMBase
{
    private $pdo;

    public function __construct() {
        $dbConfig = base_path('Core/db');
        require_once "$dbConfig";
        $this->pdo = new PDO(driver . ":host=" . host . ';dbname=' . db_name . ';charset=' . charset, user_name,password);
    }

    public function get() {
        $sql = "SELECT * FROM " . $this->getTableName();
        return  $this->executeStatment($sql);
    }

    public function executeStatment($sql) {
//        $result =  $this->pdo->query($sql);
        dd($this->pdo->query('SELECT * FROM user'));
        return  $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTableName() {
        $tablePath = get_called_class();
        $parts = explode('\\',$tablePath);
        $count = count($parts);
        $tableName = lcfirst($parts[$count - 1]);
        return $tableName;
    }


}

