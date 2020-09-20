<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Models\Corporate\CorporateBranchemail;
use App\Models\Corporate\CorporateDepartment;
use App\Models\Corporate\CorporateTripRejection;
use App\Models\CorporateBranch;
use App\Models\CorporateDestination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BranchemailController extends Controller
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

        $branch = DB::table('corporate_branch_email')->where('corporate_branch_email.corporate_id',Auth::guard('corporate')->user()->corporate_id)->orderBy('id', 'DESC')
            ->select("corporate_branch_email.*","corporate_branch.name as branch_name")
        ->join('corporate_branch', 'corporate_branch.id', '=', 'corporate_branch_email.branch_id')
        ->get();
        return view('corporate.branchmail',compact('branch'));
    }
    public function branchemail(Request $request)
    {
        $branchname = CorporateBranch::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->orderBy('id', 'DESC')->get();

        return view('corporate.branchmail_add',compact('branchname'));
    }
    public function add(Request $request)
    {
        $result = $request->all();
        $result["corporate_id"] = Auth::guard('corporate')->user()->corporate_id;
        CorporateBranchemail::create($result);
        return array("status"=>true);
    }
    public function edit($id)
    {
        $branchname = CorporateBranch::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->orderBy('id', 'DESC')->get();
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $branchmail = CorporateBranchemail::where('corporate_id',$corporate_id)->where('id',$id)->first();
        return view('corporate.branchmail_add',compact('branchmail','branchname'));
    }
    public function update(Request $request)
    {
        $result = $request->all();
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $department = CorporateBranchemail::where('corporate_id',$corporate_id)->where('id',$result["id"])->first();
        $department->branch_id = $result["branch_id"];
        $department->email_id = $result["email_id"];
        $department->is_active = $result["is_active"];
        $department->save();
        return array("status"=>true);
    }

}
