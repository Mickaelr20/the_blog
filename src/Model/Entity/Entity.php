<?php

namespace App\Model\Entity;

use App\Helper\EntityChecker;

abstract class Entity
{
    protected function __construct()
    {
    }

    abstract public static function fromArray(array $array): Entity;

    abstract protected function checkCallable(EntityChecker $entityChecker, string|null $action = null): array;

    public function verifyEntity(string|null $action = null): array
    {
        return $this->checkCallable(new EntityChecker($this, $action));
    }

    public function toArray($options = [])
    {
        $res = (array) $this;

        if (!empty($options)) {
            $t_res = [];
            foreach ($options as $key => $value) {

                if (!empty($value) && is_array($value)) {
                    $t_res[$key] = [$res[$key], $value[0]];
                } else {
                    $t_res[$value] = $res[$value];
                }
            }

            $res = $t_res;
        }

        return $res;
    }
}
