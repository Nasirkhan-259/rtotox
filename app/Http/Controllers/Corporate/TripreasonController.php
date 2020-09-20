<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Models\Corporate\CorporateDepartment;
use App\Models\Corporate\CorporateTripReason;
use App\Models\Corporate\CorporateTripRejection;
use App\Models\CorporateDestination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripreasonController extends Controller
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

        $triprea = CorporateTripReason::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->orderBy('id', 'DESC')->get();
        return view('corporate.tripreason',compact('triprea'));
    }
    public function tripreason(Request $request)
    {
        return view('corporate.tripreason_add');
    }
    public function add(Request $request)
    {
        $result = $request->all();
        $result["corporate_id"] = Auth::guard('corporate')->user()->corporate_id;
        CorporateTripReason::create($result);
        return array("status"=>true);
    }
    public function edit($id)
    {
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $tripreason = CorporateTripReason::where('corporate_id',$corporate_id)->where('id',$id)->first();
        return view('corporate.tripreason_add',compact('tripreason'));
    }
    public function update(Request $request)
    {
        $result = $request->all();
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $department = CorporateTripReason::where('corporate_id',$corporate_id)->where('id',$result["id"])->first();
        $department->tripreason = $result["tripreason"];
        $department->description = $result["description"];
        $department->is_active = $result["is_active"];
        $department->save();
        return array("status"=>true);
    }

}
