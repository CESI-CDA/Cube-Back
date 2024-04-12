<?php

namespace App\Services;

use DateTime;

class DefaultService
{
    public function getPaginateData($queryModel, $validatedData, $column, $withModels)
    {
        //Verification des données sort_by, sort_order et per_page et remplacement si null
        $sortBy = $validatedData['sort_by'] ?? $column;
        $sortOrder = $validatedData['sort_order'] ?? 'asc';
        $perPage = $validatedData['per_page'] ?? 10;

        return $queryModel->with($withModels)->orderBy($sortBy, $sortOrder)->paginate($perPage);
    }

    //Items d'un index basique : per_page, keyword, sort_by, sort_order
    public function dataIndexBasique($typageIndexRequest, $queryModel, $keywordColumns, $withModels)
    {
        //Validation des données
        $validatedData = $typageIndexRequest->validated();

        //Seulement les items qui ne sont pas deleted
        $queryModel->where('deleted', false);

        //Trie des données suivant le mot clef
        $keyword = $validatedData['keyword'] ?? null;
        $queryModel->where(function ($q) use ($keywordColumns, $keyword) {
            foreach ($keywordColumns as $column) {
                $q->orWhere($column, 'like', "%$keyword%");
            }
        });

        return $this->getPaginateData($queryModel, $validatedData, $keywordColumns[0], $withModels);
    }

    public function checkIdType($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            throw new \InvalidArgumentException('L\'ID doit être un nombre entier positif.');
        }
        return $id;
    }

    public function checkStringType($string)
    {
        if (!is_string($string)) {
            throw new \InvalidArgumentException('Le champ n\'est pas une chaine de caractère.');
        }
        return $string;
    }

    public function checkDateType($date)
    {
        $dateToCompare = DateTime::createFromFormat('Y-m-d', $date);
        if ($date !== $dateToCompare->format('Y-m-d')) {
            throw new \InvalidArgumentException('Le champ n\'est pas une date au format Y-m-d.');
        }
        return $date;
    }
}
