<?php

use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Payment\Gateways\Gateway;
use AmirVahedix\Payment\Models\Payment;
use AmirVahedix\User\Mail\VerifyCodeMail;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('test', function() {
    $gateway = resolve(Gateway::class);

    $payment = new Payment();
    $gateway->request($payment);

    dd($gateway);
});
