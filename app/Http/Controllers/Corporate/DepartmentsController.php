<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Models\Corporate\CorporateDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentsController extends Controller
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
        
        $departments = CorporateDepartment::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->orderBy('id', 'DESC')->get();
        return view('corporate.depratment',compact('departments'));
    }
    public function department(Request $request)
    {
        return view('corporate.add_depratment');
    }
    public function add_department(Request $request)
    {
        $result = $request->all();
        $result["corporate_id"] = Auth::guard('corporate')->user()->corporate_id;
        CorporateDepartment::create($result);
        return array("status"=>true);
    }
    public function edit_department($id)
    {
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $department = CorporateDepartment::where('corporate_id',$corporate_id)->where('id',$id)->first();
        return view('corporate.add_depratment',compact('department'));
    }
    public function update(Request $request)
    {
        $result = $request->all();
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $department = CorporateDepartment::where('corporate_id',$corporate_id)->where('id',$result["id"])->first();
        $department->name = $result["name"];
        $department->desciption = $result["desciption"];
        $department->is_active = $result["is_active"];
        $department->save();
        return array("status"=>true);
    }

}
