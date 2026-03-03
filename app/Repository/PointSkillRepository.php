<?php

namespace App\Repository;

use App\Models\PointSkill;

class PointSkillRepository
{
    // Repository here
    public function createPoint(array $data)
    {
        $point = PointSkill::create($data);
        return $point->toArray();
    }

    public function updatePoint($id, array $data)
    {
        $point = PointSkill::find($id);
        $point->update($data);
        return $point->toArray();
    }

    public function destroyPoint($id)
    {
        return PointSkill::deleteWhere(['psId'=>$id]);
    }
}
