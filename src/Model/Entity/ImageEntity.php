<?php

namespace App\Model\Entity;

use App\Helper\EntityChecker;

class ImageEntity extends Entity
{
    public $id;
    public $display_name;
    public $file_name;
    public $path;

    public function __construct()
    {
    }

    public function patchEntity(array $array): ImageEntity
    {
        $this->id = empty($array['id']) ? null : $array['id'];
        $this->display_name = empty($array['display_name']) ? null : $array['display_name'];
        $this->file_name = empty($array['file_name']) ? null : $array['file_name'];
        $this->path = empty($array['path']) ? null : $array['path'];

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

        return $entityChecker->getErrors();
    }

    public function getFullPath()
    {
        return $this->path . $this->file_name;
    }

    public function completeEntity($name): ImageEntity
    {
        $path = 'img/posts/';

        $this->file_name = time() . "_" . $this->generateRandomString() . "." . $this->getFileExtension($name);
        $this->path = $path;

        return $this;
    }

    private function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function getFileExtension($fileName)
    {
        $res = "";
        $split = explode('.', $fileName);

        if (!empty($split[count($split) - 1])) {
            $res = $split[count($split) - 1];
        }

        return $res;
    }
}
