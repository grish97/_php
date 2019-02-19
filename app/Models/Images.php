<?php

namespace app\Models;

use Core\ORM\ORMBase;

class Images extends ORMBase
{
    public function __construct() {
        parent::__construct('images');
    }
}