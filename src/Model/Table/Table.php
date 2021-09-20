<?php

namespace App\Model\Table;

use App\Model\SqlConnection;

abstract class Table
{

    protected SqlConnection $sqlConnection;

    public function __construct()
    {

        $this->sqlConnection = new SqlConnection("localhost", "blog");
    }
}
