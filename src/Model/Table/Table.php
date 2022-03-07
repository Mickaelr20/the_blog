<?php

namespace App\Model\Table;

use App\Model\SqlConnection;
use App\Model\Entity\Entity;

abstract class Table
{

    protected SqlConnection $sqlConnection;
    protected string $TABLE_NAME;

    public function __construct()
    {
        $this->sqlConnection = new SqlConnection("localhost", "blog");
    }
}
