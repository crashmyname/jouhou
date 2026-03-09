<?php

namespace App\Models;
use Bpjs\Framework\Helpers\BaseModel;
use Bpjs\Framework\Helpers\Date;

class Cos extends BaseModel
{
    // Model logic here
    public $table = 'c_o_situation';
    protected $primaryKey = 'cosId';
    protected $appends = ['format_date','format_date_claim'];

    public function lane()
    {
        return $this->belongsTo(Lane::class,'laneId','laneId');
    }

    public static function dataIsExsist($id)
    {
        self::find($id);
    }

    public function iDFormat()
    {
        return Date::parse($this->date)->format('d-m-Y');
    }

    public function iDFormatClaim()
    {
        return Date::parse($this->lasClaim)->format('d-m-Y');
    }
}
