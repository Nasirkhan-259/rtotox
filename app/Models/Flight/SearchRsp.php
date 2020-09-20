<?php

namespace App\Models\Flight;


use App\Services\Amadeus\Flight\Helper\CabinClass;

class SearchRsp
{
    public $responseData = array();
    public $recommendation = array();
    public $serviceFeesGrp = array();
    public $AirPorts = array();
    public $Carriers = array();

    public function parse($response, $TripType, $request)
    {
        $flightIndex = $response->response->flightIndex;
        $recommendations = $response->response->recommendation;
        $this->serviceFeesGrp = $response->response->serviceFeesGrp;
        $currency = $response->response->conversionRate->conversionRateDetail->currency;
        $totalFlights = 0;
        $Carriers = array();
        $data = array();
        $CarrierNameTracking = array();

        if (is_object($recommendations)) {
            $recommendations = array($recommendations);
        }

        foreach ($recommendations as $recommendation)
        {
            $segmentFlightRefs = $recommendation->segmentFlightRef;
            if (is_object($segmentFlightRefs)) {
                $segmentFlightRefs = array($segmentFlightRefs);
            }

            // Flight Options based on same price
            $Options = array();

            foreach ($segmentFlightRefs as $segmentFlightRef)
            {
                // Segments
                $Segments = array(
                    "outbound" => array(),
                    "inbound" => array(),
                    "FareInfo" => array()
                );

                if ($TripType == "oneway")
                {
                    if (is_object($segmentFlightRef->referencingDetail)) {
                        $segmentFlightRef->referencingDetail = array($segmentFlightRef->referencingDetail);
                    }

                    foreach ($segmentFlightRef->referencingDetail as $referencingDetailIndex => $referencingDetail)
                    {
                        if ($referencingDetailIndex == 0) { // Outbound
                            $Outbound = $this->getSegment($flightIndex, $referencingDetail->refNumber);
                            $OutboundFirstSegment = current($Outbound["BookingInfo"]);
                            $Segments["outbound"] = array(
                                "Carrier" => array(
                                    "Code" => $OutboundFirstSegment["Segment"]["Carrier"],
                                    "Name" => $this->getCarrierName($OutboundFirstSegment["Segment"]["Carrier"])
                                ),
                                "FlightLabelInfo" => $Outbound["FlightLabelInfo"],
                                "BookingInfo" => $Outbound["BookingInfo"]
                            );
                        } else if ($referencingDetailIndex == 1) { // Baggage Info
                            $FareInfo = $this->getFareInfo($referencingDetail->refNumber);
                            $Segments["outbound"]["FareInfo"] = current($FareInfo);
                        }
                    }

                    array_push($Options, $Segments);

                } else { // Round/Return Trip

                    foreach ($segmentFlightRef->referencingDetail as $referencingDetailIndex => $referencingDetail)
                    {
                        if ($referencingDetailIndex == 0) { // Outbound
                            $Outbound = $this->getSegment($flightIndex[0], $referencingDetail->refNumber);
                            $OutboundFirstSegment = current($Outbound["BookingInfo"]);
                            $Segments["outbound"] = array(
                                "Carrier" => array(
                                    "Code" => $OutboundFirstSegment["Segment"]["Carrier"],
                                    "Name" => $this->getCarrierName($OutboundFirstSegment["Segment"]["Carrier"])
                                ),
                                "FlightLabelInfo" => $Outbound["FlightLabelInfo"],
                                "BookingInfo" => $Outbound["BookingInfo"]
                            );
                        } else if ($referencingDetailIndex == 1) { // Inbound
                            $Inbound = $this->getSegment($flightIndex[1], $referencingDetail->refNumber);
                            $InboundFirstSegment = current($Inbound["BookingInfo"]);
                            $Segments["inbound"] = array(
                                "Carrier" => array(
                                    "Code" => $InboundFirstSegment["Segment"]["Carrier"],
                                    "Name" => $this->getCarrierName($InboundFirstSegment["Segment"]["Carrier"])
                                ),
                                "FlightLabelInfo" => $Inbound["FlightLabelInfo"],
                                "BookingInfo" => $Inbound["BookingInfo"]
                            );
                        } else if ($referencingDetailIndex == 2) { // Baggage Info
                            $FareInfo = $this->getFareInfo($referencingDetail->refNumber);
                            $Segments["outbound"]["FareInfo"] = $FareInfo[0];
                            $Segments["inbound"]["FareInfo"] = $FareInfo[1];
                        }
                    }

                    array_push($Options, $Segments);

                }
            }

            // AirPricingInfo
            $AirPricingInfo = array();
            if (is_object($recommendation->paxFareProduct)) {
                $recommendation->paxFareProduct = array($recommendation->paxFareProduct);
            }
            foreach ($recommendation->paxFareProduct as $paxFareProduct)
            {
                $pricingTicketing = array();
                $codeShareDetails = array();

                if (isset($paxFareProduct->paxFareDetail->pricingTicketing)) {
                    $pricingTicketing = $paxFareProduct->paxFareDetail->pricingTicketing;
                }
                if (isset($paxFareProduct->paxFareDetail->codeShareDetails)) {
                    $codeShareDetails = $paxFareProduct->paxFareDetail->codeShareDetails;
                    if (is_array($codeShareDetails)) {
                        $codeShareDetails = current($codeShareDetails);
                    }
                }

                // Pricing messages
                $PricingMessages = array();

                if (is_object($paxFareProduct->fare)) {
                    $paxFareProduct->fare = array($paxFareProduct->fare);
                }
                
                foreach ($paxFareProduct->fare as $fare) {
                    $Code = "";
                    /**
                     * During private fare search informationType were missing for corporate name block
                     */
                    if (isset($fare->pricingMessage->freeTextQualification->informationType)) {
                        $Code = $fare->pricingMessage->freeTextQualification->informationType;
                    }
                    $description = $fare->pricingMessage->description;
                    $description = (is_array($description)) ? implode("\n", $description) : $description;
                    array_push($PricingMessages, array(
                        "Type" => $fare->pricingMessage->freeTextQualification->textSubjectQualifier,
                        "Code" => $Code,
                        "Description" => $description
                    ));
                }

                // Fare Details
                $FareDetails = array();

                if (is_object($paxFareProduct->fareDetails)) {
                    $paxFareProduct->fareDetails = array($paxFareProduct->fareDetails);
                }
                
                foreach ($paxFareProduct->fareDetails as $fareDetail) {

                    $GroupOfFares = array();

                    if (is_object($fareDetail->groupOfFares)) {
                        $fareDetail->groupOfFares = array($fareDetail->groupOfFares);
                    }

                    foreach ($fareDetail->groupOfFares as $groupOfFare) {
                        array_push($GroupOfFares, array(
                            "BookingCode" => $groupOfFare->productInformation->cabinProduct->rbd, // Reservation booking designator
                            "CabinCode" => $groupOfFare->productInformation->cabinProduct->cabin, // Indicates the cabin related to the Booking code.
                            "AvailibilityStatus" => $groupOfFare->productInformation->cabinProduct->avlStatus, // Availibility status 
                            "FareBasis" => $groupOfFare->productInformation->fareProductDetail->fareBasis,
                            "PassengerTypeCode" => $groupOfFare->productInformation->fareProductDetail->passengerType,
                            "FareType" => $groupOfFare->productInformation->fareProductDetail->fareType,
                            "BreakPoint" => $groupOfFare->productInformation->breakPoint,
                            "TicketInfo" => (isset($groupOfFare->ticketInfos)) ? $groupOfFare->ticketInfos : ""
                        ));
                    }

                    array_push($FareDetails, array(
                        "AirLegRef" => $fareDetail->segmentRef->segRef,
                        "BookingClass" => $GroupOfFares[0]['BookingCode'],
                        "ClassOfService" => $GroupOfFares[0]['BookingCode'],
                        "CabinClass" => CabinClass::GetDefinition($GroupOfFares[0]['CabinCode']),
                        "GroupOfFares" => $GroupOfFares
                    ));
                }

                array_push($AirPricingInfo, array(
                    "TotalPrice" => $paxFareProduct->paxFareDetail->totalFareAmount,
                    "Taxes" => $paxFareProduct->paxFareDetail->totalTaxAmount,
                    "PlatingCarrier" => $codeShareDetails->company,
                    "pricingTicketing" => $pricingTicketing,
                    "PassengerType" => array(
                        "Code" => $paxFareProduct->paxReference->ptc
                    ),
                    "PricingMessages" => $PricingMessages,
                    "FareDetails" => $FareDetails
                ));

                $totalFlights += count($Options);
            }

            $Flight = array();
            if (count($Options) == 1) {
                $Flight = current($Options);
//                $Options = array();
            } else if(count($Options) >= 2) {
                $Flight = current($Options);
//                array_shift($Options);
            }

            // Flight Option array first index contain outbound flights, second index contain inbound flights.
            $FlightOption = array();
            $FlightOption[0]["AirLegKey"] = 1;
            $FlightOption[0]["AirLegType"] = "Outbound";
            $FlightOption[0]["Origin"] = $request->from;
            $FlightOption[0]["Destination"] = $request->to;
            $FlightOption[1]["AirLegKey"] = 2;
            $FlightOption[1]["AirLegType"] = "Inbound";
            $FlightOption[1]["Origin"] = $request->to;;
            $FlightOption[1]["Destination"] = $request->from;
            foreach ($Options as $Option) {
                $FlightOption[0]["Option"][] = $Option['outbound'];
                $FlightOption[1]["Option"][] = $Option['inbound'];
            }

            if ($TripType == "oneway") {
                unset($FlightOption[1]);
            }

            $CarrierCode = $Flight["outbound"]["Carrier"]["Code"];
            $Carrier = $this->getCarrier($CarrierCode);
            $CarrierName = (isset($Carrier->name)) ? $Carrier->name : $CarrierCode;
            if (!in_array($CarrierCode, $CarrierNameTracking)) {
                array_push($CarrierNameTracking, $CarrierCode);
                array_push($Carriers, array(
//                "CarrierFlyDirection" => "Outbound",
                    "CarrierName" => $CarrierName,
                    "CarrierCode" => $CarrierCode,
//                "TotalPrice" => $recommendation->recPriceInfo->monetaryDetail[0]->amount,
//                "TotalTax" => $recommendation->recPriceInfo->monetaryDetail[1]->amount
                ));
            }

            array_push($data, array(
                "RecommendationKey" => $recommendation->itemNumber->itemNumberId->number,
                "Currency" => $currency,
                "TotalPrice" => $recommendation->recPriceInfo->monetaryDetail[0]->amount,
                "Taxes" => $recommendation->recPriceInfo->monetaryDetail[1]->amount,
                // "paxFareProduct" => $recommendation->paxFareProduct,
//                "Flight" => $Flight,
                "AirPricePointList" => array(
                    "AirPricingInfo" => $AirPricingInfo
                ),
                "FlightOptionsList" => array(
                    "FlightOption" => $FlightOption
                )
            ));
        }

        return response()->json([
            'status' => 'success',
            'totalFlights' => $totalFlights,
            'carriers' => $Carriers,
            'currency' => $currency,
            'data' => $data
        ]);
    }

    public function getFareInfo($refNumber)
    {
        $FareInfo = array();
        $serviceCoverageInfoGrp = array();
        $serviceCoverageInfoGrp["FreeBaggageAllowance"] = array();
        $serviceCoverageInfoGrp["RequestedSegmentRef"] = "";
        $serviceCoverageInfoGrp["serviceFeesType"] = $this->serviceFeesGrp->serviceTypeInfo->carrierFeeDetails->type;

        if (is_object($this->serviceFeesGrp->serviceCoverageInfoGrp)) {
            $this->serviceFeesGrp->serviceCoverageInfoGrp = array($this->serviceFeesGrp->serviceCoverageInfoGrp);
        }

        foreach ($this->serviceFeesGrp->serviceCoverageInfoGrp as $_serviceCoverageInfoGrp)
        {
            if ($_serviceCoverageInfoGrp->itemNumberInfo->itemNumber->number == $refNumber)
            {
                $serviceCoverageInfoGrp["Key"] = $_serviceCoverageInfoGrp->itemNumberInfo->itemNumber->number;
                // If this is an object then the fare info will be same for Outbound and Inbound for the same traveler type
                // If it is an array then the fare info will be change for Outbound and Inbound for the same traveler type
                if (is_object($_serviceCoverageInfoGrp->serviceCovInfoGrp))
                {
                    // Making structure identical.
                    $serviceCovInfoGrp = [];
                    // Make the object compatible for loop.
                    if (is_object($_serviceCoverageInfoGrp->serviceCovInfoGrp->coveragePerFlightsInfo)) {
                        $_serviceCoverageInfoGrp->serviceCovInfoGrp->coveragePerFlightsInfo = array($_serviceCoverageInfoGrp->serviceCovInfoGrp->coveragePerFlightsInfo);
                    }

                    foreach ($_serviceCoverageInfoGrp->serviceCovInfoGrp->coveragePerFlightsInfo as $coveragePerFlightsInfo)
                    {
                        array_push($serviceCovInfoGrp, (object) array(
                            "paxRefInfo" => $_serviceCoverageInfoGrp->serviceCovInfoGrp->paxRefInfo,
                            "coveragePerFlightsInfo" => $coveragePerFlightsInfo,
                            "refInfo" => $_serviceCoverageInfoGrp->serviceCovInfoGrp->refInfo,
                        ));
                    }
                    $_serviceCoverageInfoGrp->serviceCovInfoGrp = $serviceCovInfoGrp;
                }

                // Now start processing
                foreach ($_serviceCoverageInfoGrp->serviceCovInfoGrp as $serviceCovInfoGrp)
                {
                    $serviceCoverageInfoGrp["RequestedSegmentRef"] = [];
                    $serviceCoverageInfoGrp["PassengerRef"] = $serviceCovInfoGrp->paxRefInfo->travellerDetails->referenceNumber;
                    if (is_object($serviceCovInfoGrp->coveragePerFlightsInfo)) {
                        $serviceCovInfoGrp->coveragePerFlightsInfo = array($serviceCovInfoGrp->coveragePerFlightsInfo);
                    }
                    foreach ($serviceCovInfoGrp->coveragePerFlightsInfo as $coveragePerFlightsInfo) {
                        if ($coveragePerFlightsInfo->numberOfItemsDetails->referenceQualifier == "RS") {
                            array_push($serviceCoverageInfoGrp["RequestedSegmentRef"], $coveragePerFlightsInfo->numberOfItemsDetails->refNum);
                        } else {
                            array_push($serviceCoverageInfoGrp["RequestedSegmentRef"], $coveragePerFlightsInfo->numberOfItemsDetails->referenceQualifier);
                        }

                        if (is_object($coveragePerFlightsInfo->lastItemsDetails)) {
                            $coveragePerFlightsInfo->lastItemsDetails = array($coveragePerFlightsInfo->lastItemsDetails);
                        }

                        $serviceCoverageInfoGrp["RefOfLeg"] = $coveragePerFlightsInfo->lastItemsDetails;
                    }

                    // Free baggage allowance
                    if ($serviceCovInfoGrp->refInfo->referencingDetail->refQualifier == "F")
                    {
                        $FareRef = $serviceCovInfoGrp->refInfo->referencingDetail->refNumber;
                        if (is_object($this->serviceFeesGrp->freeBagAllowanceGrp)) {
                            $this->serviceFeesGrp->freeBagAllowanceGrp = array($this->serviceFeesGrp->freeBagAllowanceGrp);
                        }
                        foreach ($this->serviceFeesGrp->freeBagAllowanceGrp as $_freeBagAllowanceGrp)
                        {
                            if ($_freeBagAllowanceGrp->itemNumberInfo->itemNumberDetails->number == $FareRef)
                            {
                                $serviceCoverageInfoGrp["FreeBaggageAllowance"] = $_freeBagAllowanceGrp->freeBagAllownceInfo->baggageDetails;
                            }
                        }
                    }
                    array_push($FareInfo, $serviceCoverageInfoGrp);
                }

                break; // Object found so do no need to loop forward.
            }
        }

        return $FareInfo;
    }

    public function getDuration($DepartureDateTime, $ArrivalDateTime)
    {
        $to_time = strtotime($ArrivalDateTime);
        $from_time = strtotime($DepartureDateTime);
        return round(abs($to_time - $from_time) / 60, 2);
    }

    public function getCarrierName($CarrierCode)
    {
        $Carrier = $this->getCarrier($CarrierCode);
        return (!empty($Carrier)) ? $Carrier->name : $CarrierCode;
    }

    public function getCarrier($CarrierCode)
    {
        foreach ($this->Carriers as $Carrier) {
            $_CarrierCode = rtrim($Carrier->thumbnail, ".png");
            if ($_CarrierCode == $CarrierCode) {
                return $Carrier;
            }
        }
    }

    public function getAirPortDetail($AirPortCode)
    {
        foreach ($this->AirPorts as $AirPort) {
            if ($AirPort->code == $AirPortCode) {
                return $AirPort;
            }
        }
    }

    public function getSegment($FlightIndex, $SegmentKey)
    {
        $BookingInfo = array();

        $flight = $this->getFlight($FlightIndex, $SegmentKey);

        if (is_object($flight->flightDetails))
        {
            $flight->flightDetails = array($flight->flightDetails);
        }

        foreach ($flight->flightDetails as $flightDetail)
        {
            $NumberOfStops = 0;
            $FlightDetails = array();

            if (property_exists($flightDetail->flightInformation->productDetail, "techStopNumber"))
            {
                $NumberOfStops = $flightDetail->flightInformation->productDetail->techStopNumber;
            }

            $Origin = $flightDetail->flightInformation->location[0]->locationId;
            $Destination = $flightDetail->flightInformation->location[1]->locationId;
            $DepartureTime = $this->getDepartureTime($flightDetail);
            $ArrivalTime = $this->getArrivalTime($flightDetail);
            $_Destination = "";
            $_ArrivalTime = "";

            if ($NumberOfStops > 0)
            {
                if (is_object($flightDetail->technicalStop)) {
                    $flightDetail->technicalStop = array($flightDetail->technicalStop);
                }

                foreach ($flightDetail->technicalStop as $index => $technicalStop)
                {
                    if (is_object($technicalStop->stopDetails)) {
                        $technicalStop->stopDetails = array($technicalStop->stopDetails);
                    }
                    foreach ($technicalStop->stopDetails as $stopDetail)
                    {
                        if ($stopDetail->dateQualifier == "AA") {
                            if ($index == 0) {
                                $_Origin = $Origin;
                                $_DepartureTime = $DepartureTime;
                            }
                            $_Destination = $stopDetail->locationId;
                            $_ArrivalTime = $this->parseDateTime($stopDetail->date, $stopDetail->firstTime);
                            if (! isset($flightDetail->technicalStop[$index+1]) && $index != 0) {
                                $_Origin = $stopDetail->locationId;
                                $_Destination = $Destination;
                                $_DepartureTime = $this->parseDateTime($technicalStop->stopDetails[1]->date, $technicalStop->stopDetails[1]->firstTime);
                                $_ArrivalTime = $ArrivalTime;
                            }
                        } elseif ($stopDetail->dateQualifier == "AD") {
                            $_Origin = $_Destination;
                            $_DepartureTime = $this->parseDateTime($stopDetail->date, $stopDetail->firstTime);
                            $_ArrivalTime = $ArrivalTime;
                            if (isset($flightDetail->technicalStop[$index+1])) {
                                $nextStopDetail = $flightDetail->technicalStop[$index+1]->stopDetails[0];
                                $_Destination = $nextStopDetail->locationId;
                                $_ArrivalTime = $this->parseDateTime($nextStopDetail->date, $nextStopDetail->firstTime);
                            } else {
                                $_ArrivalTime = $ArrivalTime;
                                $_Destination = $Destination;
                            }
                        }
                        
                        array_push($FlightDetails, array(
                            "Origin" => $_Origin,
                            "Destination" => $_Destination,
                            "DepartureTime" => $_DepartureTime,
                            "ArrivalTime" => $_ArrivalTime
                        ));
                    }
                }
            }

            $OriginDetail = $this->getAirPortDetail($Origin);
            $DestinationDetail = $this->getAirPortDetail($Destination);

            $productDetailQualifier = "";
            if (isset($flightDetail->flightInformation->addProductDetail->productDetailQualifier)) {
                $productDetailQualifier = $flightDetail->flightInformation->addProductDetail->productDetailQualifier;
            }

            array_push($BookingInfo, array(
                "Segment" => array(
                    "Carrier" => $flightDetail->flightInformation->companyId->operatingCarrier,
                    "CarrierName" => $this->getCarrierName($flightDetail->flightInformation->companyId->operatingCarrier),
                    "FlightNumber" => $flightDetail->flightInformation->flightOrtrainNumber,
                    "Equipment" => $flightDetail->flightInformation->productDetail->equipmentType,
                    "NumberOfTechnicalStops" => $NumberOfStops,
                    "ETicketability" => $flightDetail->flightInformation->addProductDetail->electronicTicketing,
                    "PolledAvailabilityOption" => $productDetailQualifier,
                    "Origin" => $Origin,
                    "OriginDetail" => array(
                        "Name" => $OriginDetail->name,
                        "City" => $OriginDetail->cityName,
                        "Country" => $DestinationDetail->countryName
                    ),
                    "Destination" => $Destination,
                    "DestinationDetail" => array(
                        "Name" => $DestinationDetail->name,
                        "City" => $DestinationDetail->cityName,
                        "Country" => $DestinationDetail->countryName
                    ),
                    "DepartureTime" => $this->dateTimeFullYear($DepartureTime),
                    "ArrivalTime" => $this->dateTimeFullYear($ArrivalTime),
                    "FlightDetails" => $FlightDetails
                )
            ));
        }

        $FlightLabelInfo = array();
        if (count($BookingInfo) == 1) {
            $Segment = current($BookingInfo)["Segment"];
            $DepartureDate = date("D M d, Y", strtotime($Segment["DepartureTime"]));
            $DepartureTime = date("H:i", strtotime($Segment["DepartureTime"]));
            $ArrivalDate = date("D M d, Y", strtotime($Segment["ArrivalTime"]));
            $ArrivalTime = date("H:i", strtotime($Segment["ArrivalTime"]));
            $Duration = $this->hoursandmins($flight->propFlightGrDetail->flightProposal[1]->ref);

            $OriginDetail = $this->getAirPortDetail($Segment["Origin"]);
            $DestinationDetail = $this->getAirPortDetail($Segment["Destination"]);

            $FlightLabelInfo = array(
                "DepartureDate" => $DepartureDate,
                "DepartureTime" => $DepartureTime,
                "Route" => $Segment["Origin"]." → ".$Segment["Destination"],
                "Origin" => array(
                    "Code" => $Segment["Origin"],
                    "AirportName" => $OriginDetail->name,
                    "CityName" => $OriginDetail->cityName
                ),
                "Destination" => array(
                    "Code" => $Segment["Destination"],
                    "AirportName" => $DestinationDetail->name,
                    "CityName" => $DestinationDetail->cityName
                ),
                "ArrivalDate" => $ArrivalDate,
                "ArrivalTime" => $ArrivalTime,
                "Duration" => $Duration,
                "TotalStop" => 0
            );

        } else {
            $TotalStops = count($BookingInfo) - 1;
            $FirstSegment = current($BookingInfo)["Segment"];
            $LastSegment = end($BookingInfo)["Segment"];
            $DepartureDate = date("D M d, Y", strtotime($FirstSegment["DepartureTime"]));
            $DepartureTime = date("H:i", strtotime($FirstSegment["DepartureTime"]));
            $ArrivalDate = date("D M d, Y", strtotime($LastSegment["ArrivalTime"]));
            $ArrivalTime = date("H:i", strtotime($LastSegment["ArrivalTime"]));
            $Duration = $this->hoursandmins($flight->propFlightGrDetail->flightProposal[1]->ref);
            $Route = "";
            foreach ($BookingInfo as $_BookingInfo) {
                $Route .= $_BookingInfo["Segment"]["Origin"] . " → ";
            }

            $OriginDetail = $this->getAirPortDetail($FirstSegment["Origin"]);
            $DestinationDetail = $this->getAirPortDetail($LastSegment["Destination"]);

            $FlightLabelInfo = array(
                "DepartureDate" => $DepartureDate,
                "DepartureTime" => $DepartureTime,
                "Route" => $Route.$LastSegment["Destination"],
                "Origin" => array(
                    "Code" => $FirstSegment["Origin"],
                    "AirportName" => $OriginDetail->name,
                    "CityName" => $OriginDetail->cityName
                ),
                "Destination" => array(
                    "Code" => $LastSegment["Destination"],
                    "AirportName" => $DestinationDetail->name,
                    "CityName" => $DestinationDetail->cityName
                ),
                "ArrivalDate" => $ArrivalDate,
                "ArrivalTime" => $ArrivalTime,
                "Duration" => $Duration,
                "TotalStop" => $TotalStops
            );
        }

        return array(
            "FlightLabelInfo" => $FlightLabelInfo,
            "BookingInfo" => $BookingInfo,
        );
    }

    public function dateTimeFullYear($dateTimeString)
    {
        return substr_replace($dateTimeString, "20".substr($dateTimeString, 6, 2), 6, 2);
    }

    public function hoursandmins($time, $format = '%02d:%02d')
    {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }

    public function getFlight($FlightIndex, $SegmentKey)
    {
        if (is_object($FlightIndex->groupOfFlights)) {
            $FlightIndex->groupOfFlights = array($FlightIndex->groupOfFlights);
        }

        foreach ($FlightIndex->groupOfFlights as $flight)
        {
            if ($flight->propFlightGrDetail->flightProposal[0]->ref == $SegmentKey) {
                return $flight;
            }
        }
    }

    public function getDepartureTime($flightDetail)
    {
        $dateString = $flightDetail->flightInformation->productDateTime->dateOfDeparture;
        $timeString = $flightDetail->flightInformation->productDateTime->timeOfDeparture;

        $date = sprintf("%s-%s-%s", substr($dateString, 0, 2), substr($dateString, 2, 2), substr($dateString, 4, 2));
        $time = sprintf("%s:%s", substr($timeString, 0, 2), substr($timeString, 2, 2), "00");

        return $date.' '.$time;
    }

    public function getArrivalTime($flightDetail)
    {
        $dateString = $flightDetail->flightInformation->productDateTime->dateOfArrival;
        $timeString = $flightDetail->flightInformation->productDateTime->timeOfArrival;

        $date = sprintf("%s-%s-%s", substr($dateString, 0, 2), substr($dateString, 2, 2), substr($dateString, 4, 2));
        $time = sprintf("%s:%s", substr($timeString, 0, 2), substr($timeString, 2, 2), "00");

        return $date.' '.$time;
    }

    public function parseDateTime($dateString, $timeString)
    {
        $date = sprintf("%s-%s-%s", substr($dateString, 0, 2), substr($dateString, 2, 2), substr($dateString, 4, 2));
        $time = sprintf("%s:%s", substr($timeString, 0, 2), substr($timeString, 2, 2), "00");

        return $date.' '.$time;
    }
}
