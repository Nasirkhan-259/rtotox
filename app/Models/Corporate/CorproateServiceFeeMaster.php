<?php

namespace App\Models\Corporate;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CorproateServiceFeeMaster extends Model
{
    protected $table = "servicefee_master";

    public function getDetails($api){
         $result =  $this->hasOne('App\Models\Corporate\CorproateServiceFeeDetails', 'servicefee_id', 'id')->where('api',$api)
           ->first();
        $result->api_data = $result->getApi();
        return $result;
    }
}
