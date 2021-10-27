<?php


namespace AmirVahedix\Payment\Services;


use AmirVahedix\Discount\Repositories\DiscountRepo;
use AmirVahedix\Discount\Services\DiscountService;
use AmirVahedix\Payment\Gateways\Gateway;
use AmirVahedix\Payment\Models\Payment;
use AmirVahedix\Payment\Repositories\PaymentRepo;

class PaymentService
{
    public static function generate($amount, $paymentable, $user, $discount)
    {
        if ($amount <= 0 || is_null($paymentable) || is_null($user)) return false;

        $gateway = resolve(Gateway::class);
        $invoice_id = $gateway->request($amount, $paymentable->title);

        if (is_array($invoice_id)) {
            // todo
            dd($invoice_id);
        }

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
            "discount_id" => $discount->id,
            "invoice_id" => $invoice_id,
            "gateway" => $gateway->getName(),
            "seller_percent" => $seller_percent,
            "seller_share" => $seller_share,
            "site_share" => $site_share,
        ]);
    }
}
