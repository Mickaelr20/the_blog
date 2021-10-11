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

    public function query(String $query, array $args = []): array
    {
        $result = [];
        $query = $this->pdo->prepare($query);

        foreach ($args as $arg_key => $arg_val) {
            if (is_array($arg_val)) {
                if (count($arg_val) > 1) {
                    $query->bindParam(":" . $arg_key, $arg_val[0], $arg_val[1]);
                } else {
                    $query->bindParam(":" . $arg_key, $arg_val[0]);
                }
            } else if (is_string($arg_val)) {
                $query->bindValue(":" . $arg_key, $arg_val);
            }
        }

        $query->execute();

        while ($row = $query->fetch()) {
            $result[] = $row;
        }

        $query->closeCursor();

        return $result;
    }
}
