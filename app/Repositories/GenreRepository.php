<?php

namespace App\Repositories;

use App\Models\Genre as Model;
use Illuminate\Database\Eloquent\Collection;

class GenreRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    /////////////////////////////////////////////////////////////
    //  Берёт из базы все страны для выпадающего списка
    public function getAllGenres()
    {
        $result = $this
                ->startCondition()
                ->get();

        return $result;
    }

}


?>