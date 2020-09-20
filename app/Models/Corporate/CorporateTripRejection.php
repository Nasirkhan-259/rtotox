<?php

namespace App\Models\Corporate;

use Illuminate\Database\Eloquent\Model;

class CorporateTripRejection extends Model
{
    //
    protected $table = "corporate_triprejection";
    protected $fillable = ["corporate_id","tripreject","description","is_active"];
}
