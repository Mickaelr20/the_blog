<?php

namespace App\Model\Table;

use App\Model\Entity\UserEntity;

class UserTable extends Table
{
    public function save(UserEntity $userEntity): UserEntity
    {
        $this->sqlConnection->query('INSERT INTO users (last_name, first_name, email, nickname, password) VALUES(:last_name, :first_name, :email, :nickname, :password)', [
            "last_name" => $userEntity->last_name,
            "first_name" => $userEntity->first_name,
            "email" => $userEntity->email,
            "nickname" => $userEntity->nickname,
            "password" => $userEntity->password
        ]);
        return $userEntity;
    }

    public function get($email): array
    {
        return $this->sqlConnection->query('SELECT * FROM users WHERE email = :email', [
            "email" => $email
        ]);
    }
}
