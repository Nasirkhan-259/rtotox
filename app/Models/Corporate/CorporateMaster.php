<?php

namespace App\Models\Corporate;

use App\Models\Airport;
use App\Models\ApiMaster;
use App\Models\City;
use Illuminate\Database\Eloquent\Model;

class CorporateMaster extends Model
{
    protected $table = "corporate_master";

    public function getAttribute($value)
    {
        return $this->attributes[$value];
    }
    public function GetApis(){
        $api_values = json_decode($this->api_ids);
        $apis = ApiMaster::whereIn('id', $api_values)->where("is_active",1)->get();
        foreach ($apis as &$api){
            $api->jsonDecode("credentials");
        }
        return $apis;
    }
    public function GetMarkUp($AdultPrice,$ChildrenPrice,$InfantsPrice,$Adults,$Children,$Infants,$TripType,$ApiId){
        $master_fee = CorproateServiceFeeMaster::where('id',$this->servicefeeid)->first();
        $Fee = $master_fee->getDetails($ApiId);

        $TotalFee = 0;

        if(!empty($Adults)){
            $AdultPrice = $AdultPrice/$Adults;
            $AdultPrice = $AdultPrice/100;
        }

        if(!empty($Children)){
            $ChildrenPrice = $ChildrenPrice/$Children;
            $ChildrenPrice = $ChildrenPrice/100;
        }

        if(!empty($Infants)){
            $InfantsPrice = $InfantsPrice/$Infants;
            $InfantsPrice = $InfantsPrice/100;
        }
        if($TripType == "oneway"){
            $TotalFee  = + ($AdultPrice * $Fee->markup_adult_oneway);
            $TotalFee  = + ($ChildrenPrice * $Fee->markup_child_oneway);
            $TotalFee  = + ($InfantsPrice * $Fee->markup_inf_oneway);
        }else{
            $TotalFee  = + ($AdultPrice * $Fee->markup_adult_return);
            $TotalFee  = + ($ChildrenPrice * $Fee->markup_child_return);
            $TotalFee  = + ($InfantsPrice * $Fee->markup_inf_return);
        }

       return $TotalFee;
    }

    Public function GetServiceFeeFlight($Origin,$Destination,$Price,$ApiId){
        $master_fee = CorproateServiceFeeMaster::where('id',$this->servicefeeid)->first();
        $Fee = $master_fee->getDetails($ApiId);
        $RegionalCountries = json_decode($Fee->county_for_regional);
        $City = Airport::where('code',$Origin)->first()->country_id;
        $Destination = Airport::where('code',$Destination)->first()->country_id;
        if($Fee->country_fordomestic == $City && $Fee->country_fordomestic == $Destination){
            $Price = $Price/100;
            $Price = $Price * $Fee->servicefee_flight_domestic;
        }elseif(in_array($City,$RegionalCountries) && in_array($Destination,$RegionalCountries)){
            $Price = $Price/100;
            $Price = $Price * $Fee->servidefee_flight_regional;
        }else{
            $Price = $Price/100;
            $Price = $Price * $Fee->servicefee_flight_international;
        }
        return $Price;
    }
    Public function GetHotelMarkup($ApiId){
        $master_fee = CorproateServiceFeeMaster::where('id',$this->servicefeeid)->first();
        $Fee = $master_fee->getDetails($ApiId);
//        if(!empty($Fee->hotel_markup_totalnights_percentage)){
//            $Price = $Price/100;
//            $Price = $Fee->hotel_markup_totalnights_percentage * $Price;
//        }else{
//            $Price = $Price/100;
//            $Price = $Fee->hotel_markup_perroom_pernight * $Price;
//            $Price = $Price * $Nights;
//        }
        return $Fee;
    }
}
