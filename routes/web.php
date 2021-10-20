<?php

use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Payment\Gateways\Gateway;
use AmirVahedix\Payment\Models\Payment;
use AmirVahedix\User\Mail\VerifyCodeMail;
use App\Events\SuccessfulPaymentEvent;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('test', function() {
    event(new \AmirVahedix\Payment\Events\SuccessfulPaymentEvent(Payment::first()));
});
