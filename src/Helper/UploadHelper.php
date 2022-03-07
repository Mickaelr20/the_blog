<?php

namespace App\Helper;

use App\Model\Entity\Entity;
use App\Model\Table\Table;
use App\Helper\RequestHelper;

class UploadHelper
{
    public function __construct(Table $table, string $dataName)
    {
        $this->table = $table;
        $this->dataName = $dataName;
        $this->request = new RequestHelper();
        $this->possibleTypes = [];
    }

    public function setPossibleTypes(array $possibleTypes): UploadHelper
    {
        $this->possibleTypes = $possibleTypes;
        return $this;
    }

    public function create(Entity $entity, $toPath): array
    {
        try {
            $this->table->save($entity);
        } catch (\Exception $e) {
            return ["Une erreure est survenue lors de la sauvegarde de l'image, veuillez réessayer ultérieurement."];
        }

        $requestData = $this->request->getRequestData();
        $fileData = $requestData['FILES'][$this->dataName];

        if (!in_array($fileData['type'], $this->possibleTypes)) {
            return ["Le type de fichier n'est pas supporté."];
        }

        $tmpName = $fileData['tmp_name'];

        $moveUploadedFile = @move_uploaded_file($tmpName, $toPath);
        if (!$moveUploadedFile) {
            $error = "Impossible d'ajouter l'image sur le disque.";

            try {
                $this->table->delete($entity->id);
            } catch (\Exception $e) {
                $error = "Une erreure est survenue lors de la sauvegarde de l'image, veuillez réessayer ultérieurement.";
            }
            return [$error];
        }

        return [];
    }

    public function update(Entity $entity): array
    {
        $result = [];

        return $result;
    }

    public function delete(Entity $entity, string $fullPath): array
    {
        try {
            if (!empty($entity->id)) {
                $this->table->delete($entity->id);
            }
        } catch (\Exception $e) {
            return ["Une erreure est survenue lors de la suppression de l'image, veuillez réessayer ultérieurement."];
        }

        if (file_exists($fullPath)) {
            unlink($fullPath);
        }

        return [];
    }
}
