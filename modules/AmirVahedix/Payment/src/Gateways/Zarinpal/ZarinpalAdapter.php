<?php

namespace AmirVahedix\Payment\Gateways\Zarinpal;

use AmirVahedix\Payment\Contracts\GatewayContract;
use AmirVahedix\Payment\Models\Payment;

class ZarinpalAdapter implements GatewayContract
{
    public function request(Payment $payment)
    {
        $zarinpal = new Zarinpal();
        $callback = "";
        $result = $zarinpal->request(
            "*****************",
            $payment->amount,
            $payment->paymentable->title,
            "",
            "",
            $callback,
        );


        if (isset($result["Status"]) && $result["Status"] == 100) {
            return $result["Authority"];
//            $zarinpal->redirect($result["StartPay"]);
        } else {
            echo "خطا در ایجاد تراکنش";
            echo "<br />کد خطا : ". $result["Status"];
            echo "<br />تفسیر و علت خطا : ". $result["Message"];
        }
    }

    public function verify(Payment $payment)
    {
        // TODO: Implement verify() method.
    }
}
