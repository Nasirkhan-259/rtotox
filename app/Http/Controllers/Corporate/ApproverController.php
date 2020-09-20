<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Models\Corporate\CorporateApprover;
use App\Models\Corporate\CorporateApproverGroup;
use App\Models\Corporate\CorporateDepartment;
use App\Models\Corporate\CorporateEmployee;
use App\Models\Corporate\CorporateWorkFlowGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApproverController extends Controller
{
    //

    /**
     * DepartmentsController constructor.
     */
    public function __construct()
    {
    }
    public function index()
    {
        $approvers = CorporateApprover::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->orderBy('id', 'DESC')->get();
        return view('corporate.approver',compact('approvers'));
    }
    public function add(Request $request)
    {
        $user_id = Auth::guard('corporate')->user()->corporate_id;
        $approvers = DB::table('corporate_employees')
            ->where("corporate_id",$user_id)->where('is_approver',1)->get();
        return view('corporate.approver_add',compact('approvers'));
    }
    public function add_post(Request $request)
    {
        $result = $request->all();
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $corporate_approver = new CorporateApprover();
        $corporate_approver->corporate_id = $corporate_id;
        if(!empty($result["all_approved"])){
            $corporate_approver->all_approved = 1;
        }else{
            $corporate_approver->all_approved = 0;
        }
        if(!empty($result["is_active"])){
            $corporate_approver->is_active = 1;
        }else{
            $corporate_approver->is_active = 0;
        }
        $corporate_approver->approver_name = $result["approver_name"];
        $corporate_approver->save();

        if(!empty($result["select_value"]))
        {
            foreach ($result["select_value"] as $item )
            {
                $corporate_group = new CorporateApproverGroup();
                $corporate_group->approver_id = $corporate_approver->id;
                $corporate_group->employee_id = $item;
                $corporate_group->save();
            }
        }
        return array("status"=>true);
    }
    public function check_query()
    {
        $employees = DB::table('corporate_employees')
            ->select("corporate_employees.id","corporate_employees.firstname")
            ->where("corporate_employees.corporate_id", Auth::guard('corporate')->user()->corporate_id)
            ->where("corporate_employees.workflow_id", 7)
            ->join('corporate_approver_workflow_group', 'corporate_approver_workflow_group.workflow_id', '=', 'corporate_employees.workflow_id')
            ->join('corporate_approver_group', 'corporate_approver_group.approver_id', '=', 'corporate_approver_workflow_group.approver_id')
            ->get();
        dd($employees);
    }
    public function edit($id)
    {
        $user_id = Auth::guard('corporate')->user()->corporate_id;
        $approver_group = CorporateApprover::where('id',$id)->first();
        $approvers = DB::table('corporate_employees')
            ->where("corporate_id",$user_id)->where('is_approver',1)->get();
        $employee_ids = CorporateApproverGroup::where('approver_id',$id)->pluck('employee_id')->toArray();
        return view('corporate.approver_add',compact('approvers','approver_group','employee_ids'));

    }
    public function update(Request $request)
    {
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $result = $request->all();
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $corporate_approver =  CorporateApprover::where('id',$result["id"])->first();
        $corporate_approver->corporate_id = $corporate_id;
        if(!empty($result["all_approved"])){
            $corporate_approver->all_approved = 1;
        }else{
            $corporate_approver->all_approved = 0;
        }
        if(!empty($result["is_active"])){
            $corporate_approver->is_active = 1;
        }else{
            $corporate_approver->is_active = 0;
        }
        $corporate_approver->approver_name = $result["approver_name"];
        $corporate_approver->save();

        if(!empty($result["select_value"]))
        {
            $delete_corporate = CorporateApproverGroup::where('approver_id',$result["id"])->delete();
            foreach ($result["select_value"] as $item )
            {
                $corporate_group = new CorporateApproverGroup();
                $corporate_group->approver_id = $corporate_approver->id;
                $corporate_group->employee_id = $item;
                $corporate_group->save();
            }
        }
        return array("status"=>true);
    }

}
