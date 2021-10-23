<?php

namespace AmirVahedix\Payment\Repositories;


use AmirVahedix\Course\Models\Course;
use AmirVahedix\Payment\Models\Payment;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class PaymentRepo
{
    private $query;

    public function __construct()
    {
        $this->query = Payment::query();
    }

    public function findByInvoice($invoice_id)
    {
        return Payment::where('invoice_id', $invoice_id)->first();
    }

    public function searchEmail($email): PaymentRepo
    {
        if ($email) {
            $this->query
                ->join('users', 'payments.buyer_id', 'users.id')
                ->select(['payments.*', 'users.email'])
                ->where('users.email', "LIKE", "%$email%");
        }
        return $this;
    }

    public function searchMobile($mobile): PaymentRepo
    {
        if ($mobile) {
            $this->query
                ->join('users', 'payments.buyer_id', 'users.id')
                ->select(['payments.*', 'users.mobile'])
                ->where('users.mobile', "LIKE", "%$mobile%");
        }
        return $this;
    }

    public function searchAmount($amount): PaymentRepo
    {
        if ($amount) $this->query->where('amount', $amount);
        return $this;
    }

    public function searchInvoice($invoice): PaymentRepo
    {
        if ($invoice) $this->query->where('invoice_id', "LIKE", "%$invoice%");
        return $this;
    }

    public function searchAfterDate($start_date): PaymentRepo
    {
        if ($start_date) {
            $date = Jalalian::fromFormat("Y/m/d", $start_date)->toCarbon();
            $this->query->whereDate("created_at", ">=", $date);
        }
        return $this;
    }

    public function searchBeforeDate($end_date): PaymentRepo
    {
        if ($end_date) {
            $date = Jalalian::fromFormat("Y/m/d", $end_date)->toCarbon();
            $this->query->where("created_at", "<=", $date);
        }
        return $this;
    }

    public function paginate($per_page = 25): LengthAwarePaginator
    {
        return $this->query->latest()->paginate($per_page);
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

    public function getDaySellerShare($day)
    {
        return $this->getDaySuccessPayments($day)->sum('seller_share');
    }

    public function getDailySummary(Collection $dates, $user_id = null)
    {
        $query = Payment::query()
            ->where('created_at', '>=', $dates->keys()->first());

        if ($user_id) {
            $query->whereHasMorph(
                'paymentable',
                [Course::class],
                function (Builder $query) use ($user_id) {
                    $query->where('teacher_id', $user_id);
                }
            );
        }

        return $query->groupBy('date')
            ->orderBy('date')
            ->get([
                DB::raw("DATE(created_at) as date"),
                DB::raw("SUM(amount) as totalAmount"),
                DB::raw("SUM(seller_share) as totalSellerShare"),
                DB::raw("SUM(site_share) as totalSiteShare"),
            ]);
    }

    public function getTeacherTotalSell($user)
    {
        return Payment::query()
            ->whereHasMorph(
                'paymentable',
                [Course::class],
                function (Builder $query) use ($user) {
                    $query->where('teacher_id', $user->id);
                }
            )
            ->where('status', Payment::STATUS_SUCCESS);
    }

    public function getTeacherTotalSellAmount($user)
    {
        return $this->getTeacherTotalSell($user)->sum('amount');
    }

    public function getTeacherTotalSellBenefit($user)
    {
        return $this->getTeacherTotalSell($user)->sum('seller_share');
    }

    public function getTeacherBenefit($user, $date)
    {
        return $this->getTeacherTotalSell($user)
            ->whereDate('created_at', $date)
            ->sum('seller_share');
    }

    public function getTeacherLast30DayBenefit($user)
    {
        return $this->getTeacherTotalSell($user)
            ->whereDate('created_at', '>=', now()->addDays(-30))
            ->whereDate('created_at', '<=', now())
            ->sum('seller_share');
    }

    public function getTeacherTodayPurchases($user)
    {
        return $this->getTeacherTotalSell($user)
            ->whereDate('created_at', now())
            ->count();
    }

    public function getTeacherTodayPurchaseAmount($user)
    {
        return $this->getTeacherTotalSell($user)
            ->whereDate('created_at', now())
            ->sum('amount');
    }
}
