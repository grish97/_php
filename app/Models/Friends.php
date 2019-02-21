<?php

namespace app\Models;

use Core\ORM\ORMBase;

class Friends extends ORMBase
{
    public function __construct() {
        parent::__construct('friends');
    }
}