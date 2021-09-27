<?php

namespace App\Model\Table;

use App\Model\Entity\PostEntity;

class PostTable extends Table
{

    public function save(PostEntity $postEntity): PostEntity
    {
        $this->sqlConnection->query('INSERT INTO posts (author, hat, title, content) VALUES(?, ?, ?, ?)', [
            $postEntity->author,
            $postEntity->hat,
            $postEntity->title,
            $postEntity->content
        ]);
        return $postEntity;
    }

    public function liste($page): array
    {
        $res = [];
        $limit = 2;
        $offset = $limit * ($page - 1);

        $this->sqlConnection->query('SELECT * FROM posts ORDER BY created DESC LIMIT ?, ?', [
            $offset, $limit
        ]);

        return $res;
    }
}
