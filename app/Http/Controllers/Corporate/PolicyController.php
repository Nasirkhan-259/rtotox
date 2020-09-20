<?php

namespace App\Http\Controllers\Corporate;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Corporate\CorporateApprover;
use App\Models\Corporate\CorporateApproverGroup;
use App\Models\Corporate\CorporateDepartment;
use App\Models\Corporate\CorporateEmployee;
use App\Models\Corporate\CorporateFlightRule;
use App\Models\Corporate\CorporateMaster;
use App\Models\Corporate\CorporatePolicy;
use App\Models\Corporate\CorporatePolicyDetail;
use App\Models\Corporate\CorporateWorkFlowGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PolicyController extends Controller
{

    public function __construct()
    {
    }
    public function index()
    {
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;

        $levels = CorporatePolicy::where('corporate_id',$corporate_id)->orderBy('id', 'DESC')->get();
        return view('corporate.level',compact('levels'));
    }
    public function add(Request $request)
    {
        return view('corporate.level_add');
    }
    public function add_post(Request $request)
    {
        $result = $request->all();
        $result["corporate_id"] = Auth::guard('corporate')->user()->corporate_id;
        CorporatePolicy::create($result);
        return array("status"=>true);
    }
    public function edit($id)
    {
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $level = CorporatePolicy::where('id',$id)->where("corporate_id",$corporate_id)->orderBy('id', 'DESC')->first();
        return view('corporate.level_add',compact('level'));
    }
    public function setup($id)
    {
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $policy = CorporatePolicyDetail::where('policy_id',$id)->where("corporate_id",$corporate_id)->where('policy_id',$id)->orderBy('id', 'DESC')->first();
        $rules = CorporateFlightRule::where("corporate_id",$corporate_id)->get();
        if(!empty($policy->rotational_values))
        {
            $policy->rotational_values = json_decode($policy->rotational_values,true);

        }
        return view('corporate.level_policy',compact('policy','id','rules'));
    }
    public function setup_add(Request $request)
    {
        $result = $request->all();
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $result["corporate_id"] = $corporate_id;
        CorporatePolicyDetail::where('policy_id',$result["policy_id"])->delete();
        $result["rotational_values"] = json_encode($result["select_values"]);
        $policy_create = CorporatePolicyDetail::create($result);
        return array("status"=>true);
    }
    public function update(Request $request)
    {
        $result = $request->all();
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $department = CorporatePolicy::where('corporate_id',$corporate_id)->where('id',$result["id"])->first();
        $department->policyname = $result["policyname"];
        $department->description = $result["description"];
        $department->is_active = $result["is_active"];
        $department->save();
        return array("status"=>true);
    }

}
