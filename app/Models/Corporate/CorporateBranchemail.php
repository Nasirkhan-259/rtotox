<?php

namespace App\Models\Corporate;

use Illuminate\Database\Eloquent\Model;

class CorporateBranchemail extends Model
{
    //
    protected $table = "corporate_branch_email";
    protected $fillable = ["corporate_id","branch_id","email_id","is_active"];
}
