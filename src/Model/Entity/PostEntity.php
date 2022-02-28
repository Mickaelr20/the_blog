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

    public function patchEntity(array $array): PostEntity
    {
        $this->id = empty($array['id']) ? null : $array['id'];
        $this->author = empty($array['author']) ? null : $array['author'];
        $this->hat = empty($array['hat']) ? null : $array['hat'];
        $this->title = empty($array['title']) ? null : $array['title'];
        $this->created = empty($array['created']) ? null : $array['created'];
        $this->image = empty($array['image']) ? null : (new ImageEntity())->patchEntity($array['image']);
        $this->image_id = empty($array['image_id']) ? null : $array['image_id'];

        $this->sanitize();
        $this->content = empty($array['content']) ? null : $array['content'];

        return $this;
    }

    protected function checkCallable(EntityChecker $entityChecker, string $action = null): array
    {
        $entityChecker->check("id", function ($value, $res): string {
            if (!empty($value)) {
                return "L'id ne peut être définit par l'utilisateur.";
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
