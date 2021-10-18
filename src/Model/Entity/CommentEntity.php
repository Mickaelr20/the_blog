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
    public $validated;

    public function __construct()
    {
    }

    protected function checkCallable(EntityChecker $entityChecker, string $action = null): array
    {
        $entityChecker->check("id", function ($value, $res): string {
            if (!empty($value)) {
                $res = "L'id ne peut être définit par l'utilisateur.";
            }

            return $res;
        }, "create");

        $entityChecker->check("post_id", function ($value, $res): string {
            if (empty($value)) {
                $res = "La publication doit être précisé.";
            }

            return $res;
        });

        $entityChecker->check("author", function ($value, $res): string {
            if (empty($value)) {
                $res = "L'autheur doit être précisé.";
            }

            return $res;
        }, "create");

        $entityChecker->check("content", function ($value, $res): string {
            if (empty($value)) {
                $res = "Le contenu doit être précisé.";
            }

            return $res;
        }, "create");

        $entityChecker->check("created", function ($value, $res): string {
            if (!empty($value)) {
                $res = "La date de création ne peut pas être précisé";
            }

            return $res;
        }, "create");

        $entityChecker->check("validated", function ($value, $res): string {
            if (!empty($value)) {
                $res = "La validité du commentaire ne peut pas être précisé";
            }

            return $res;
        }, "create");

        return $entityChecker->getErrors();
    }
}
