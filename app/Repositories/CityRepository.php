<?php

namespace App\Repositories;

use App\Models\City as Model;
use Illuminate\Database\Eloquent\Collection;

class CityRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    /////////////////////////////////////////////////////////////
    //  Берёт из базы все города для выпадающего списка
    public function getAllCities()
    {
        $result = $this
                ->startCondition()
                ->get();

        return $result;
    }
}


?>