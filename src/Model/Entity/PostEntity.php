<?php

namespace App\Model\Entity;

use App\Helper\EntityChecker;

class PostEntity extends Entity
{
    public $id;
    public $author;
    public $hat;
    public $title;
    public $content;
    public $created;
    public $image;
    public $image_id;

    public function __construct()
    {
    }

    public static function fromArray(array $array): PostEntity
    {
        $postEntity = new PostEntity();

        $postEntity->id = empty($array['id']) ? null : $array['id'];
        $postEntity->author = empty($array['author']) ? null : $array['author'];
        $postEntity->hat = empty($array['hat']) ? null : $array['hat'];
        $postEntity->title = empty($array['title']) ? null : $array['title'];
        $postEntity->created = empty($array['created']) ? null : $array['created'];
        $postEntity->image = empty($array['image']) ? null : ImageEntity::fromArray($array['image']);
        $postEntity->image_id = empty($array['image_id']) ? null : $array['image_id'];

        $postEntity = $postEntity->sanitize();
        $postEntity->content = empty($array['content']) ? null : $array['content'];

        return $postEntity;
    }

    protected function checkCallable(EntityChecker $entityChecker, string $action = null): array
    {
        $entityChecker->check("id", function ($value, $res): string {
            if (!empty($value)) {
                $res = "L'id ne peut être définit par l'utilisateur.";
            }

            return $res;
        }, "create");

        return $entityChecker->getErrors();
    }

    public function setImage(ImageEntity $imageEntity)
    {
        $this->image = $imageEntity;
        $this->image_id = $imageEntity->id;
    }
}
