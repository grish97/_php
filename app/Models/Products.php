<?php

namespace app\Models;

use Core\ORM\ORMBase;

class Products extends ORMBase
{
    public  function __construct() {
        parent::__construct('products');
    }
}