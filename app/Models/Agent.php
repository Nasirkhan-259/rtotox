<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Agent extends Authenticatable
{
    protected $fillable = ["agent_id","email","first_name","last_name","contact_number","password"];

}
