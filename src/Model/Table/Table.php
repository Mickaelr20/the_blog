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

    /* 
    options = array
    [
        "select" => ["field_1", "field_2"]
        "where" => ["field_x" => "<value>"]
        "contains" => ["images"]
    ]
    
    */

    public function sql_select($options = ["select" => ["*"], "where" => [], "containing" => ["one" => [], "multiple" => []]]): array
    {
        $sql_select = "*";
        if (!empty($options['select'])) {
            $sql_select = implode(', ', $options['select']);
        }

        $sql_where = "";
        if (!empty($options['where']) && is_array($options['where'])) {
            $sql_where_index = 0;

            foreach ($options['where'] as $column => $value) {
                if ($sql_where_index === 0) {
                    $sql_where .= " WHERE ";
                } else if ($sql_where_index < count($options['where'])) {
                    $sql_where .= " AND ";
                }

                $sql_where .= "$column = :$column";
                $sql_where_index += 1;
            }
        }

        $str_sql = sprintf("SELECT %s FROM %s%s", $sql_select, $this->TABLE_NAME, $sql_where);
        $query_results = $this->sqlConnection->query($str_sql, $options['where']);

        if (!empty($options['containing'])) {
            foreach ($query_results as &$query_result_row) {
                if (!empty($options['containing']['one'])) {
                    $containing_one = $options['containing']['one'];

                    foreach ($containing_one as $table_name) {
                        $entity_name = substr($table_name, 0, -1);
                        $row_id_name = $entity_name . "_id";
                        $str_sql_contains = sprintf('SELECT * FROM %s WHERE id = :id', $table_name);
                        $query_params = [
                            "id" => [$query_result_row[$row_id_name], \PDO::PARAM_INT]
                        ];

                        $query_result_assoc = $this->sqlConnection->query($str_sql_contains, $query_params);
                        if (!empty($query_result_assoc[0])) {
                            $query_result_row[$entity_name] = $query_result_assoc[0];
                        }
                    }
                } else if (!empty($options['containing']['multiple'])) {
                }
            }
        }

        return $query_results;
    }
}
