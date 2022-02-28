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

    public function patchEntity(array $array): CommentEntity
    {
        $this->id = empty($array['id']) ? null : $array['id'];
        $this->post_id = empty($array['post_id']) ? null : $array['post_id'];
        $this->author = empty($array['author']) ? null : $array['author'];
        $this->content = empty($array['content']) ? null : $array['content'];
        $this->created = empty($array['created']) ? null : $array['created'];
        $this->is_validated = empty($array['is_validated']) ? null : $array['is_validated'];

        return $this->sanitize();
    }

    protected function checkCallable(EntityChecker $entityChecker, string $action = null): array
    {
        $entityChecker->check("id", function ($value, $res): string {
            if (!empty($value)) {
                return "L'id ne peut être définit par l'utilisateur.";
            }

            return $res;
        }, "create");

        $entityChecker->check("post_id", function ($value, $res): string {
            if (empty($value)) {
                return "La publication doit être précisé.";
            }

            return $res;
        });

        $entityChecker->check("author", function ($value, $res): string {
            if (empty($value)) {
                return "L'autheur doit être précisé.";
            }

            return $res;
        }, "create");

        $entityChecker->check("content", function ($value, $res): string {
            if (empty($value)) {
                return "Le contenu doit être précisé.";
            }

            return $res;
        }, "create");

        $entityChecker->check("created", function ($value, $res): string {
            if (!empty($value)) {
                return "La date de création ne peut pas être précisé";
            }

            return $res;
        }, "create");

        $entityChecker->check("is_validated", function ($value, $res): string {
            if (!empty($value) || is_bool($value)) {
                return "La validité du commentaire ne pas être définie à la création.";
            }

            return $res;
        }, "create");

        return $entityChecker->getErrors();
    }
}
