<?php

namespace App\Models\Corporate;

use Illuminate\Database\Eloquent\Model;

class CorporateTripMaster extends Model
{
    /**
     * Get the policy of corporate associated with the trip.
     */
    public function corporatePolicy()
    {
        return $this->hasOne(CorporatePolicy::class, "corporate_id", "corporateid");
    }
}
