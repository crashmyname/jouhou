<?php

namespace App\Models;
use Bpjs\Framework\Helpers\BaseModel;

class PointSkill extends BaseModel
{
    // Model logic here
    public $table = 'p_skill';
    protected $primaryKey = 'psId';
    protected $appends = ['encrypt_url'];

    public function lane()
    {
        return $this->belongsTo(Lane::class,'laneId','laneId');
    }

    public function getEncryptUrl()
    {
        return storage_secure('attachment/PointSkill/'.$this->profil,3600);
    }
}
