<?php

namespace App\Model\Table;

use App\Model\Entity\ImageEntity;

class ImageTable extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->TABLE_NAME = "images";
    }

    public function save(ImageEntity $imageEntity): ImageEntity
    {

        $imageEntityArray = $imageEntity->toArray(["display_name", "file_name", "path"]);
        $this->sqlConnection->query(
            "INSERT INTO $this->TABLE_NAME (display_name, file_name, path) VALUES(:display_name, :file_name, :path)",
            $imageEntityArray
        );

        $imageEntity->id = $this->sqlConnection->pdo->lastInsertId();

        return $imageEntity;
    }

    public function get($id): ImageEntity
    {
        $res = [];
        $queryRes = $this->sqlConnection->query("SELECT * FROM $this->TABLE_NAME WHERE id = :id", [
            "id" => [$id, \PDO::PARAM_INT]
        ]);

        if (!empty($queryRes)) {
            $res = $queryRes[0];
        }

        return (new ImageEntity())->patchEntity($res);
    }

    public function update(ImageEntity $imageEntity): ImageEntity
    {
        $imageEntityArray = $imageEntity->toArray(["display_name" => [\PDO::PARAM_STR], "file_name" => [\PDO::PARAM_STR], "path" => [\PDO::PARAM_STR], "id" => [\PDO::PARAM_INT]]);

        $this->sqlConnection->query(
            "UPDATE $this->TABLE_NAME SET display_name = :display_name, file_name = :file_name, path = :path WHERE id = :id",
            $imageEntityArray
        );

        return $this->get($imageEntity->id);
    }

    public function delete($id)
    {
        $this->sqlConnection->query("DELETE FROM $this->TABLE_NAME WHERE id = :id", [
            "id" => $id
        ]);
    }
}
