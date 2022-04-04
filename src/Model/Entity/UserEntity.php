<?php

namespace App\Model\Entity;

use App\Helper\EntityChecker;

class UserEntity extends Entity
{
    public $id;
    public $first_name;
    public $last_name;
    public $nickname;
    public $password;
    public $email;
    public $is_validated;


    public function __construct()
    {
    }

    public function patchEntity(array $array): UserEntity
    {
        $this->id = empty($array['id']) ? null : $array['id'];
        $this->first_name = empty($array['first_name']) ? null : $array['first_name'];
        $this->last_name = empty($array['last_name']) ? null : $array['last_name'];
        $this->nickname = empty($array['nickname']) ? null : $array['nickname'];
        $this->password = empty($array['password']) ? null : $array['password'];
        $this->email = empty($array['email']) ? null : $array['email'];
        $this->is_validated = empty($array['is_validated']) ? null : $array['is_validated'];

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

        $entityChecker->check("first_name", function ($value, $res): string {
            if (empty($value)) {
                return "Un prénom doit être précisé.";
            }
            if (gettype($value) !== "string") {
                return "Le prénom doit être une chaine de caractère.";
            }
            if (strlen($value) <= 3) {
                return "Le prénom est trop court, il doit contenir plus de 3 caractères.";
            }

            if (strlen($value) > 255) {
                return "Le prénom est trop long, il doit contenir moins de 255 caractères.";
            }
            return $res;
        }, "create");

        $entityChecker->check("last_name", function ($value, $res): string {
            if (empty($value)) {
                return "Un nom doit être précisé.";
            }
            if (gettype($value) !== "string") {
                return "Le nom doit être une chaine de caractère.";
            }
            if (strlen($value) <= 3) {
                return "Le nom est trop court, il doit contenir plus de 3 caractères.";
            }
            if (strlen($value) > 255) {
                return "Le nom est trop long, il doit contenir moins de 255 caractères.";
            }
            return $res;
        }, "create");

        $entityChecker->check("nickname", function ($value, $res): string {
            if (empty($value)) {
                return "Un pseudo doit être précisé.";
            }
            if (gettype($value) !== "string") {
                return "Le pseudo doit être une chaine de caractère.";
            }
            if (strlen($value) <= 3) {
                return "Le pseudo est trop court, il doit contenir plus de 3 caractères.";
            }
            if (strlen($value) > 255) {
                return "Le pseudo est trop long, il doit contenir moins de 255 caractères.";
            }
            return $res;
        });


        $entityChecker->check("password", function ($value, $res): string {
            if (empty($value)) {
                return "Un mot de passe doit être précisé.";
            }
            if (gettype($value) !== "string") {
                return "Le mot de passe doit être une chaine de caractère.";
            }
            if (strlen($value) <= 4) {
                return "Le mot de passe est trop court, il doit contenir plus de 4 caractères.";
            }
            if (strlen($value) > 255) {
                return "Le mot de passe est trop long, il doit contenir moins de 255 caractères.";
            }
            return $res;
        }, "create");

        $entityChecker->check("email", function ($value, $res): string {
            if (empty($value)) {
                return "Un email doit être précisé.";
            }
            if (gettype($value) === "string" && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                return "L'email fournit est invalide.";
            }
            if (gettype($value) !== "string") {
                return "L'email doit être une chaine de caractère.";
            }
            return $res;
        }, "create");

        $entityChecker->check("is_validated", function ($value, $res): string {
            if (!empty($value) || is_bool($value)) {
                return "La validité de l'utilisateur ne pas être définie à la création.";
            }
            return $res;
        }, "create");

        return $entityChecker->getErrors();
    }

    public function securize(): UserEntity
    {
        $res = $this;
        $res->password = password_hash($this->password, PASSWORD_DEFAULT);

        return $res;
    }
}
