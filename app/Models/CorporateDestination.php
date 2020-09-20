<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorporateDestination extends Model
{
    //
    protected $table = "corporate_destination";
    protected $fillable = ["corporate_id","name","desciption","is_active"];
}
