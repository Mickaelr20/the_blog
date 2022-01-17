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

    public static function fromArray(array $array): UserEntity
    {
        $userEntity = new UserEntity();

        $userEntity->id = empty($array['id']) ? null : $array['id'];
        $userEntity->first_name = empty($array['first_name']) ? null : $array['first_name'];
        $userEntity->last_name = empty($array['last_name']) ? null : $array['last_name'];
        $userEntity->nickname = empty($array['nickname']) ? null : $array['nickname'];
        $userEntity->password = empty($array['password']) ? null : $array['password'];
        $userEntity->email = empty($array['email']) ? null : $array['email'];
        $userEntity->is_validated = empty($array['is_validated']) ? null : $array['is_validated'];

        return $userEntity->sanitize();
    }

    protected function checkCallable(EntityChecker $entityChecker, string $action = null): array
    {
        $entityChecker->check("id", function ($value, $res): string {
            if (!empty($value)) {
                $res = "L'id ne peut être définit par l'utilisateur.";
            }

            return $res;
        }, "create");

        $entityChecker->check("first_name", function ($value, $res): string {
            if (!empty($value)) {
                if (gettype($value) === "string") {
                    if (strlen($value) <= 3) {
                        $res = "Le prénom est trop court, il doit contenir plus de 3 caractères.";
                    } else if (strlen($value) > 255) {
                        $res = "Le prénom est trop long, il doit contenir moins de 255 caractères.";
                    }
                } else {
                    $res = "Le prénom doit être une chaine de caractère.";
                }
            } else {
                $res = "Un prénom doit être précisé.";
            }

            return $res;
        }, "create");

        $entityChecker->check("last_name", function ($value, $res): string {
            if (!empty($value)) {
                if (gettype($value) === "string") {
                    if (strlen($value) <= 3) {
                        $res = "Le nom est trop court, il doit contenir plus de 3 caractères.";
                    } else if (strlen($value) > 255) {
                        $res = "Le nom est trop long, il doit contenir moins de 255 caractères.";
                    }
                } else {
                    $res = "Le nom doit être une chaine de caractère.";
                }
            } else {
                $res = "Un nom doit être précisé.";
            }

            return $res;
        }, "create");

        $entityChecker->check("nickname", function ($value, $res): string {
            if (!empty($value)) {
                if (gettype($value) === "string") {
                    if (strlen($value) <= 3) {
                        $res = "Le pseudo est trop court, il doit contenir plus de 3 caractères.";
                    } else if (strlen($value) > 255) {
                        $res = "Le pseudo est trop long, il doit contenir moins de 255 caractères.";
                    }
                } else {
                    $res = "Le pseudo doit être une chaine de caractère.";
                }
            } else {
                $res = "Un pseudo doit être précisé.";
            }

            return $res;
        });


        $entityChecker->check("password", function ($value, $res): string {
            if (!empty($value)) {
                if (gettype($value) === "string") {
                    if (strlen($value) <= 4) {
                        $res = "Le mot de passe est trop court, il doit contenir plus de 4 caractères.";
                    } else if (strlen($value) > 255) {
                        $res = "Le mot de passe est trop long, il doit contenir moins de 255 caractères.";
                    }
                } else {
                    $res = "Le mot de passe doit être une chaine de caractère.";
                }
            } else {
                $res = "Un mot de passe doit être précisé.";
            }

            return $res;
        }, "create");

        $entityChecker->check("email", function ($value, $res): string {
            if (!empty($value)) {
                if (gettype($value) === "string") {
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $res = "L'email fournit est invalide.";
                    }
                } else {
                    $res = "L'email doit être une chaine de caractère.";
                }
            } else {
                $res = "Un email doit être précisé.";
            }

            return $res;
        }, "create");

        $entityChecker->check("is_validated", function ($value, $res): string {
            if (!empty($value) || is_bool($value)) {
                $res = "La validité de l'utilisateur ne pas être définie à la création.";
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
