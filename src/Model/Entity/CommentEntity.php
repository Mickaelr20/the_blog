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
    public $is_validated;

    public function __construct()
    {
    }

    public static function fromArray(array $array): CommentEntity
    {
        $commentEntity = new CommentEntity();

        $commentEntity->id = empty($array['id']) ? null : $array['id'];
        $commentEntity->post_id = empty($array['post_id']) ? null : $array['post_id'];
        $commentEntity->author = empty($array['author']) ? null : $array['author'];
        $commentEntity->content = empty($array['content']) ? null : $array['content'];
        $commentEntity->created = empty($array['created']) ? null : $array['created'];
        $commentEntity->is_validated = empty($array['is_validated']) ? null : $array['is_validated'];

        return $commentEntity;
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

        $entityChecker->check("is_validated", function ($value, $res): string {
            if (!empty($value) || is_bool($value)) {
                $res = "La validité du commentaire ne pas être définie à la création.";
            }

            return $res;
        }, "create");

        return $entityChecker->getErrors();
    }
}
