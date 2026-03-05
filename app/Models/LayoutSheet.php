<?php

namespace App\Models;
use Bpjs\Framework\Helpers\BaseModel;

class LayoutSheet extends BaseModel
{
    // Model logic here
    public $table = 'l_sheet';
    protected $primaryKey = 'lId';
    protected $appends = ['encrypt_url'];

    public function lane()
    {
        return $this->belongsTo(Lane::class,'laneId','laneId');
    }

    public function getEncryptUrl()
    {
        return storage_secure('attachment/LayoutSheet/'.$this->image,3600);
    }
}
