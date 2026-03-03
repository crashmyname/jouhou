<?php

namespace App\Repository;

use App\Models\Cos;

class CosRepository
{
    // Repository here
    public function createCos(array $data)
    {
        $cos = Cos::create($data);
        return $cos;
    }

    public function updateCos($id, array $data)
    {
        $cos = Cos::find($id);
        $cos->update($data);
        return $cos->toArray();
    }

    public function deleteCos($id)
    {
        return Cos::deleteWhere(['cosId'=>$id]);
    }
}
