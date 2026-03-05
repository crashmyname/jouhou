<?php

namespace App\Models;
use Bpjs\Framework\Helpers\BaseModel;

class Cos extends BaseModel
{
    // Model logic here
    public $table = 'c_o_situation';
    protected $primaryKey = 'cosId';

    public function lane()
    {
        return $this->belongsTo(Lane::class,'laneId','laneId');
    }

    public static function dataIsExsist($id)
    {
        self::find($id);
    }
}
