<?php


namespace AmirVahedix\Payment\Contracts;


use AmirVahedix\Payment\Models\Payment;

interface GatewayContract
{
    public function request($amount, $description);

    public function verify(Payment $payment);

    public function redirect();
}
