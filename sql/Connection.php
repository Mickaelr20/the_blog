<?php

namespace App\Helper\Sql;

class SqlConnection
{

    private $odbcList = ['mysql'];

    // $res = [
    //     'error' => "",
    //     'post' => []
    // ];

    // try {
    //     $pdo = new \PDO('mysql:host=localhost;dbname=blog', 'root', 'admin123', [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    //     $query = $pdo->prepare('SELECT * FROM posts WHERE id = ?');
    //     $query->execute([]);

    //     while ($row = $query->fetch()) {
    //         $res['post'] = $row;
    //     }

    //     $query->closeCursor();
    // } catch (\Exception $e) {
    //     $res['error'] = "Cette publication n'existe pas ou a été supprimé.";
    //     $res['post'] = [];
    // }
    // return $res;

    private $connection = null;

    private $odbc = null;
    private $dbName = null;
    private $host = null;
    private $user = null;

    public function __construct($odbc, $dbName, $host, $user, $pwd)
    {
        $this->odbc = $odbc;
        $this->dbName = $dbName;
        $this->host = $host;
        $this->user = $user;

        $this->initialize($pwd);
    }

    private function initialize($pwd)
    {
        $this->connection = new \PDO("$this->odbc:host=$this->host;dbname=$this->dbName", $this->user, $pwd, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    }

    public function query($statement, $statement_values = [], $callback = null)
    {
        $res = new SqlResult();

        try {
            $query = $this->connection->prepare($statement);
            $query->execute($statement_values);

            if ($callback !== null) {
                $res->setReturnedData($callback($query));
            }

            $res->setSuccess();

            $query->closeCursor();
        } catch (\Exception $e) {
            $res->setSuccess(false);
        }

        return $res;
    }
}
