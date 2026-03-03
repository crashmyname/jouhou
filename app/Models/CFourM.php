<?php

namespace App\Models;
use Bpjs\Framework\Helpers\BaseModel;

class CFourM extends BaseModel
{
    // Model logic here
    public $table = 'c_4m';
    protected $primaryKey = 'c4mId';

    public function lane()
    {
        return $this->belongsTo(Lane::class,'laneId','laneId');
    }
}
