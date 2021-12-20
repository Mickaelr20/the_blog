<?php

namespace App\Model\Entity;

use App\Helper\EntityChecker;

abstract class Entity
{

    protected array $entityAssociations = [];

    protected function __construct()
    {
    }

    abstract public static function fromArray(array $array): Entity;

    /* * * * * * * * *
    value is_array && entityAssociations contains key ==> patch
    else key = value
    
    */
    public function patchEntity($array, $entityAssociations = null, $sub_items = [])
    {
        if ($entityAssociations === null && !empty($this->entityAssociations)) {
            $entityAssociations = $this->entityAssociations;
        }

        foreach ($array as $key => $value) {
            if (is_array($value) && !empty($entityAssociations)) {
                $sub_items[] = $key;

                // echo "<br /><br />Sub item added:";
                // var_dump($sub_items);
                // echo "<br /><br />";


                if (array_key_exists($key . "s", $entityAssociations)) {
                    $this->patchEntity($value, $entityAssociations[$key], $sub_items);
                } else if (in_array($key . "s", $entityAssociations)) {
                    $this->patchEntity($value, [], $sub_items);
                }
            } else {
                $this->setValue($sub_items, $value, $this);

                // echo "<br /><br />";
                // var_dump($sub_items);
                // echo "<br />";
                // var_dump($ref);
                // echo "<br /><br />";
                // var_dump($this);
            }
        }
    }

    private function setValue($path = [], $value, $object = null)
    {
        var_dump($path);
        $key = array_shift($path);

        var_dump($key);
        var_dump(isset($object->$key));
        echo "<br />";
        $entityName = ucfirst($key) . "Entity";
        if (!empty($key) && gettype($object->$key) == $entityName) {
            $object->$key = new ("\App\Model\Entity\\" . $entityName);
            echo "objet key empty";
        }

        if (!empty($path)) {
            $this->setValue($path, $value, $object->$key);
        } else {
            $object->$key = $value;
        }
    }

    // public function patchEntity($array, $sub_items = [])
    // {
    //     foreach ($array as $key => $value) {
    //         if (is_array($value)) {
    //             $this->fromArray($value, $sub_items[] = $key);
    //         } else {
    //             $ref = $this->$key;
    //             foreach ($sub_items as $sub_item) {
    //                 $ref = $ref->$sub_item;
    //             }

    //             $ref = $value;
    //         }
    //     }
    // }

    // public function fromArray($array)
    // {
    //     foreach ($array as $key => $value) {
    //         $toSet = $value;

    //         if (!empty($this->entityAssociations) && is_array($value) && in_array($key . "s", $this->entityAssociations)) {
    //             $entity = new ("\App\Model\Entity\\" . ucfirst($key) . "Entity");
    //             $entity->fromArray($value);
    //             $toSet = $entity;
    //         }

    //         $this->$key = $toSet;
    //     }
    // }

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
