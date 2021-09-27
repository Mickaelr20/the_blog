<?php

namespace App\Model\Table;

use App\Model\Entity\UserEntity;

class UserTable extends Table
{

    // public function getById(int $id): UserEntity
    // {
    //     $queryResult = $this->sqlConnection->query('SELECT * FROM users WHERE id = ?', [$id]);
    //     return new UserEntity($queryResult);
    // }

    public function save(UserEntity $userEntity): UserEntity
    {
        $this->sqlConnection->query('INSERT INTO users (last_name, first_name, email, nickname, password) VALUES(?, ?, ?, ?, ?)', [
            $userEntity->last_name,
            $userEntity->first_name,
            $userEntity->email,
            $userEntity->nickname,
            $userEntity->password
        ]);
        return $userEntity;
    }

    public function get($email): array
    {
        return $this->sqlConnection->query('SELECT * FROM users WHERE email = ?', [
            $email
        ]);
    }
}
