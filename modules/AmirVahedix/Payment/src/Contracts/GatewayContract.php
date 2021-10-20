<?php


namespace AmirVahedix\Payment\Contracts;


use AmirVahedix\Payment\Models\Payment;

interface GatewayContract
{
    public function request(Payment $payment);

    public function verify(Payment $payment);
}
