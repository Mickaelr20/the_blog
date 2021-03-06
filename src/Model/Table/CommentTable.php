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
        $commentEntityArray = $commentEntity->toArray(["post_id" => [\PDO::PARAM_INT], "author", "content"]);

        $this->sqlConnection->query("INSERT INTO $this->TABLE_NAME (post_id, author, content) VALUES(:post_id, :author, :content)", $commentEntityArray);

        return $commentEntity;
    }

    public function liste($page, $limit = 5): array
    {
        $offset = $limit * ($page);

        $queryResults = $this->sqlConnection->query("SELECT * FROM $this->TABLE_NAME ORDER BY created DESC LIMIT :offset, :limit", [
            "offset" => [$offset, \PDO::PARAM_INT],
            "limit" => [$limit, \PDO::PARAM_INT]
        ]);

        $res = [];

        foreach ($queryResults as $queryResult) {
            $tempRes = $queryResult;

            if (!empty($tempRes)) {
                $res[] = (new CommentEntity())->patchEntity($tempRes);
            }
        }

        return $res;
    }

    public function update(CommentEntity $commentEntity): CommentEntity
    {
        $commentEntityArray = $commentEntity->toArray(["author", "content", "is_validated" => [\PDO::PARAM_BOOL], "id" => [\PDO::PARAM_INT]]);
        $this->sqlConnection->query(
            "UPDATE $this->TABLE_NAME SET author = :author, content = :content, is_validated = :is_validated WHERE id = :id",
            $commentEntityArray
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

    public function listeForPost($postId, $page, $limit = 5): array
    {
        $offset = $limit * ($page);

        $queryResults = $this->sqlConnection->query("SELECT * FROM $this->TABLE_NAME WHERE post_id = :post_id AND is_validated = true ORDER BY created DESC LIMIT :offset, :limit", [
            "post_id" => $postId,
            "offset" => [$offset, \PDO::PARAM_INT],
            "limit" => [$limit, \PDO::PARAM_INT]
        ]);

        $res = [];

        foreach ($queryResults as $queryResult) {
            $tempRes = $queryResult;

            if (!empty($tempRes)) {
                $res[] = (new CommentEntity())->patchEntity($tempRes);
            }
        }

        return $res;
    }

    public function get($id): CommentEntity
    {
        $res = [];
        $queryRes = $this->sqlConnection->query("SELECT * FROM $this->TABLE_NAME WHERE id = :id", [
            "id" => $id
        ]);

        if (!empty($queryRes)) {
            $res = (new CommentEntity())->patchEntity($queryRes[0]);
        }

        return $res;
    }

    public function getForEdit($id): CommentEntity
    {
        $res = new CommentEntity();
        $queryResult = $this->sqlConnection->query("SELECT * FROM $this->TABLE_NAME WHERE id = :id", [
            "id" => $id
        ]);
        if (!empty($queryResult[0])) {
            $res = (new CommentEntity())->patchEntity($queryResult[0]);
        }

        return $res;
    }

    public function countForPost($id): int
    {
        $res = $this->sqlConnection->query("SELECT count(*) AS nb_comments FROM $this->TABLE_NAME WHERE post_id = :id AND is_validated = true", [
            "id" => [$id, \PDO::PARAM_INT]
        ]);

        return (int) $res[0]['nb_comments'];
    }
}
