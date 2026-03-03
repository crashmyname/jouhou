<?php

namespace App\Repository;

use App\Models\Lane;

class LaneRepository
{
    // Repository here
    public function createLane(array $data)
    {
        $lane = Lane::create($data);
        return $lane->toArray();
    }

    public function updateLane($id, array $data)
    {
        $lane = Lane::find($id);
        $lane->update($data);
        return $lane->toArray();
    }

    public function destroyLane($id)
    {
        return Lane::deleteWhere(['laneId'=>$id]);
    }
}
