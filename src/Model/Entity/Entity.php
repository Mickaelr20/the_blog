<?php

namespace App\Model\Entity;

use App\Helper\EntityChecker;

abstract class Entity
{
    protected function __construct()
    {
    }

    // abstract public static function fromArray(array $array): Entity;
    abstract public function patchEntity(array $array): Entity;

    abstract protected function checkCallable(EntityChecker $entityChecker, string|null $action = null): array;

    public function verifyEntity(string|null $action = null): array
    {
        return $this->checkCallable(new EntityChecker($this, $action));
    }

    public function toArray($options = [])
    {
        $res = (array) $this;

        if (!empty($options)) {
            $tempRes = [];
            foreach ($options as $key => $value) {

                if (!empty($value) && is_array($value)) {
                    $tempRes[$key] = [$res[$key], $value[0]];
                } else {
                    $tempRes[$value] = $res[$value];
                }
            }

            $res = $tempRes;
        }

        return $res;
    }

    public function sanitize()
    {
        foreach ($this as $k => $v) {
            if (!is_array($v) && !is_object($v)) {
                $this->$k = htmlspecialchars(trim($v));
            }
        }

        return $this;
    }
}
