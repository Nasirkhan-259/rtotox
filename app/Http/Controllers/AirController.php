<?php

namespace App\Http\Controllers;

use App\Services\Amadeus\Flight\ApiClient;
use Illuminate\Http\Request;

class AirController extends Controller
{
    /**
     * Load fare summary
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Amadeus\Client\Exception
     * @throws \Amadeus\Client\InvalidMessageException
     * @throws \Amadeus\Client\RequestCreator\MessageVersionUnsupportedException
     */
    public function loadFareRules(Request $request)
    {
        $FlightClient = new ApiClient();
        $response = $FlightClient->FareGetFareRules([
            "TicketingDate" => date("Y-m-d"),
            "FareBasis" => $request->FareBasis,
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
}
