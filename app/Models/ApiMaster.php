<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiMaster extends Model
{
    //
    protected $table = "apis";

    public function jsonDecode($model){
        $this->{$model} =  json_decode($this->{$model});
    }
}
