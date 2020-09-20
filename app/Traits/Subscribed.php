<?php

namespace App\Traits;

use App\Models\Subscribe;


trait Subscribed
{

    protected function subscribe($email)
    {
        $email_old = Subscribe::where('email',$email)->first();
        if(empty($email_old))
        {
            Subscribe::create(["email"=>$email]);
            return true;
        }else{
            return false;
        }
    }
}
