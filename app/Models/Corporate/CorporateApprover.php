<?php

namespace App\Models\Corporate;

use Illuminate\Database\Eloquent\Model;

class CorporateApprover extends Model
{
    protected $table = "corporate_approver";

    public function group_approver()
    {
        return $this->hasMany('App\Models\Corporate\CorporateApproverGroup', 'approver_id');
    }

    protected function Members()
    {
        return $this->hasMany(CorporateApproverGroup::class, "approver_id", "id");
    }
}
