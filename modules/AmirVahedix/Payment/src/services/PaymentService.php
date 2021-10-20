<?php


namespace AmirVahedix\Payment\Services;


use AmirVahedix\Payment\Gateways\Gateway;
use AmirVahedix\Payment\Models\Payment;
use AmirVahedix\Payment\Repositories\PaymentRepo;

class PaymentService
{
    public static function generate($amount, $paymentable, $user)
    {
        if ($amount <= 0 || is_null($paymentable) || is_null($user)) return false;

        $gateway = new Gateway();
        $invoice_id = 0;

        if (!is_null($paymentable->percent)) {
            $seller_percent = $paymentable->percent;
            $seller_share = $amount * ($paymentable->percent / 100);
            $site_share = $amount - $seller_share;
        } else {
            $seller_percent = 0;
            $seller_share = 0;
            $site_share = $amount;
        }

        return resolve(PaymentRepo::class)->store([
            "buyer_id" => $user->id,
            "paymentable_id" => $paymentable->id,
            "paymentable_type" => get_class($paymentable),
            "amount" => $amount,
            "invoice_id" => $invoice_id,
            "gateway" => $gateway,
            "seller_percent" => $seller_percent,
            "seller_share" => $seller_share,
            "site_share" => $site_share,
        ]);
    }
}
