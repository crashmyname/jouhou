<?php

namespace App\Repository;

use App\Models\Cos;

class CosRepository
{
    // Repository here
    public function cosIsExists($id)
    {
        return Cos::exists(['laneId' => $id]);
    }
    public function getCosByLaneId($id)
    {
        $cos = Cos::find($id);
        if($cos){
            $data = $cos->toArray();
            $data['format_date'] = $cos->iDFormat();
            $data['format_date_claim'] = $cos->idFormatClaim();
            return $data;
        }
    }
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
