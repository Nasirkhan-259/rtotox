<?php


namespace App\Http\Controllers\Extra;


use App\Models\Corporate\CorporateMaster;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;

class Helpers
{
    public static function GetApiCredentials($CorporateId,$ModuleId){
        $corporate_master = CorporateMaster::where('id',$CorporateId)->first();
        return $corporate_master->GetApis($ModuleId);
    }
    public static function GetFlightMarkup($CorporateId,$AdultPrice,$ChildrenPrice,$InfantsPrice,$Adults,$Children,$Infants,$TripType,$ApiId){
        $corporate_master = CorporateMaster::where('id',$CorporateId)->first();
        return $corporate_master->GetServiceFee($AdultPrice,$ChildrenPrice,$InfantsPrice,$Adults,$Children,$Infants,$TripType,$ApiId);
    }
    public static function GetFlightServiceFee($CorporateId,$OriginCountry,$DestinationCountry,$Price,$ApiId){
        $corporate_master = CorporateMaster::where('id',$CorporateId)->first();
        return $corporate_master->GetServiceFeeFlight($OriginCountry,$DestinationCountry,$Price,$ApiId);
    }
    public static function ConvertPrice($price,$currency){

        return $price * $currency->rate;
    }
}