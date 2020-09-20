<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Models\Corporate\CorporateApprover;
use App\Models\Corporate\CorporateApproverGroup;
use App\Models\Corporate\CorporateDepartment;
use App\Models\Corporate\CorporateWorkFlow;
use App\Models\Corporate\CorporateWorkFlowGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApproverWorkFlowController extends Controller
{

    public function __construct()
    {
    }
    public function index()
    {
        $workflow = CorporateWorkFlow::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->orderBy('id', 'DESC')->get();
        return view('corporate.workflow',compact('workflow'));
    }
    public function add(Request $request)
    {
        $approvers = CorporateApprover::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->orderBy('id', 'DESC')->get();
        $approvers_ids = [];
        return view('corporate.workflow_add',compact('approvers','approvers_ids'));
    }
    public function add_post(Request $request)
    {
        $result = $request->all();
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $corporate_approver = new CorporateWorkFlow();
        $corporate_approver->corporate_id = $corporate_id;
        if(!empty($result["is_active"])){
            $corporate_approver->is_active = 1;
        }else{
            $corporate_approver->is_active = 0;
        }
        $corporate_approver->workflow_name = $result["workflow_name"];
        $corporate_approver->save();

        if(!empty($result["select_value"]))
        {
            foreach ($result["select_value"] as $item )
            {
                $corporate_group = new CorporateWorkFlowGroup();
                $corporate_group->approver_id = $item;
                $corporate_group->workflow_id = $corporate_approver->id;
                $corporate_group->sequence_number = $request->sequence_number.$item;
                $corporate_group->save();
            }
        }
        return array("status"=>true);
    }
    public function edit($id)
    {
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $workflow = CorporateWorkFlow::where('corporate_id',$corporate_id)->where('id',$id)->first();
        $approvers = CorporateApprover::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->orderBy('id', 'DESC')->get();
        $approvers_ids_sequence = CorporateWorkFlowGroup::where('workflow_id',$id)->pluck('sequence_number','approver_id')->toArray();
        $approvers_ids = array_keys($approvers_ids_sequence);
        return view('corporate.workflow_add',compact('approvers','workflow','id','approvers_ids','approvers_ids_sequence'));
    }
    public function update(Request $request)
    {
        $result = $request->all();
        $corporate_approver =  CorporateWorkFlow::where('id',$result['id'])->first();
        if(!empty($result["is_active"])){
            $corporate_approver->is_active = 1;
        }else{
            $corporate_approver->is_active = 0;
        }
        $corporate_approver->workflow_name = $result["workflow_name"];
        $corporate_approver->save();
        $delete_corporate = CorporateWorkFlowGroup::where('workflow_id',$result["id"])->delete();
        if(!empty($result["select_value"]))
        {
            foreach ($result["select_value"] as $item )
            {
                $corporate_group = new CorporateWorkFlowGroup();
                $corporate_group->approver_id = $item;
                $corporate_group->workflow_id = $corporate_approver->id;
                $corporate_group->sequence_number = $result["sequence_number".$item];
                $corporate_group->save();
            }
        }
        return array("status"=>true);
    }

}
