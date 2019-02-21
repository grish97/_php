<?php

namespace app\Models;

use Core\ORM\ORMBase;

class FriendPivot extends ORMBase
{
    public function __construct() {
        parent::__construct('friendPivot');
    }
}