<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function SetCurrency($currency = "USD")
    {
        session(['currency' => $currency]);
        return redirect()->back();
    }
}
