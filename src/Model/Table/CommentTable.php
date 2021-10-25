<?php

namespace App\Model\Table;

use App\Model\Entity\CommentEntity;

class CommentTable extends Table
{

    public function __construct()
    {
        parent::__construct();
        $this->TABLE_NAME = "comments";
    }

    public function save(CommentEntity $commentEntity): CommentEntity
    {
        $transform_commentEntity = $commentEntity->toArray(["post_id" => [\PDO::PARAM_INT], "author", "content"]);

        $this->sqlConnection->query("INSERT INTO $this->TABLE_NAME (post_id, author, content) VALUES(:post_id, :author, :content)", $transform_commentEntity);

        return $commentEntity;
    }

    public function liste($page, $limit = 5): array
    {
        $offset = $limit * ($page);

        $res = $this->sqlConnection->query("SELECT * FROM $this->TABLE_NAME ORDER BY created DESC LIMIT :offset, :limit", [
            "offset" => [$offset, \PDO::PARAM_INT],
            "limit" => [$limit, \PDO::PARAM_INT]
        ]);

        return $res;
    }

    public function update(CommentEntity $commentEntity): CommentEntity
    {
        $transform_commentEntity = $commentEntity->toArray(["author", "content", "is_validated" => [\PDO::PARAM_BOOL], "id" => [\PDO::PARAM_INT]]);
        $this->sqlConnection->query(
            "UPDATE $this->TABLE_NAME SET author = :author, content = :content, is_validated = :is_validated WHERE id = :id",
            $transform_commentEntity
        );

        return $commentEntity;
    }

    public function delete($id)
    {
        $this->sqlConnection->query("DELETE FROM $this->TABLE_NAME WHERE id = :id", [
            "id" => $id
        ]);
    }

    public function count(): int
    {
        $res = $this->sqlConnection->query("SELECT count(*) AS nb_comments FROM $this->TABLE_NAME", []);

        return (int) $res[0]['nb_comments'];
    }

    public function listeForPost($post_id, $page, $limit = 5): array
    {
        $offset = $limit * ($page);

        $res = $this->sqlConnection->query("SELECT * FROM $this->TABLE_NAME WHERE post_id = :post_id AND is_validated = true ORDER BY created DESC LIMIT :offset, :limit", [
            "post_id" => $post_id,
            "offset" => [$offset, \PDO::PARAM_INT],
            "limit" => [$limit, \PDO::PARAM_INT]
        ]);

        return $res;
    }

    public function get($id): array
    {
        $res = [];
        $query_res = $this->sqlConnection->query("SELECT * FROM $this->TABLE_NAME WHERE id = :id", [
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

    public function countForPost($id): int
    {
        $res = $this->sqlConnection->query("SELECT count(*) AS nb_comments FROM $this->TABLE_NAME WHERE post_id = :id AND is_validated = true", [
            "id" => [$id, \PDO::PARAM_INT]
        ]);

        return (int) $res[0]['nb_comments'];
    }
}
