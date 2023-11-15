<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

trait UserTrait
{
    public function authRedirect()
    {
        // if (Auth::check() && Auth::user()->type == 'admin') {

        //     return  RouteServiceProvider::ADMIN;
        // } else {
        //     return  RouteServiceProvider::USER;
        // }
    }
}
