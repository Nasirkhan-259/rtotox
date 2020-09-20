<?php

namespace App\Models\Corporate;

use Illuminate\Foundation\Auth\User as Authenticatable;

class CorporateEmployee extends Authenticatable
{
    protected $table = "corporate_employees";

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];


    public function getBranch()
    {
        return $this->hasOne('App\Models\CorporateBranch', 'corporate_branchid');
    }

    public function Corporate()
    {
        return $this->hasOne(CorporateMaster::class, "id", "corporate_id");
    }
}
