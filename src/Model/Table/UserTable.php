<?php

namespace App\Model\Table;

use App\Model\Entity\UserEntity;

class UserTable extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->TABLE_NAME = "users";
    }
    public function save(UserEntity $userEntity): UserEntity
    {
        $this->sqlConnection->query("INSERT INTO $this->TABLE_NAME (last_name, first_name, email, nickname, password) VALUES(:last_name, :first_name, :email, :nickname, :password)", [
            "last_name" => $userEntity->last_name,
            "first_name" => $userEntity->first_name,
            "email" => $userEntity->email,
            "nickname" => $userEntity->nickname,
            "password" => $userEntity->password
        ]);
        return $userEntity;
    }

    public function getForLogin($email): UserEntity
    {
        $res = null;
        $query_result = $this->sqlConnection->query("SELECT * FROM $this->TABLE_NAME WHERE email = :email", [
            "email" => $email
        ]);

        if (!empty($query_result)) {
            $res = (new UserEntity())->patchEntity($query_result[0]);
        }

        return $res;
    }

    public function get($id): UserEntity
    {
        $query_result = $this->sqlConnection->query("SELECT * FROM $this->TABLE_NAME WHERE id = :id", [
            "id" => [$id, \PDO::PARAM_INT]
        ]);

        $res = new UserEntity();

        if (!empty($query_result[0])) {
            $res = (new UserEntity())->patchEntity($query_result[0]);
        }

        return $res;
    }

    public function getForEdit($id): array
    {
        return $this->sqlConnection->query("SELECT * FROM $this->TABLE_NAME WHERE id = :id", [
            "id" => [$id, \PDO::PARAM_INT]
        ])[0];
    }

    public function liste($page, $limit = 5): array
    {
        $offset = $limit * ($page);

        $res = $this->sqlConnection->query("SELECT id, email, first_name, last_name, nickname, is_validated FROM $this->TABLE_NAME ORDER BY id DESC LIMIT :offset, :limit", [
            "offset" => [$offset, \PDO::PARAM_INT],
            "limit" => [$limit, \PDO::PARAM_INT]
        ]);

        return $res;
    }

    public function count(): int
    {
        $res = $this->sqlConnection->query("SELECT count(*) AS nb_users FROM $this->TABLE_NAME", []);

        return (int) $res[0]['nb_users'];
    }


    public function update(UserEntity $userEntity): UserEntity
    {
        $t__userEntity = $userEntity->toArray(["first_name", "last_name", "email", "nickname", "is_validated" => [\PDO::PARAM_BOOL], "id" => [\PDO::PARAM_INT]]);

        $this->sqlConnection->query(
            "UPDATE $this->TABLE_NAME SET first_name = :first_name, last_name = :last_name, email = :email, nickname = :nickname, is_validated = :is_validated WHERE id = :id",
            $t__userEntity
        );

        return $userEntity;
    }

    public function delete($id)
    {
        $this->sqlConnection->query("DELETE FROM $this->TABLE_NAME WHERE id = :id", [
            "id" => $id
        ]);
    }
}
