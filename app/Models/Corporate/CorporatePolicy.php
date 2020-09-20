<?php

namespace App\Models\Corporate;

use Illuminate\Database\Eloquent\Model;

class CorporatePolicy extends Model
{
    protected $table = "corporate_policy";
    protected $fillable = ["corporate_id","policyname","is_active","description"];

}
