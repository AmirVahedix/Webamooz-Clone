<?php


namespace AmirVahedix\Dashboard\Http\Controllers;

use AmirVahedix\Payment\Repositories\PaymentRepo;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(PaymentRepo $paymentRepo)
    {
        $teacherTotalSellAmount = $paymentRepo->getTeacherTotalSellAmount(auth()->user());
        $teacherTotalSellBenefit = $paymentRepo->getTeacherTotalSellBenefit(auth()->user());
        $teacherTodayBenefit = $paymentRepo->getTeacherBenefit(auth()->user(), now());
        $teacherLast30DayBenefit = $paymentRepo->getTeacherLast30DayBenefit(auth()->user());
        $teacherTodaySuccessPayments = $paymentRepo->getTeacherTodayPurchases(auth()->user());
        $teacherTodayTotalAmount = $paymentRepo->getTeacherTodayPurchaseAmount(auth()->user());

        $payments = $paymentRepo->getTeacherTotalSell(auth()->user())->take(10)->get();

        $last30DaysTotal = $paymentRepo->getLastNDaysTotal(30);
        $last30DaysSiteBenefit = $paymentRepo->getLastNDaysSiteBenefit(30);
        $allSiteBenefit = $paymentRepo->getAllBenefit();
        $allSiteTotal = $paymentRepo->getAllTotal();

        $dates = collect();
        foreach (range(-30, 0) as $i) {
            $dates->put(now()->addDays($i)->format('Y-m-d'), 0);
        }
        $summary =  $paymentRepo->getDailySummary($dates, auth()->id());

        return view(
            'Dashboard::index',
            compact(
                'teacherTotalSellAmount',
                'teacherTotalSellBenefit',
                'teacherTodayBenefit',
                'teacherLast30DayBenefit',
                'teacherTodaySuccessPayments',
                'teacherTodayTotalAmount',
                'last30DaysTotal',
                'last30DaysSiteBenefit',
                'allSiteBenefit',
                'allSiteTotal',
                'summary',
                'payments',
                'dates'
            )
        );
    }
}
