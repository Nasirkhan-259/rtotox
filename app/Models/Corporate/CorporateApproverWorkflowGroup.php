<?php

namespace App\Models\Corporate;

use Illuminate\Database\Eloquent\Model;

class CorporateApproverWorkflowGroup extends Model
{
    protected $table = "corporate_approver_workflow_group";


    public function ApproverGroup()
    {
        return $this->belongsTo(CorporateApprover::class, 'approver_id', "id");
    }

    public function CorporateApproverGroupMember()
    {
        return $this->hasMany(CorporateApproverGroup::class, 'approver_id', "approver_id");
    }
}
