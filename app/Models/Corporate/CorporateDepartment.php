<?php

namespace App\Models\Corporate;

use Illuminate\Database\Eloquent\Model;

class CorporateDepartment extends Model
{
    protected $table = "corporate_department";
    protected $fillable = ["corporate_id","name","desciption","is_active"];
}
