<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Models\Corporate\CorporateDepartment;
use App\Models\Corporate\CorporateTripRejection;
use App\Models\CorporateDestination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TriprejectionController extends Controller
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

        $triprej = CorporateTripRejection::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->orderBy('id', 'DESC')->get();
        return view('corporate.triprejection',compact('triprej'));
    }
    public function triprejection(Request $request)
    {
        return view('corporate.triprejection_add');
    }
    public function add(Request $request)
    {
        $result = $request->all();
        $result["corporate_id"] = Auth::guard('corporate')->user()->corporate_id;
        CorporateTripRejection::create($result);
        return array("status"=>true);
    }
    public function edit($id)
    {
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $triprejection = CorporateTripRejection::where('corporate_id',$corporate_id)->where('id',$id)->first();
        return view('corporate.triprejection_add',compact('triprejection'));
    }
    public function update(Request $request)
    {
        $result = $request->all();
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $department = CorporateTripRejection::where('corporate_id',$corporate_id)->where('id',$result["id"])->first();
        $department->tripreject = $result["tripreject"];
        $department->description = $result["description"];
        $department->is_active = $result["is_active"];
        $department->save();
        return array("status"=>true);
    }

}
