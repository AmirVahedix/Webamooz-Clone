<?php

namespace AmirVahedix\Payment\Repositories;


use AmirVahedix\Payment\Models\Payment;

class PaymentRepo
{
    public function findByInvoice($invoice_id)
    {
        return Payment::where('invoice_id', $invoice_id)->first();
    }

    public function store($data)
    {
        return Payment::create([
            "buyer_id" => $data['buyer_id'],
            "paymentable_id" => $data['paymentable_id'],
            "paymentable_type" => $data['paymentable_type'],
            "amount" => $data['amount'],
            "invoice_id" => $data['invoice_id'],
            "gateway" => $data['gateway'],
            "seller_percent" => $data['seller_percent'],
            "seller_share" => $data['seller_share'],
            "site_share" => $data['site_share'],
        ]);
    }

    public function updateStatus($payment, $status)
    {
        return $payment->update([
            'status' => $status
        ]);
    }

    public function paginate($per_page = 25)
    {
        return Payment::latest()->take($per_page)->get();
    }
}
