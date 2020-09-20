<?php

namespace App\Http\Controllers\Corporate;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Extra\Helpers;
use App\Mail\MailClass;
use App\Mail\MailItinerary;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\City;
use App\Models\Corporate\CorporateApproverGroup;
use App\Models\Corporate\CorporateApproverWorkflowGroup;
use App\Models\Corporate\CorporateDepartment;
use App\Models\Corporate\CorporateEmployee;
use App\Models\Corporate\CorporateEmployeeFamily;
use App\Models\Corporate\CorporateFamily;
use App\Models\Corporate\CorporateMaster;
use App\Models\Corporate\CorporatePolicy;
use App\Models\Corporate\CorporateTripMaster;
use App\Models\Corporate\CorporateTripPax;
use App\Models\Corporate\CorporateTripReason;
use App\Models\Corporate\CorporateTripService;
use App\Models\Corporate\TripApproverSequence;
use App\Models\Corporate\CorporateWorkFlow;
use App\Models\CorporateBranch;
use App\Models\CorporateCostCenter;
use App\Models\CorporateDestination;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Flight\SearchRsp;
use App\Services\Amadeus\Flight\ApiClient;
use App\Services\TBO\TboLibrary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CorporateController extends Controller
{
    /**
     * CorporateController constructor.
     */
    public function __construct()
    {
        //
    }

    public function index($name)
    {
        $corporate = CorporateMaster::where(DB::RAW('LOWER(alais)'), strtolower($name))->first();
        if(empty($corporate))
        {
            echo "Corporate not found";
        } else {
            return view('corporate.login',compact('corporate'));
        }
    }

    public function forget_password($name)
    {
        $corporate = CorporateMaster::where(DB::RAW('LOWER(alais)'), strtolower($name))->first();
        if(empty($corporate))
        {
            echo "Corporate not found";
        } else {
            return view('corporate.forget_password',compact('corporate'));
        }
    }
    public function test()
    {
//        $ariports = Airport::where('country_id',0)->get();
//        foreach ($ariports as &$airport){
//            $country = Country::where('iso2',$airport->countryCode)->first();
//            if(empty($country)){
//                dd($airport);
//            }
//            $airport->country_id = $country->id;
//            $airport->save();
//        }
        $loggedUser = Auth::guard('corporate')->user();
//
//          $result = Helpers::GetFlightMarkup($loggedUser->id,1000,200,300,1,1,0,"oneway","LHE","DXB","1");
        $result = Helpers::GetFlightServiceFee($loggedUser->id,'LHE','DXB',400,'1');
        return $result;

    }
    public function login(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required'],
        ]);
        if ($v->fails()) {
            $login_erros = $v->errors()->first();
        }else{
            $corporate = CorporateEmployee::where('email',$request->email)->first();
            if(empty($corporate))
            {
                $login_erros = "Email not found";
            }else{
                if(password_verify($request->password,$corporate->password))
                {
                    if(!$corporate->isActive)
                    {
                        $login_erros = "Your account is disabled.";
                    }
                }else{
                    $login_erros = "Incorrect password.";
                }
            }
        }
        if(empty($login_erros))
        {
            Auth::guard("corporate")->attempt(['email'=>$request->email,'password'=>$request->password]);
            $corporate = CorporateMaster::where('name',$request->corporate_name)->first();
            session(['corporate' => $corporate]);
            return redirect('corporate/dashboard');
        }else{
            return redirect('corporate/nts')->with('errors', $login_erros);
        }
    }

    public function reset_password(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email']
        ]);
        if ($v->fails()) {
            $login_erros = $v->errors()->first();
        }else{
            $corporate = CorporateEmployee::where('email',$request->email)->first();
            if(empty($corporate))
            {
                $login_erros = "Email not found";
            }else{

                $objEmail = new \stdClass();
                $objEmail->subject = "Password Reset";
                $objEmail->Corporate = $corporate;
                $objEmail->alais = $request->corporate_name;
                $objEmail->view = "email.corporate.forgetpassword";
                Mail::to($request->email)->send(new MailClass($objEmail));

            }
        }
        if(empty($login_erros))
        {
            return redirect("corporate/$request->corporate_name/forget/password")->with('success', true);

        }else{
            return redirect("corporate/$request->corporate_name/forget/password")->with('errors', $login_erros);
        }
    }

    public function SetCurrency($currency = "USD")
    {
        session(['currency' => $currency]);
        return redirect()->back();
    }

    public function dashboard(Request $request)
    {
        $loggedUser = Auth::guard('corporate')->user();
        $corporate = CorporateMaster::find($loggedUser->corporate_id);
        $tripId = sprintf("%s%s", strtoupper($corporate->alais), CorporateTripMaster::count() + 1);
        $trips = CorporateTripMaster::where("tripcreatedby", $loggedUser->id)->get();
        $costCenters = CorporateCostCenter::where("corporate_id", $loggedUser->corporate_id)->get();

        $employees = DB::table('corporate_employees')
            ->select(
                "corporate_employees.id",
                "corporate_employees.travelpolicy",
                "corporate_employees.firstname",
                "corporate_employees.lastname",
                "corporate_employees.email",
                "corporate_employees.flexcostcentre",
                "corporate_employees.costcentreid",
                "corporate_cost_center.name as cost_center_name"
            )
            ->where("corporate_employees.corporate_id", $loggedUser->corporate_id)
            ->join('corporate_cost_center', 'corporate_employees.costcentreid', '=', 'corporate_cost_center.id')
            ->get();

        // Re-validate the page if use click on browser back button on listing page. So the tripId updated for sure.
        return response()
            ->view('corporate.dashboard', compact("tripId", "trips", "employees", "costCenters"))
            ->withHeaders(array(
                "Cache-Control" => "no-cache, no-store, must-revalidate",
                "Pragma" => "no-cache",
                "Expires" => "0",
            ));
    }

    public function logout(Request $request)
    {
        $corporate = session('corporate');
        $name = $corporate->getAttribute("alais");

        Auth::guard('corporate')->logout();
        session()->forget('corporate');

        return redirect(url('/corporate/'.$name));
    }

    /**
     * Save trip before searching
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveTrip(Request $request)
    {
        $user = Auth::guard('corporate')->user();

        $trip = new CorporateTripMaster();
        $trip->corporateid = $user->corporate_id;
        $trip->tripcreatedby = $user->id;
        $trip->costcentreid = $request->costCenter;
        $trip->tripno = $request->tripId;
        $trip->tripname = $request->tripName;
        $trip->triptype = $request->flightType;
        $trip->trip_pax_employeeid = $request->employeeId;
        $response = $trip->save();

        $status = ($response) ? "success" : "fail";

        $search_payload = array(
            "traveltype" => $request->tripType,
            "from" => $request->origin,
            "to" => $request->destination,
            "departure_date" => $request->departureDate,
            "return_date" => $request->returnDate,
            "adult" => $request->adults,
            "child" => $request->children,
            "infant" => $request->infants,
            "class" => $request->cabinClass,
            "existingTripId" => $trip->id
        );

        return response()->json(array(
            "status" => $status,
            "message" => "trip saved",
            "searchQuery" => http_build_query($search_payload)
        ));
    }
    public function saveTripHotel(Request $request)
    {
        $user = Auth::guard('corporate')->user();


        $trip = new CorporateTripMaster();
        $trip->corporateid = $user->corporate_id;
        $trip->tripcreatedby = $user->id;
        $trip->costcentreid = $request->cost_Center;
        $trip->tripno = $request->tripId;
        $trip->tripname = $request->tripName;
        $trip->triptype = $request->hotelType;
        $trip->trip_pax_employeeid = $request->employeeId;
        $response = $trip->save();
        $status = ($response) ? "success" : "fail";
        $search_payload = array(
            "city_id" => $request->destination,
            "checkin" => $request->Checkin,
            "checkout" => $request->Checkout,
            "adults" => $request->Passenger["Adults"],
            "children" => $request->Passenger["Children"],
            "rooms" => $request->NumberRooms,
            "existingTripId" => $trip->id
        );

        return response()->json(array(
            "status" => $status,
            "message" => "trip saved",
            "searchQuery" => http_build_query($search_payload)
        ));
    }

    public function flightSearch(Request $request)
    {
        $queryString = $request->all();
        $params = json_encode($queryString);

        return view("corporate.flight_listing", compact("params"));
    }
    public function hotelSearch(Request $request)
    {
        $params = $request->all();
        if(empty(session('currency'))){
            $params["currency"] = "USD";
        }else{
            $params["currency"] = session('currency');
        }
        $city = City::where("id",$params["city_id"])->first();
        $params["tbo_code"] = $city->tbo_code;
        $params["city_name"] = $city->name;
        return view('corporate.listing', compact('params'));
    }
    public function searchHotel(Request $request)
    {

        $parms = $request->all();

//        $CorpTripService = new CorporateTripService();
//        $CorpTripService->corporate_trip_master_id = $request->existingTripId;
//        $CorpTripService->service_type = "hotel";
//        $CorpTripService->office_id = "DAR4528AT";
//        $CorpTripService->total_adults = $request->adults;
//        $CorpTripService->total_children = $request->children;
//        $CorpTripService->currency_code = "USD";
//        $CorpTripService->save();

        $tbo = new  TboLibrary();
        $Trip = CorporateTripMaster::find($request->existingTripId);
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $corporate = CorporateMaster::where('id',$corporate_id)->first();
        $corporate =  $corporate->GetHotelMarkup(3);

        if(empty(session('currency'))){
            $currency = "USD";
        }else{
            $currency = session('currency');
        }
        $currency_data = Currency::where('code',$currency)->first();
        $corporate->hotel_markup_perroom_pernight = $corporate->hotel_markup_perroom_pernight * $currency_data->rate;

        $response = $tbo->list($parms);

        $response["Trip"] = $Trip;
        $response["corporate"] = $corporate;

//        $response = file_get_contents(public_path('response.json'));

        return $response;
    }
    public function searchHotelDetails(Request $request)
    {
        $tbo = new  TboLibrary();
        $params = $request->all();
//        return $params;
        $response = $tbo->roomAvailibility($params["ResultIndex"],$params["SessionIndex"],$params["HotelId"]);
//        return file_get_contents(public_path('room_response.json'));
        return array(
            "status"=>true,
            "result"=>$response);
    }
    public function searchFlight(Request $request)
    {
        $Trip = CorporateTripMaster::find($request->existingTripId);
        if (empty($Trip)) {
            return response()->json(array(
                "response" => array(
                    "status" => "ERR",
                    "messages" => array(
                        array(
                            "code" => "404",
                            "text" => "Trip # {$request->existingTripId} is not available in local storage."
                        )
                    )
                )
            ));
        }

        $User = Auth::guard('corporate')->user();
        $fareBreakdownFlag = $User->Corporate->farebreakdown;

        $AirPorts = Airport::all();
        $Carriers = Airline::all();
        $FlightClient = new ApiClient();

        $OriginAirport = $FlightClient->getAirPortDetail($AirPorts, $request->from);
        $DestinationAirport = $FlightClient->getAirPortDetail($AirPorts, $request->to);

        $Response  = $FlightClient->FlightSearch($request->all());
        $SearchRsp = new SearchRsp();
        $SearchRsp->AirPorts = $AirPorts;
        $SearchRsp->Carriers = $Carriers;

        $ResponseReturn = [];
        $FamilyInformation = [];

        if ($Response->status != "FATAL" && $Response->status != "ERR") {
            $ResponseReturn = $SearchRsp->parse($Response, $request->traveltype, $request);
        }

        if (isset($Response->response->familyInformation)) {
            $FamilyInformation = $Response->response->familyInformation;
        }

        return response()->json(array(
            "request" => array(
                "Origin" => array(
                    "Code" => $request->from,
                    "Name" => $OriginAirport->cityName
                ),
                "Destination" => array(
                    "Code" => $request->to,
                    "Name" => $DestinationAirport->cityName
                ),
                "Departure" => array(
                    "date" => $request->departure_date,
                    "dateString" => date("D, d M", strtotime($request->departure_date))
                ),
                "Arrival" => array(
                    "date" => $request->return_date,
                    "dateString" => date("D, d M", strtotime($request->return_date))
                ),
                "Travler" => array(
                    "Adults" => $request->adult,
                    "Children" => $request->child,
                    "Infants" => $request->infant,
                    "Total" => ($request->adult + $request->child + $request->infant)
                ),
                "CabinClass" => $request->class,
                "TripType" => $request->traveltype
            ),
            "familyInformation" => $FamilyInformation,
            "policies" => [
                "fareBreakdownFlag" => $fareBreakdownFlag
            ],
            "trip" => $Trip,
            "response" => $ResponseReturn
        ));
    }

    public function loadFareRules(Request $request)
    {
        $FlightClient = new ApiClient();
        $response = $FlightClient->FareGetFareRules([
            "TicketingDate" => date("Y-m-d"),
            "FareBasis" => $request->FareBasis,
//            "TicketDesignator" => "DISC",
            "Carrier" => $request->Carrier,
            "Origin" => $request->Origin,
            "Destination" => $request->Destination
        ]);

        $FareRuleDescriptionText = [];
        $FlightDetails = [];
        if ($response->status == "OK")
        {
            $FlightDetails = $response->response->flightDetails;
            foreach ($response->response->tariffInfo as $tariffInfo)
            {
                $FareRule = new \stdClass();
                $FareRule->Title = "";
                $FareRule->Description = [];
                foreach ($tariffInfo->fareRuleText as $Index => $fareRuleText)
                {
                    if ($Index == 0) {
                        $FareRule->Title = $fareRuleText->freeText;
                    } else {
                        array_push($FareRule->Description, $fareRuleText->freeText);
                    }
                }
                $FareRule->Description = implode("<br/>", $FareRule->Description);
                array_push($FareRuleDescriptionText, $FareRule);
            }
        }

        return response()->json(array(
            "status" => "success",
            "data" => array(
                "Carrier" => $request->Carrier,
                "FareRuleDescriptionText" => $FareRuleDescriptionText,
                "FlightDetails" => $FlightDetails
            )
        ));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function mailItinerariesToUser(Request $request)
    {
        $user = json_decode(json_encode($request->MailTo));
        $itineraries = json_decode(json_encode($request->Itineraries));
        $flightSearchRequest = json_decode(json_encode($request->flightSearchRequest));

        $mailResponse = Mail::to($user->email)->send(new MailItinerary($user, $itineraries, $flightSearchRequest));

        return response()->json(array(
            "status" => "success",
            "message" => $mailResponse
        ));
    }
    public function HotelmailItinerariesToUser(Request $request)
    {
        if(empty(session('currency'))){
            $currency = "USD";
        }else{
            $currency = session('currency');
        }
        $MailTo = json_decode(json_encode($request->MailTo));
        $params = json_decode(json_encode($request->params));
        $EmailItnery = $request->Itineraries;
        $objEmail = new \stdClass();
        $objEmail->subject = "Email Itinerary";
        $objEmail->name = $MailTo->name;
        $objEmail->username = $MailTo->email;
        $objEmail->params = $params;
        $objEmail->EmailItnery = $EmailItnery;
        $objEmail->currency = $currency;
        $date_from =  \DateTime::createFromFormat("Y-m-d",$params->checkin);
        $date_to = \DateTime::createFromFormat("Y-m-d",$params->checkout);
        $objEmail->stay = $date_from->diff($date_to)->days;

        $objEmail->view = "email.corporate_hotel_mail";
        Mail::to($MailTo->email)->send(new MailClass($objEmail));

        return response()->json(array(
            "status" => "success",
            "message" => ''
        ));
    }

    /**
     * Save itinerary in db cart.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveItinerariesInCart(Request $request)
    {
        $CorpTripService = new CorporateTripService();
        $CorpTripService->corporate_trip_master_id = $request->TripId;
        $CorpTripService->service_type = "flight";
        $CorpTripService->office_id = "DAR4528AT";
        $CorpTripService->total_adults = $request->FlightSearchRequest["Travler"]["Adults"];
        $CorpTripService->total_children = $request->FlightSearchRequest["Travler"]["Children"];
        $CorpTripService->total_infants = $request->FlightSearchRequest["Travler"]["Infants"];
        $CorpTripService->cabin_class = $request->FlightSearchRequest["CabinClass"];

        $Itinerary = $request->Itinerary;
        $Itinerary["FlightOptionsList"]["FlightOption"][0]["Option"] = array($Itinerary["FlightOptionsList"]["FlightOption"][0]["Option"][$request->FlightOptionIndex]);
        if ($request->FlightSearchRequest["TripType"] == "round")
        {
            $Itinerary["FlightOptionsList"]["FlightOption"][1]["Option"] = array($Itinerary["FlightOptionsList"]["FlightOption"][1]["Option"][$request->FlightOptionIndex]);
        }

        $CorpTripService->booking_segments = json_encode($Itinerary);
        $CorpTripService->currency_code = $request["Itinerary"]["Currency"];
        $CorpTripService->total_base_fare = $request["Itinerary"]["TotalPrice"];
        $CorpTripService->total_taxes = $request["Itinerary"]["Taxes"];
        $CorpTripService->save();

        $Itinerary["CorporateTripServiceId"] = $CorpTripService->id;
        $Itinerary["total_adults"] = $CorpTripService->total_adults;
        $Itinerary["total_children"] = $CorpTripService->total_children;
        $Itinerary["total_infants"] = $CorpTripService->total_infants;
        $Itinerary["cabin_class"] = $CorpTripService->cabin_class;

        return response()->json(array(
            "Status" => "success",
            "Message" => "[".$CorpTripService->id."] trip saved successfully into cart",
            "Itinerary" => $Itinerary
        ));
    }
    public function saveHotelitineraries_in_cart(Request $request)
    {
        if(empty(session('currency'))){
            $currency = "USD";
        }else{
            $currency = session('currency');
        }
        $params = json_decode(json_encode($request->params));
        $rooms = json_decode(json_encode($request->rooms));
        $hotels = json_decode(json_encode($request->hotels));
        $CorpTripService = new CorporateTripService();
        $CorpTripService->corporate_trip_master_id = $request->TripId;
        $CorpTripService->service_type = "hotel";
        $CorpTripService->office_id = "DAR4528AT";
        $CorpTripService->total_adults = $params->adults;
        $CorpTripService->total_children = $params->children;
        $CorpTripService->total_rooms   = $params->rooms;
        $CorpTripService->checkin  = $params->checkin;
        $CorpTripService->currency_code  = $currency;
        $CorpTripService->checkout  = $params->checkout;

        $CorpTripService->total_base_fare = $rooms->price;
        $CorpTripService->hotel_room_type = $rooms->room_name;
        $CorpTripService->hotel_name  = $hotels->company_name;
        $CorpTripService->hotel_address   = $hotels->address;
        $CorpTripService->hotel_ratings    = $hotels->rating;
        $CorpTripService->room_id    = $rooms->room_type_code;
        $CorpTripService->save();

        $Itinerary["CorporateTripServiceId"] = $CorpTripService->id;
        $Itinerary["total_adults"] = $CorpTripService->total_adults;
        $Itinerary["service_type"] = "hotel";
        $Itinerary["total_children"] = $CorpTripService->total_children;
        $Itinerary["hotel_ratings"] = $CorpTripService->hotel_ratings;
        $Itinerary["hotel_room_type"] = $CorpTripService->hotel_room_type;
        $Itinerary["checkout"] = $CorpTripService->checkout;
        $Itinerary["checkin"] = $CorpTripService->checkin;
        $Itinerary["total_rooms"] = $CorpTripService->total_rooms;
        $Itinerary["total_base_fare"] = $CorpTripService->total_base_fare;
        $Itinerary["hotel_address"] = $CorpTripService->hotel_address;
        $Itinerary["total_infants"] = $CorpTripService->total_infants;
        $Itinerary["hotel_ratings"] = $CorpTripService->hotel_ratings;
        $Itinerary["hotel_name"] = $CorpTripService->hotel_name;
        $Itinerary["room_id"] = $CorpTripService->room_id;
        $Itinerary["cabin_class"] = $CorpTripService->cabin_class;

        return response()->json(array(
            "Status" => "success",
            "Message" => "[".$CorpTripService->id."] trip saved successfully into cart",
            "Itinerary" => $Itinerary
        ));
    }

    public function loadSavedItineraries(Request $request)
    {
        $CorpSavedItineraries = CorporateTripService::where("corporate_trip_master_id", $request->corporate_trip_master_id)->get();

        $Itineraries = array();
        $RecommendationKeys = array();
        $ItinerariesTotal = 0;
        foreach ($CorpSavedItineraries as $Itinerary) {
            $ItinerariesTotal += $Itinerary->total_base_fare; // Tax included by Amadeus
            $CorporateTripServiceId = $Itinerary->id;
            if($Itinerary->service_type == "flight"){
                $_Itinerary = json_decode($Itinerary->booking_segments);
                $_Itinerary->CorporateTripServiceId = $CorporateTripServiceId;
                $_Itinerary->total_adults = $Itinerary->total_adults;
                $_Itinerary->total_children = $Itinerary->total_children;
                $_Itinerary->total_infants = $Itinerary->total_infants;
                $_Itinerary->cabin_class = $Itinerary->cabin_class;
                $_Itinerary->service_type = $Itinerary->service_type;
                array_push($Itineraries, $_Itinerary);
                array_push($RecommendationKeys, $_Itinerary->RecommendationKey);
            }else{
                array_push($Itineraries, $Itinerary);
                array_push($RecommendationKeys, $Itinerary->room_id);
            }

        }

        return response()->json(array(
            "Status" => "success",
            "RecommendationKeys" => $RecommendationKeys,
            "ItinerariesTotal" => $ItinerariesTotal,
            "Itineraries" => $Itineraries
        ));
    }

    public function deleteItineraryFromCart(Request $request)
    {
        $CorporateTripServiceId = $request->CorporateTripServiceId;
        $responseSignal = CorporateTripService::destroy($CorporateTripServiceId);

        return response()->json(array(
            "Status" => "success",
            "Message" => "[".$responseSignal."] trip deleted successfully from cart"
        ));
    }
    public function profile(Request $request)
    {

        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $employee = DB::table('corporate_employees')
            ->select("corporate_employees.*","airports.cityName")
            ->where("corporate_employees.corporate_id", Auth::guard('corporate')->user()->corporate_id)
            ->where("corporate_employees.id", Auth::guard('corporate')->user()->id)
            ->join('airports', 'corporate_employees.point_of_hire', '=', 'airports.code')
            ->first();
        $family = CorporateFamily::where('employee_id',Auth::guard('corporate')->user()->id)->get();
        $departements = CorporateDepartment::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        $costcenter = CorporateCostCenter::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        $destination = CorporateDestination::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        $employees_doctor = CorporateEmployee::where("employee_type","Doctor")->where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        $employees_doctor = CorporateEmployee::where("employee_type","Doctor")->where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        if($employees_doctor->isEmpty())
        {
            $employees_doctor = CorporateEmployee::where("is_admin","1")->where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        }
        $branch = CorporateBranch::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        $levels = CorporatePolicy::where("corporate_id",Auth::guard('corporate')->user()->corporate_id)->orderBy('id', 'DESC')->get();
        $workflows = CorporateWorkFlow::where("corporate_id",Auth::guard('corporate')->user()->corporate_id)->orderBy('id', 'DESC')->get();
        $country = Country::all();
        $now = date('Y');
        return view('corporate.profile',compact('employee','destination','costcenter','departements','branch','now','country','family','levels','workflows','employees_doctor'));
    }

    public function update(Request $request)
    {
        $result = $request->all();
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $corporate= CorporateEmployee::where('corporate_id',$corporate_id)->where('id',$result['employee']['id'])->first();

        $family= CorporateFamily::where('employee_id',$result['employee']['id'])->delete();



        $corporate->password_hash = $result['employee']['password'];
        $corporate->password = bcrypt($corporate->password_hash );


        $corporate->corporate_id =  Auth::guard('corporate')->user()->corporate_id;;


        $corporate->national_idno = $result['employee']['national_idno'];
        $corporate->phonenumber = $result['employee']['phonecode']."".$result['employee']['phonenumber'];
        $corporate->mobile_corporate = $result['employee']['mobilecode']."".$result['employee']['mobilenumber'];
        $corporate->mobile_personal = $result['employee']['personalphonecode']."".$result['employee']['personalphonenumber'];
        $corporate->emergency_contact = $result['employee']['emergency_contact'];
        $corporate->emergencycontactno = $result['employee']['emergency_contact_code']."".$result['employee']['emergency_contact_number'];
        $corporate->personaladdress = $result['employee']['personaladdress'];
        $corporate->passportno = $result['employee']['passportno'];
        $corporate->passport_dateofissue = $result['employee']['issueday']."-".$result['employee']['issuemonth']."-".$result['employee']['issueyear'];
        $corporate->passport_dateofexpiry = $result['employee']['expday']."-".$result['employee']['expmonth']."-".$result['employee']['expyears'];
        $corporate->countryissue = $result['employee']['countryissue'];
        $corporate->nationality = $result['employee']['nationality'];
        $corporate->prefferred_mealplan = $result['employee']['prefferred_mealplan'];
        $corporate->save();

        //Family Data Save
        if(!empty($result['family']))
        {
            foreach ($result['family']['type'] as $index=>$item)
            {
                $family = new CorporateFamily();
                $family->employee_id =  $corporate->id;
                $family->type = $result['family']['type'][$index];
                $family->salutation = $result['family']['solution'][$index];
//            $family->is_active = $result['family']['available'][$index];
                $family->first_name = $result['family']['name'][$index];
                $family->middle_name = $result['family']['middlename'][$index];
                $family->last_name = $result['family']['lastname'][$index];
                $family->dob = $result['family']['date'][$index]."-".$result['family']['month'][$index]."-".$result['family']['year'][$index];
                $family->relationship = $result['family']['real'][$index];
                $family->passportno = $result['family']['passpoet'][$index];
                $family->nationality = $result['family']['nationality'][$index];
                $family->country_id = $result['family']['country'][$index];
                $family->prefferred_mealplan = $result['family']['plan'][$index];
                $family->national_idno = $result['family']['nationalityid'][$index];
                $family->save();
            }

        }
        return array("status"=>true);
    }


    public function proceedForApproval($CorporateTripMasterId)
    {
        $CorporateEmployee = Auth::guard('corporate')->user();
        $CorporateTripMaster = CorporateTripMaster::find($CorporateTripMasterId);
        if (empty($CorporateTripMaster)) {
            return redirect("corporate/dashboard");
        }
        $CoporateTripReasonList = CorporateTripReason::where("corporate_id", $CorporateEmployee->corporate_id)->get();

        // Find workflow
        $TripPaxEmployeeId = $CorporateTripMaster->trip_pax_employeeid;
        $EmployeeWhoIsTravelling = CorporateEmployee::find($TripPaxEmployeeId);
        $ApproverWorkFlows = CorporateApproverWorkflowGroup::where("workflow_id", $EmployeeWhoIsTravelling->workflow_id)
            ->orderBy("sequence_number")
            ->get();

        $ApproverWorkFlowList = array();
        foreach ($ApproverWorkFlows as $ApproverWorkFlow)
        {
            $EmployeesLevel = [];

            if ($ApproverWorkFlow->ApproverGroup->corporate_id == $CorporateEmployee->corporate_id &&
                $ApproverWorkFlow->ApproverGroup->all_approved == 1) {

                $EmployeesLevel = CorporateEmployee::where("corporate_id", $CorporateEmployee->corporate_id)
                    ->where("is_approver", 1)
                    ->whereNotIn("id", [$CorporateEmployee->id, $TripPaxEmployeeId])
                    ->get();

            } else {

                foreach ($ApproverWorkFlow->CorporateApproverGroupMember as $ApproverWorkFlowGroupMember) {
                    if (!in_array($ApproverWorkFlowGroupMember->Employee->id, [$CorporateEmployee->id, $TripPaxEmployeeId])) {
                        array_push($EmployeesLevel, $ApproverWorkFlowGroupMember->Employee);
                    }
                }
            }

            if (!empty($EmployeesLevel)) {
                array_push($ApproverWorkFlowList, array(
                    "Level" => $ApproverWorkFlow->sequence_number,
                    "Members" => $EmployeesLevel
                ));
            }
        }

        // Prepare family members list
        $FamilyMembersList = array(
            "Adults" => array(),
            "Children" => array(),
            "Infants" => array(),
        );

        if (!in_array(strtolower($CorporateTripMaster->triptype), ["business", "rotation"]))
        {
            $EmployeeFamilyMembers = CorporateEmployeeFamily::where("employee_id", $CorporateEmployee->id)->get();
            foreach ($EmployeeFamilyMembers as $EmployeeFamilyMember)
            {
                // Create custom structure because of Employee which is saved in a separate table and his family is in separate.
                $_EmployeeFamilyMember = array(
                    "id" => $EmployeeFamilyMember->id,
                    "first_name" => $EmployeeFamilyMember->first_name,
                    "last_name" => $EmployeeFamilyMember->last_name,
                    "salutation" => $EmployeeFamilyMember->salutation,
                    "country_id" => $EmployeeFamilyMember->country_id,
                    "passportno" => $EmployeeFamilyMember->passportno,
                    "passport_dateofexpiry" => $EmployeeFamilyMember->passport_dateofexpiry,
                    "dob" => $EmployeeFamilyMember->dob,
                    "prefferred_mealplan" => $EmployeeFamilyMember->prefferred_mealplan,
                    "relationship" => $EmployeeFamilyMember->relationship,
                    "type" => $EmployeeFamilyMember->type,
                );

                if ($EmployeeFamilyMember->type == "adult") {
                    array_push($FamilyMembersList["Adults"], $_EmployeeFamilyMember);

                } else if ($EmployeeFamilyMember->type == "child") {
                    array_push($FamilyMembersList["Children"], $_EmployeeFamilyMember);

                } else if ($EmployeeFamilyMember->type == "infant") {
                    array_push($FamilyMembersList["Infants"], $_EmployeeFamilyMember);
                }
            }
        }

        // Add employee in the dropdown on approvars page
        array_push($FamilyMembersList["Adults"], array(
            "id" => $EmployeeWhoIsTravelling->id,
            "first_name" => $EmployeeWhoIsTravelling->firstname,
            "last_name" => $EmployeeWhoIsTravelling->lastname,
            "salutation" => $EmployeeWhoIsTravelling->salutation,
            "country_id" => $EmployeeWhoIsTravelling->country_of_residence,
            "passportno" => $EmployeeWhoIsTravelling->passportno,
            "passport_dateofexpiry" => $EmployeeWhoIsTravelling->passport_dateofexpiry,
            "dob" => $EmployeeWhoIsTravelling->dob,
            "prefferred_mealplan" => $EmployeeWhoIsTravelling->prefferred_mealplan,
            "relationship" => "elder",
            "type" => "adult"
        ));

        $FamilyMembersList = json_encode($FamilyMembersList);
        $ApproverWorkFlowList = json_encode($ApproverWorkFlowList);

        return view("corporate.trips_for_approval", compact("CorporateTripMaster", "FamilyMembersList", "ApproverWorkFlowList", "CoporateTripReasonList"));
    }

    public function saveAndSendNotificationToApprovers(Request $request)
    {
        $Status = "success";
        $Message = [];

        /** Update data into CorporateTripMaster */
        $QueryResponse = CorporateTripMaster::where("id", $request->CorporateTripMasterId)
            ->update([
                "tripreason" => $request->TripReason,
                "comment" => $request->Comment
            ]);
        if ($QueryResponse)
        {
            array_push($Message, "Corporate trip master updated successfully");
        }

        /** Insert data into CorporateTripPaxes */
        $CheckDuplication = CorporateTripPax::where("corporate_trip_master_id", $request->CorporateTripMasterId)->count();
        if (empty($CheckDuplication))
        {
            $CorporateTripPaxList = [];
            foreach ($request->CorporateTripServiceIds as $CorporateTripServiceId)
            {
                foreach ($request->SelectedFamilyMembers as $Member)
                {
                    $Member = (object) $Member;
                    array_push($CorporateTripPaxList, array(
                        "corporate_trip_master_id" => $request->CorporateTripMasterId,
                        "corporate_trip_service_id" => $CorporateTripServiceId,
                        "corporate_pax_first_name" => $Member->first_name,
                        "corporate_pax_last_name" => $Member->last_name,
                        "corporate_pax_dob" => $Member->dob,
                        "relationship_to_employee" => $Member->relationship,
                        "passport_number" => $Member->passportno,
                        "passport_expiry" => $Member->passport_dateofexpiry,
                        "frequent_flyer_airline" => "",
                        "frequent_flyer_number" => "",
                        "created_at" => date("Y-m-d H:i:s"),
                        "updated_at" => date("Y-m-d H:i:s")
                    ));
                }
            }

            $QueryResponse = CorporateTripPax::insert($CorporateTripPaxList);
            if ($QueryResponse)
            {
                array_push($Message, "Corporate trip family members saved successfully");
            }

        } else {

            array_push($Message, "Corporate trip family members already saved, Ignored query");
        }

        /** Insert data into TripApproverSequence */
        $CheckDuplication = TripApproverSequence::where("corporate_trip_master_id", $request->CorporateTripMasterId)->count();
        if (empty($CheckDuplication))
        {
            $TripApproverSequenceDataPayload = [];
            foreach ($request->SelectedApprovers as $SequenceNumber => $SelectedApproversList)
            {
                foreach ($SelectedApproversList as $SelectedApprover)
                {
                    array_push($TripApproverSequenceDataPayload, array(
                        "corporate_trip_master_id" => $request->CorporateTripMasterId,
                        "sequence_number" => $SequenceNumber,
                        "corporate_employee_id" => $SelectedApprover["id"],
                        "is_approved" => 0,
                        "created_at" => date("Y-m-d H:i:s"),
                        "updated_at" => date("Y-m-d H:i:s")
                    ));
                }
            }

            $QueryResponse = TripApproverSequence::insert($TripApproverSequenceDataPayload);
            if ($QueryResponse)
            {
                array_push($Message, "Trip approver sequence saved successfully");
            }

        } else {

            array_push($Message, "Trip approver sequence already saved, Ignored query");
        }

        if ($Status == "success") {
            CorporateTripMaster::destroy($request->CorporateTripMasterId);
        }

        return response()->json(array(
            "Status" => $Status,
            "Message" => $Message
        ));
    }
}
