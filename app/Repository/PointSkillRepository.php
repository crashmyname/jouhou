<?php

namespace App\Repository;

use App\Models\PointSkill;

class PointSkillRepository
{
    // Repository here
    public function PointExists($id)
    {
        $point = PointSkill::query()->where('laneId','=',$id)->count();
        return $point;
    }
    public function getById($id)
    {
        return PointSkill::find($id);
    }
    public function getPointByLaneId($id)
    {
        $points = PointSkill::query()
            ->where('laneId', '=', $id)
            ->get();

        $result = [];

        foreach ($points as $point) {

            $data = (array) $point;

            $model = new PointSkill();
            $model->profil = $point->profil;

            $data['encrypt_url'] = $model->getEncryptUrl();

            $result[] = $data;
        }

        return $result;
    }

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
