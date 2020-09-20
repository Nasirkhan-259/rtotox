<?php

namespace App\Http\Controllers;

use App\BindCities;
use App\Models\Airport;
use App\Models\Airline;
use App\Models\City;
use App\Models\Country;

use App\Models\Flight\SearchRsp;
use App\Services\Amadeus\Flight\ApiClient;
use App\Services\Amadeus\Flight\Rsp\FlightDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Exception;

class HomeController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        session(['currency' => 'USD']);
    }

    public function index()
    {
        $countries = Country::all();
        return view('home',compact('countries'));
    }
    public function BindCities(Request $request){

        return view('test');

    }

    public function parseDateTime($dateString, $timeString)
    {
        $date = sprintf("%s-%s-%s", substr($dateString, 0, 2), substr($dateString, 2, 2), substr($dateString, 4, 2));
        $time = sprintf("%s:%s:%s", substr($timeString, 0, 2), substr($timeString, 2, 2), "00");

        return $date.' '.$time;
    }

    public function search(Request $request)
    {
        // Load airports data into session.
        $params = $request->all();
        return view('flight.listing', compact('params'));
    }

    public function searchFlight(Request $request)
    {
        $AirPorts = Airport::all();
        $Carriers = Airline::all();

        $OriginAirport = $this->getAirPortDetail($AirPorts, $request->from);
        $DestinationAirport = $this->getAirPortDetail($AirPorts, $request->to);
        $FlightClient = new ApiClient();
        $Response     = $FlightClient->FlightSearch($request->all());
        $SearchRsp = new SearchRsp();
        $SearchRsp->AirPorts = $AirPorts;
        $SearchRsp->Carriers = $Carriers;
        if ($Response->status != "FATAL" && $Response->status != "ERR") {
            $Response = $SearchRsp->parse($Response, $request->traveltype, $request);
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
                "CabinClass" => $request->class
            ),
            "response" => $Response
        ));
    }


    public function flightDetails(Request $request)
    {
        $flight = json_decode(urldecode(base64_decode($request->token)));
        $FlightDetail = new FlightDetail($flight);

        return view('flight.checkout', compact("FlightDetail"));
    }

    public function bookingForm()
    {
        $FlightDetail = session('FlightDetail');
        $Request = session('Request');

        return view('flight.booking_form', compact('FlightDetail', 'Request'));
    }

    public function airSellFromRecommendation()
    {
        $FlightDetail = session('FlightDetail');
        $Origin = session('Origin');
        $Destination = session('Destination');
        $Segments = array();
        $nrOfPassengers = 1;

        $BookingClass = $FlightDetail->Flight->AirPricePointList->AirPricingInfo[0]->FareDetails[0]->BookingClass;
        $BookingInfos = $FlightDetail->Flight->Flight->outbound->BookingInfo;
        $this->setSegments($Segments, $BookingInfos, $BookingClass, $nrOfPassengers);

        if (count($FlightDetail->Flight->Flight->inbound) > 0)
        {
            $BookingClass = $FlightDetail->Flight->AirPricePointList->AirPricingInfo[0]->FareDetails[0]->BookingClass;
            $BookingInfos = $FlightDetail->Flight->Flight->inbound->BookingInfo;
            $this->setSegments($Segments, $BookingInfos, $BookingClass, $nrOfPassengers);
        }

        $ApiClient = new ApiClient();
        $Response  = $ApiClient->AirSellFromRecommendation(array(
            "from" => $Origin,
            "to" => $Destination,
            "segments" => $Segments
        ));

        $Segments = session(array('Segments' => $Segments));

        return response()->json($Response);
    }

    public function pnrAddMultiElements()
    {
        $Segments = session('Segments');
        $Origin = session('Origin');
        $Destination = session('Destination');

        if (empty($Segments)) {
            return redirect('/');
        }

        $ApiClient = new ApiClient();
        $Response  = $ApiClient->PnrAddMultiElements($Origin, $Destination, $Segments);

        $NextRequestEndpoint = "createFormOfPayment";
        return view('flight.unknown', compact('Response', 'NextRequestEndpoint'));
    }

    public function createFormOfPayment()
    {
        $ApiClient = new ApiClient();
        $Response  = $ApiClient->CreateFormOfPayment();

        $NextRequestEndpoint = "farePricePNRWithBookingClass";
        return view('flight.unknown', compact('Response', 'NextRequestEndpoint'));
    }

    public function farePricePNRWithBookingClass()
    {
        $FlightDetail = session('FlightDetail');
        $FareBasis = $FlightDetail->Flight->AirPricePointList->AirPricingInfo[0]->FareDetails[0]->GroupOfFares[0]->FareBasis;
        $PlatingCarrier = $FlightDetail->Flight->AirPricePointList->AirPricingInfo[0]->PlatingCarrier;

        $ApiClient = new ApiClient();
        $Response  = $ApiClient->FarePricePnrWithBookingClass($FareBasis, $PlatingCarrier);
        session(array('PricedPNR' => $Response));
        $CurrentPrice = $Response->response->fareList->fareDataInformation->fareDataSupInformation[2]->fareAmount;
        $LatestPrice = $Response->response->fareList->fareDataInformation->fareDataSupInformation[2]->fareAmount;

        echo "<div>Current Price: " . $CurrentPrice . "<br/>";
        echo "Latest Price: " . $LatestPrice . "<br/></div>";

        $NextRequestEndpoint = "modifyPNRAddTicketMod";
        return view('flight.unknown', compact('Response', 'NextRequestEndpoint'));
    }

    public function modifyPNRAddTicketMod()
    {
        $PricedPNR = session('PricedPNR');
        $LastTicketDateTime = $PricedPNR->response->fareList->lastTktDate->dateTime;

        if (strlen($LastTicketDateTime->month) == 1) {
            $LastTicketDateTime->month = "0".$LastTicketDateTime->month;
        } if (strlen($LastTicketDateTime->day) == 1) {
            $LastTicketDateTime->day = "0".$LastTicketDateTime->day;
        }

        $LastTicketDateTime = sprintf("%s-%s-%s %s:%s", $LastTicketDateTime->year, $LastTicketDateTime->month, $LastTicketDateTime->day, "00", "00");

        $ApiClient = new ApiClient();
        $Response  = $ApiClient->ModifyPNRAddTicketMod($LastTicketDateTime);

        $NextRequestEndpoint = "ticketCreateTSTFromPricing";
        return view('flight.unknown', compact('Response', 'NextRequestEndpoint'));
    }

    public function ticketCreateTSTFromPricing()
    {
        $ApiClient = new ApiClient();
        $Response  = $ApiClient->TicketCreateTSTFromPricing();

        $NextRequestEndpoint = "pnrAddMultiElementsSave";
        return view('flight.unknown', compact('Response', 'NextRequestEndpoint'));
    }

    public function pnrAddMultiElementsSave()
    {
        $ApiClient = new ApiClient();
        $Response  = $ApiClient->PnrAddMultiElementsSave();

        $locatorCode = 0;
        if ($Response->status == 'OK') {
            $locatorCode = $Response->response->pnrHeader->reservationInfo->reservation->controlNumber;
        }

        $NextRequestEndpoint = "pnrRetrieveReq?locatorCode=".$locatorCode;
        return view('flight.unknown', compact('Response', 'NextRequestEndpoint'));
    }

    public function pnrRetrieveReq(Request $request)
    {
        $ApiClient = new ApiClient();
        $Response  = $ApiClient->PnrRetrieveReq($request->locatorCode);

        $NextRequestEndpoint = "issueTicket";
        return view('flight.unknown', compact('Response', 'NextRequestEndpoint'));
    }

    public function docIssuanceIssueTicket()
    {
        $ApiClient = new ApiClient();
        $Response  = $ApiClient->DocIssuanceIssueTicket();

        $NextRequestEndpoint = "endSession";
        return view('flight.unknown', compact('Response', 'NextRequestEndpoint'));
    }

    public function endSession()
    {
        $ApiClient = new ApiClient();
        $Response  = $ApiClient->SecuritySignOut();

        return response()->json($Response);
    }

    public function getPnrReq(Request $request)
    {
        $ApiClient = new ApiClient();
        $Response  = $ApiClient->GetPnrReq($request->locatorCode);

        $NextRequestEndpoint = "";
        return view('flight.unknown', compact('Response', 'NextRequestEndpoint'));
    }

    public function fareGetFareFamilyDescription()
    {
        $ApiClient = new ApiClient();
        $Response  = $ApiClient->FareGetFareFamilyDescription();

        $NextRequestEndpoint = "";
        return view('flight.unknown', compact('Response', 'NextRequestEndpoint'));
    }

    public function farePriceUpsellWithoutPNR()
    {
        $ApiClient = new ApiClient();
        $Response  = $ApiClient->FarePriceUpsellWithoutPNR();

        $NextRequestEndpoint = "";
        return view('flight.unknown', compact('Response', 'NextRequestEndpoint'));
    }

    public function setSegments(&$Segments, $BookingInfos, $BookingClass, $nrOfPassengers)
    {
        foreach ($BookingInfos as $BookingInfo) {
            array_push($Segments, array(
                'departureDate' => date('Ymd', strtotime($BookingInfo->Segment->DepartureTime)),
                'from' => $BookingInfo->Segment->Origin,
                'to' => $BookingInfo->Segment->Destination,
                'companyCode' => $BookingInfo->Segment->Carrier,
                'flightNumber' => $BookingInfo->Segment->FlightNumber,
                'bookingClass' => $BookingClass,
                'nrOfPassengers' => $nrOfPassengers
            ));
        }
    }

    public function getAirPortDetail($AirPorts, $AirPortCode)
    {
        foreach ($AirPorts as $AirPort) {
            if ($AirPort->code == $AirPortCode) {
                return $AirPort;
            }
        }
    }

    public function AirMultiAvailability()
    {
        try {
            $FlightClient = new \App\Services\Amadeus\Flight\ApiClient();
            $Response = $FlightClient->MultiAvailability();
            return response()->json($Response);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function AirFlightInfo()
    {
        try {
            $FlightClient = new \App\Services\Amadeus\Flight\ApiClient();
            $Response = $FlightClient->FlightInfo();
            return response()->json($Response);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
