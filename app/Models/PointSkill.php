<?php

namespace App\Models;
use Bpjs\Framework\Helpers\BaseModel;

class PointSkill extends BaseModel
{
    // Model logic here
    public $table = 'p_skill';
    protected $primaryKey = 'psId';

    public function lane()
    {
        return $this->belongsTo(Lane::class,'laneId','laneId');
    }
}
