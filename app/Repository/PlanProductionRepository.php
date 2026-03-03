<?php

namespace App\Repository;

use App\Models\PlanProduction;

class PlanProductionRepository
{
    // Repository here
    public function createPlanProd(array $data)
    {
        $planProd = PlanProduction::create($data);
        return $planProd->toArray();
    }

    public function updatePlanProd($id, array $data)
    {
        $planProd = PlanProduction::find($id);
        $planProd->update($data);
        return $planProd->toArray();
    }

    public function destroyPlanProd($id)
    {
        return PlanProduction::deleteWhere(['ppId'=>$id]);
    }
}
