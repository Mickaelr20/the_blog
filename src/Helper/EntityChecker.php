<?php

namespace App\Helper;

use App\Model\Entity\Entity;

class EntityChecker
{

    private array $errors;
    private Entity $entity;

    public function __construct(Entity $entity)
    {
        $this->entity = $entity;
    }

    public function check($field_name, callable $callable): EntityChecker
    {
        $res = $callable($this->entity->$field_name, $res = "");
        if (!empty($res)) {
            $this->errors[$field_name] = $res;
        }

        return $this; //Pour le chainage
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    public function getErrors(): array
    {
        $errors = [];
        if ($this->hasErrors()) {
            $errors = $this->errors;
        }

        return $errors;
    }
}
