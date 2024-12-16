<?php

namespace App\Helpers;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransConfig
{
    public static function set()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true; 
        Config::$is3ds = true;
    }
}
