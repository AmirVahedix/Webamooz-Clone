<?php


namespace AmirVahedix\Payment\Http\Controllers;


use AmirVahedix\Payment\Events\SuccessfulPaymentEvent;
use AmirVahedix\Payment\Gateways\Gateway;
use AmirVahedix\Payment\Models\Payment;
use AmirVahedix\Payment\Repositories\PaymentRepo;
use App\Http\Controllers\Controller;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $paymentRepo;

    public function __construct(PaymentRepo $paymentRepo)
    {
        $this->paymentRepo = $paymentRepo;
    }

    public function index(Request $request)
    {
        $this->authorize("manage", Payment::class);

        $payments = $this->paymentRepo
            ->searchEmail($request->get('email'))
            ->searchMobile($request->get('mobile'))
            ->searchAmount($request->get('amount'))
            ->searchInvoice($request->get('invoice_id'))
            ->paginate();

        $last30DaysTotal = $this->paymentRepo->getLastNDaysTotal(30);
        $last30DaysSiteBenefit = $this->paymentRepo->getLastNDaysSiteBenefit(30);
        $allSiteBenefit = $this->paymentRepo->getAllBenefit();
        $allSiteTotal = $this->paymentRepo->getAllTotal();

        $dates = collect();
        foreach (range(-30, 0) as $i) {
            $dates->put(now()->addDays($i)->format('Y-m-d'), 0);
        }
        $summary =  $this->paymentRepo->getDailySummary($dates);


        return view('Payment::index', compact(
            'payments',
            'last30DaysTotal',
            'last30DaysSiteBenefit',
            'allSiteBenefit',
            'allSiteTotal',
            'dates',
            'summary',
        ));
    }

    public function callback(Request $request)
    {
        $gateway = resolve(Gateway::class);
        $payment = $this->paymentRepo->findByInvoice($request->get('Authority'));

        $result = $gateway->verify($payment);

        if (!$payment || is_array($result)) {
            $this->paymentRepo->updateStatus($payment, Payment::STATUS_FAILED);
            alert("تراکنش ناموفق", "متاسفانه پرداخت با خطا مواجه شد.", "error")->showConfirmButton('حله', '#46B2F0');
            return redirect($payment->paymentable->path());
        }

        event(new SuccessfulPaymentEvent($payment));
        $this->paymentRepo->updateStatus($payment, Payment::STATUS_SUCCESS);
        alert("تراکنش موفق", "پرداخت موفقیت آمیز بود.", "success")->showConfirmButton('حله', '#46B2F0');
        return redirect($payment->paymentable->path());
    }
}
