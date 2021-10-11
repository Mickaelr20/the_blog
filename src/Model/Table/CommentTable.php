<?php

namespace App\Model\Table;

use App\Model\Entity\PostEntity;

class CommentTable extends Table
{

    public function save(PostEntity $postEntity): PostEntity
    {
        $this->sqlConnection->query('INSERT INTO posts (author, hat, title, content) VALUES(:author, :hat, :title, :content)', [
            "author" => $postEntity->author,
            "hat" => $postEntity->hat,
            "title" => $postEntity->title,
            "content" => $postEntity->content
        ]);
        return $postEntity;
    }

    public function listeForPost($post_id): array
    {
        $res = $this->sqlConnection->query("SELECT * FROM comments WHERE post_id = :post_id ORDER BY created DESC", [
            "post_id" => $post_id
        ]);

        return $res;
    }
}
