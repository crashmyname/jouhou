<?php

namespace App\Models;
use Bpjs\Framework\Helpers\BaseModel;

class LayoutSheet extends BaseModel
{
    // Model logic here
    public $table = 'l_sheet';
    protected $primaryKey = 'lId';

    public function lane()
    {
        return $this->belongsTo(Lane::class,'laneId','laneId');
    }
}
