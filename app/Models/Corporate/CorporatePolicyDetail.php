<?php

namespace App\Models\Corporate;

use Illuminate\Database\Eloquent\Model;

class CorporatePolicyDetail extends Model
{
    //
    protected $table = "corporate_policy_details";
    protected $fillable = ["rotational_values","corporate_id","policy_id","hotel_domestic_totalbudget","flight_domestic_totalbudget"
        ,"domestic_econonomy_allowed","international_businessclass_allowed","international_firstclass_allowed",
        "international_premiumeconomy_allowed","domestic_econonomy_hours","domestic_businessclass_hours","international_hotel_budget",
        "international_flight_budget","international_econonomy_hours"," international_premiumeconomy_hours "
        ,"international_businessclass_hours","international_firstclass_hours","flights_rulesmasterid","is_active"
        ,"per_day_allowance","Insurance","allow_self_booking","number_ofday","international_econonomy_allowed","allow_bussiness"
        ,"allow_bussiness_family","allow_rotational","allow_medical","allow_personal","domestic_businessclass_allowed"
        ,"domestic_first_allowed","domestic_firstclass_hours","domestic_premiumcalss_allowed","domestic_premiumcalss_hours","rule_id","preffer_flight"];
}
