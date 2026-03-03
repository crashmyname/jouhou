<?php

namespace App\Models;
use Bpjs\Framework\Helpers\BaseModel;

class PlanProduction extends BaseModel
{
    // Model logic here
    public $table = 'p_production';
    protected $primaryKey = 'ppId';
    
    public function lane()
    {
        return $this->belongsTo(Lane::class,'laneId','laneId');
    }
}
