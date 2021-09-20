<?php

namespace App\Model\Entity;

use App\Helper\EntityChecker;

abstract class Entity
{
    protected function __construct()
    {
    }

    public function fromArray($array)
    {
        foreach ($array as $key => $value) {
            $this->$key = $value;
        }
    }

    abstract protected function checkCallable(EntityChecker $entityChecker): array;

    public function verifyEntity(): array
    {
        return $this->checkCallable(new EntityChecker($this));
    }

    public function toArray()
    {
        return (array) $this;
    }
}
