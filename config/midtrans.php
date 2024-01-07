<?php
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [
    'Midtrans'=>[
        'serverKey'=>env('MIDTRANS_SERVER_KEY'),
        'clientKey'=>env('MIDTRANS_CLIENT_KEY'),
        'isProduction'=>env('MIDTRANS_IS_PRODUCTION',false),
        'isSanitized'=>env('MIDTRANS_IS_SANITIZED',true),
        'is3ds'=>env('MIDRANS_IS_3DS',true),
        
    ],

];