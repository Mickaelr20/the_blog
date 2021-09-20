<?php

namespace App\Model;

class SqlConnection
{
    var $pdo;
    var $host;
    var $dbName;

    public function __construct($host, $dbName)
    {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->pdo = new \PDO("mysql:dbname=$dbName;host=$host", 'root', 'admin123', [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    }

    public function query(String $query, array $args): array
    {
        $result = [];
        $query = $this->pdo->prepare($query);
        $query->execute($args);

        while ($row = $query->fetch()) {
            $result[] = $row;
        }

        $query->closeCursor();

        return $result;
    }
}
