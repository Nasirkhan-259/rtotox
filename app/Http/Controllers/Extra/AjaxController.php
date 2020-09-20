<?php

namespace App\Http\Controllers\Extra;

use App\Models\Airline;
use App\Models\Airport;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function airports(Request $request)
    {
        $airportByCode = Airport::where(DB::raw('LOWER(code)'), 'LIKE', '%'. strtolower($request->q) . '%')->get();
        $airportByName = Airport::where(DB::raw('LOWER(name)'), 'LIKE', '%'. strtolower($request->q) . '%')
            ->orWhere(DB::raw('LOWER(cityName)'), 'LIKE', '%'. strtolower($request->q) . '%')
            ->get();

        header("Access-Control-Allow-Origin: *");
        return $airportByCode->merge($airportByName);
    }

    public function airlines(Request $request)
    {
        $airlinesByCode = Airline::where(DB::raw('LOWER(three_digitcode)'), 'LIKE', '%'. strtolower($request->q) . '%')->get();
        $airlinesByName = Airline::where(DB::raw('LOWER(name)'), 'LIKE', '%'. strtolower($request->q) . '%')->get();

        return $airlinesByCode->merge($airlinesByName);
    }

    public function locations(Request $request)
    {
        $cities = City::select("name","id","COUNTRY")->where(DB::raw('LOWER(name)'), 'like',"%".strtolower($request->q)."%")->get();

        return $cities;
    }
}
