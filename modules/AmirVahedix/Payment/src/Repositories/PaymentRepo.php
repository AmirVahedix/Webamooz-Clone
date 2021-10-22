<?php

namespace AmirVahedix\Payment\Repositories;


use AmirVahedix\Payment\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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
        return Payment::latest()->paginate($per_page);
    }

    public function getLastNDaysTotal($days)
    {
        return $this->getLastNDaysPayments($days)
            ->sum('amount');
    }

    public function getLastNDaysSiteBenefit($days)
    {
        return $this->getLastNDaysPayments($days)
            ->sum('site_share');
    }

    public function getAllTotal()
    {
        return $this->getLastNDaysPayments()
            ->sum('amount');
    }

    public function getAllBenefit()
    {
        return $this->getLastNDaysPayments()
            ->sum('site_share');
    }

    private function getLastNDaysPayments($days = null)
    {
        $payments = Payment::query();

        if (!is_null($days))
            $payments = $payments->where('created_at', '>=', now()->addDays(-$days));

        return $payments
            ->where('status', Payment::STATUS_SUCCESS);
    }

    public function getDayPayments($day, $status)
    {
        return Payment::query()
            ->whereDate('created_at', $day)
            ->where('status', $status);
    }

    public function getDaySuccessPayments($day)
    {
        return $this->getDayPayments($day, Payment::STATUS_SUCCESS);
    }

    public function getDayFailPayments($day)
    {
        return $this->getDayPayments($day, Payment::STATUS_FAILED);
    }

    public function getDaySuccessPaymentsTotal($day)
    {
        return $this->getDaySuccessPayments($day)->sum('amount');
    }

    public function getDayFailedPaymentsTotal($day)
    {
        return $this->getDayFailPayments($day)->sum('amount');
    }

    public function getDaySiteShare($day)
    {
        return $this->getDaySuccessPayments($day)->sum('site_share');
    }

    public function getDaySellerShare($day)
    {
        return $this->getDaySuccessPayments($day)->sum('seller_share');
    }

    public function getDailySummary(Collection $dates)
    {
        return Payment::query()->where('created_at', '>=', $dates->keys()->first())
            ->groupBy('date')
            ->orderBy('date')
            ->get([
                DB::raw("DATE(created_at) as date"),
                DB::raw("SUM(amount) as totalAmount"),
                DB::raw("SUM(seller_share) as totalSellerShare"),
                DB::raw("SUM(site_share) as totalSiteShare"),
            ]);
    }
}
