<?php

namespace App\Models\Corporate;

use Illuminate\Database\Eloquent\Model;

class CorporateTripReason extends Model
{
    //
    protected $table = "corporate_tripreason";
    protected $fillable = ["corporate_id","tripreason","description","is_active"];
}
