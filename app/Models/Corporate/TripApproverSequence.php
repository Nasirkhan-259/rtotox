<?php

namespace App\Models\Corporate;

use Illuminate\Database\Eloquent\Model;

class TripApproverSequence extends Model
{
    protected $fillable = [
      "corporate_trip_master_id",
      "sequence_number",
      "corporate_employee_id",
      "is_approved"
    ];
}
