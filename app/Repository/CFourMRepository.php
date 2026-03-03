<?php

namespace App\Repository;

use App\Models\CFourM;

class CFourMRepository
{
    // Repository here
    public function create4M(array $data)
    {
        return CFourM::create($data)->toArray();
    }

    public function update4M($id, array $data)
    {
        $fourM = CFourM::find($id);
        $fourM->update($data);
        return $fourM->toArray();
    }

    public function destroy4M($id)
    {
        return CFourM::deleteWhere(['c4mId'=>$id]);
    }
}
