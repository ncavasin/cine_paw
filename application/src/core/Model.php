<?php

namespace Paw\core;

use Paw\core\traits\Loggable;
use Paw\core\database\QueryBuilder;

class Model {
    use Loggable;

    public $queryBuilder;

    public function setQueryBuilder(QueryBuilder $qb) {

        $this->queryBuilder = $qb;

    }

}
?>