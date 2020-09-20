<?php

namespace App\Models\Corporate;

use Illuminate\Database\Eloquent\Model;

class CorproateServiceFeeDetails extends Model
{
    //
    protected $table = "servicefee_details";

    public function getApi(){
       return $this->hasOne('App\Models\ApiMaster','id','api')->first();
    }
}
