<?php

namespace app\Models;

use Core\ORM\ORMBase;
use \PDO;

class User extends ORMBase
{
    private $data;

    public function __construct() {
        $this->data = $this->get();
        dd($this->data);
    }
}