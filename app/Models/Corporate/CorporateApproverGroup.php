<?php

namespace App\Models\Corporate;

use Illuminate\Database\Eloquent\Model;

class CorporateApproverGroup extends Model
{
    protected $table = "corporate_approver_group";


    public function Employee()
    {
        return $this->belongsTo(CorporateEmployee::class, "employee_id", "id");
    }
}
