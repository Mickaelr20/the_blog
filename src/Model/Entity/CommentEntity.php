<?php

namespace App\Model\Entity;

use App\Helper\EntityChecker;

class CommentEntity extends Entity
{
    public $id;
    public $post_id;
    public $author;
    public $content;
    public $created;

    public function __construct()
    {
    }

    protected function checkCallable(EntityChecker $entityChecker): array
    {
        $entityChecker->check("id", function ($value, $res): string {
            if (!empty($value)) {
                $res = "L'id ne peut être définit par l'utilisateur.";
            }

            return $res;
        });

        return $entityChecker->getErrors();
    }
}
