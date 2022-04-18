<?php

namespace App\Model;

class SqlConnection
{
    var $pdo;
    var $host;
    var $dbName;
    var $username = "root";
    var $password = "admin123";

    public function __construct($host, $dbName)
    {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->pdo = new \PDO("mysql:dbname=$dbName;host=$host", $this->username, $this->password, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    }

    public function query(String $query, array $args = []): array
    {
        $result = [];
        $query = $this->pdo->prepare($query);

        foreach ($args as $argKey => $argVal) {
            if (is_array($argVal)) {
                $query->bindParam(":" . $argKey, $argVal[0], count($argVal) > 1 ? $argVal[1] : null);
            } else if (is_string($argVal)) {
                $query->bindValue(":" . $argKey, $argVal);
            }
        }

        $query->execute();

        while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }

        $query->closeCursor();

        return $result;
    }
}
