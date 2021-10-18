<?php

namespace App\Model\Table;

use App\Model\Entity\PostEntity;

class PostTable extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->TABLE_NAME = "posts";
    }

    public function save(PostEntity $postEntity): PostEntity
    {
        $transform_postEntity = $postEntity->toArray(["author", "hat", "title", "content"]);

        $this->sqlConnection->query("INSERT INTO $this->TABLE_NAME (author, hat, title, content) VALUES(:author, :hat, :title, :content)", $transform_postEntity);

        $postEntity->id = $this->sqlConnection->pdo->lastInsertId();

        return $postEntity;
    }

    public function update(PostEntity $postEntity): PostEntity
    {
        $transform_postEntity = $postEntity->toArray(["author", "hat", "title", "content", "id" => [\PDO::PARAM_INT]]);
        $this->sqlConnection->query(
            "UPDATE $this->TABLE_NAME SET author = :author, hat = :hat, title = :title, content = :content WHERE id = :id",
            $transform_postEntity
        );

        return $postEntity;
    }

    public function liste($page, $limit = 5): array
    {
        $offset = $limit * ($page);

        $res = $this->sqlConnection->query("SELECT id, author, hat, title, created FROM $this->TABLE_NAME ORDER BY created DESC LIMIT :offset, :limit", [
            "offset" => [$offset, \PDO::PARAM_INT],
            "limit" => [$limit, \PDO::PARAM_INT]
        ]);

        return $res;
    }

    public function count(): int
    {
        $res = $this->sqlConnection->query("SELECT count(*) AS nb_posts FROM $this->TABLE_NAME", []);

        return (int) $res[0]['nb_posts'];
    }

    public function delete($id)
    {
        $this->sqlConnection->query("DELETE FROM $this->TABLE_NAME WHERE id = :id", [
            "id" => $id
        ]);
    }

    public function get($id): array
    {
        $res = [];
        $query_res = $this->sqlConnection->query("SELECT id, author, content, title, created FROM $this->TABLE_NAME WHERE id = :id", [
            "id" => $id
        ]);

        if (!empty($query_res)) {
            $res = $query_res[0];
        }

        return $res;
    }

    public function getForEdit($id): array
    {
        return $this->sqlConnection->query("SELECT * FROM $this->TABLE_NAME WHERE id = :id", [
            "id" => $id
        ])[0];
    }
}
