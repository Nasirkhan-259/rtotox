<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Models\Corporate\CorporateDepartment;
use App\Models\Corporate\CorporateFlightRule;
use App\Models\Corporate\CorporateFlightsRuleDetail;
use App\Models\Corporate\CorporateFlightsRuleSegment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FlightruleController extends Controller
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
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $results = CorporateFlightRule::where("corporate_id",$corporate_id)->get();
        return view('corporate.flightrules',compact('results'));
    }
    public function add(Request $request)
    {
        $flight_rule_details = [(object)array("flightrules"=>array(array()))];
        return view('corporate.flightrules_add',compact('flight_rule_details'));
    }
    public function add_flightrule(Request $request)
    {
        $result = $request->all();
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;

        if(!empty($result["id"]))
        {
            $corporate_rule  =  CorporateFlightRule::where("id",$result["id"])->first();
            $flight_rule_details = CorporateFlightsRuleDetail::where('corporate_id',$corporate_id)->where('rule_id',$result["id"])->get();
            foreach ($flight_rule_details as $detail)
            {
                $segment = CorporateFlightsRuleSegment::where('id',$detail->id)->first();
                $detail->delete();
                $segment->delete();
            }

        }else{
            $corporate_rule  = new  CorporateFlightRule();
        }
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $corporate_rule->corporate_id = $corporate_id;
        $corporate_rule->name = $result["rule_name"];
        if(!empty($result["is_active"]))
        {
            $corporate_rule->is_active = 1;
        }else{
            $corporate_rule->is_active = 0;
        }
        $corporate_rule->save();
        unset($result["rule_name"]);
        unset($result["is_active"]);
        unset($result["_token"]);
        unset($result["id"]);

        foreach ($result as $i=>$item)
        {
            $coporate_details = new CorporateFlightsRuleDetail();
            $coporate_details->corporate_id = $corporate_id;
            $coporate_details->origin = $item["origin"];
            $coporate_details->destination = $item["destination"];
            $coporate_details->rule_id = $corporate_rule->id;
            $coporate_details->save();
            $class_array = $item;
            unset($class_array["origin"]);
            unset($class_array["destination"]);
            unset($class_array["airlines"]);
            $class_array = array_values($class_array);
            foreach ($item["airlines"] as $ar_index=>$airline)
            {
                $corporate_airline = new CorporateFlightsRuleSegment();
                $corporate_airline->corporate_id = $corporate_id;
                $corporate_airline->airline_id = $airline;
                $corporate_airline->detail_id = $coporate_details->id;
                $corporate_airline->class_of_service = json_encode($class_array[$ar_index]);
                $corporate_airline->save();
            }
        }

        return array("status"=>true);
    }
    public function edit($id)
    {
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $flight_rule = CorporateFlightRule::where('corporate_id',$corporate_id)->where('id',$id)->first();
        $flight_rule_details = CorporateFlightsRuleDetail::where('corporate_id',$corporate_id)->where('rule_id',$flight_rule->id)->get();
        foreach ($flight_rule_details as &$detail)
        {
            $detail->flightrules = DB::table('coporate_flightrules_segments')
                ->join('airports', 'airports.id', '=', 'coporate_flightrules_segments.airline_id')
                ->select('airports.name','coporate_flightrules_segments.*')->where("detail_id",$detail->id)->get();
        }
        return view('corporate.flightrules_add',compact('flight_rule','flight_rule_details'));
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
