<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorporateCostCenter extends Model
{
    //
    protected $table = "corporate_cost_center";
    protected $fillable = ["corporate_id","name","desciption","is_active"];
}
