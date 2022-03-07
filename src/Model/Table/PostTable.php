<?php

namespace App\Model\Table;

use App\Model\Entity\PostEntity;

use App\Model\Table\ImageTable;

class PostTable extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->TABLE_NAME = "posts";
    }

    public function save(PostEntity $postEntity): PostEntity
    {
        $t__postEntity = $postEntity->toArray(["author", "hat", "title", "content", 'image_id' => [\PDO::PARAM_INT]]);

        $this->sqlConnection->query("INSERT INTO $this->TABLE_NAME (author, hat, title, content, image_id) VALUES(:author, :hat, :title, :content, :image_id)", $t__postEntity);

        $postEntity->id = $this->sqlConnection->pdo->lastInsertId();

        return $postEntity;
    }

    public function update(PostEntity $postEntity): PostEntity
    {
        $t__postEntity = $postEntity->toArray(["author", "hat", "title", "content", "id" => [\PDO::PARAM_INT], "image_id" => [\PDO::PARAM_INT]]);
        $this->sqlConnection->query(
            "UPDATE $this->TABLE_NAME SET author = :author, hat = :hat, title = :title, content = :content, image_id = :image_id WHERE id = :id",
            $t__postEntity
        );

        return $postEntity;
    }

    public function liste($page, $limit = 5): array
    {
        $offset = $limit * ($page);

        $query_results = $this->sqlConnection->query("SELECT id, author, hat, title, created, image_id FROM $this->TABLE_NAME ORDER BY created DESC LIMIT :offset, :limit", [
            "offset" => [$offset, \PDO::PARAM_INT],
            "limit" => [$limit, \PDO::PARAM_INT]
        ]);

        $res = [];

        foreach ($query_results as $query_result) {
            $temp_res = $query_result;
            if (!empty($temp_res)) {
                if (!empty($temp_res['image_id'])) {
                    $imageTable = new ImageTable();
                    $temp_res['image'] = $imageTable->get($temp_res['image_id'])->toArray();
                }
            }

            $res[] = (new PostEntity())->patchEntity($temp_res);
        }

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

    public function get($id): PostEntity
    {
        $res = [];
        $query_res = $this->sqlConnection->query("SELECT * FROM $this->TABLE_NAME WHERE id = :id", [
            "id" => $id
        ]);

        if (!empty($query_res)) {
            $res = $query_res[0];

            if (!empty($res['image_id'])) {
                $imageTable = new ImageTable();
                $res['image'] = $imageTable->get($res['image_id'])->toArray();
            }
        }

        return (new PostEntity())->patchEntity($res);
    }
}
