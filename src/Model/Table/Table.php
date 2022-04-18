<?php

namespace App\Model\Table;

use App\Model\SqlConnection;
use App\Model\Entity\Entity;

abstract class Table
{
    public $host = "localhost";
    public $dbName = "blog";
    protected SqlConnection $sqlConnection;
    protected string $TABLE_NAME;

    public function __construct()
    {
        $this->sqlConnection = new SqlConnection($this->host, $this->dbName);
    }
}
