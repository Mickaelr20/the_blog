<?php

namespace App\Helper;

use App\Model\Entity\Entity;

class EntityChecker
{

    private array $errors;
    private string|null $action;
    private Entity $entity;

    public function __construct(Entity $entity, string|null $action)
    {
        $this->entity = $entity;
        $this->action = $action;
    }

    public function check($field_name, callable $callable, string|null $when = null): EntityChecker
    {
        if (empty($when) || $when === $this->action) {
            $res = $callable($this->entity->$field_name, $res = "", $when);
            if (!empty($res)) {
                $this->errors[$field_name] = $res;
            }
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
