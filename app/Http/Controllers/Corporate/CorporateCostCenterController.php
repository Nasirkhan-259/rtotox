<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Models\Corporate\CorporateDepartment;
use App\Models\CorporateCostCenter;
use App\Models\CorporateDestination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CorporateCostCenterController extends Controller
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

        $costcenter = CorporateCostCenter::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->orderBy('id', 'DESC')->get();
        return view('corporate.costcenter',compact('costcenter'));
    }
    public function department(Request $request)
    {
        return view('corporate.add_costcenter');
    }
    public function add_department(Request $request)
    {
        $result = $request->all();
        $result["corporate_id"] = Auth::guard('corporate')->user()->corporate_id;
        CorporateCostCenter::create($result);
        return array("status"=>true);
    }
    public function edit_department($id)
    {
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $costcenter = CorporateCostCenter::where('corporate_id',$corporate_id)->where('id',$id)->first();
        return view('corporate.add_costcenter',compact('costcenter'));
    }
    public function update(Request $request)
    {
        $result = $request->all();
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $department = CorporateCostCenter::where('corporate_id',$corporate_id)->where('id',$result["id"])->first();
        $department->name = $result["name"];
        $department->desciption = $result["desciption"];
        $department->is_active = $result["is_active"];
        $department->save();
        return array("status"=>true);
    }

    /**
     * For Select2 autocomplete
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $result = CorporateCostCenter::where("name", "LIKE", "%".$request->q."%")
            ->where("corporate_id", Auth::guard('corporate')->user()->corporate_id)
            ->get();

        return response()->json($result);
    }
}
