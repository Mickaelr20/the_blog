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
