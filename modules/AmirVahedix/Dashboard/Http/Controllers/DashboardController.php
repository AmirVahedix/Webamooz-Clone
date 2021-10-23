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

        return view(
            'Dashboard::index',
            compact(
                'teacherTotalSellAmount',
                'teacherTotalSellBenefit',
                'teacherTodayBenefit',
                'teacherLast30DayBenefit',
                'teacherTodaySuccessPayments',
                'teacherTodayTotalAmount'
            )
        );
    }
}
