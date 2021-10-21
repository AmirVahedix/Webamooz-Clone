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

    public function index()
    {
        $this->authorize("manage", Payment::class);

        $payments = $this->paymentRepo->paginate();

        $last30DaysTotal = $this->paymentRepo->getLastNDaysTotal(30);
        $last30DaysSiteBenefit = $this->paymentRepo->getLastNDaysSiteBenefit(30);
        $allSiteBenefit = $this->paymentRepo->getAllBenefit();
        $allSiteTotal = $this->paymentRepo->getAllTotal();

        $last30Days = CarbonPeriod::create(now()->addDays(-30), now());

        return view('Payment::index', [
            'payments' => $payments,
            'last30DaysTotal' => $last30DaysTotal,
            'last30DaysSiteBenefit' => $last30DaysSiteBenefit,
            'allSiteBenefit' => $allSiteBenefit,
            'allSiteTotal' => $allSiteTotal,
            'last30Days' => $last30Days,
            'paymentRepo' => $this->paymentRepo
        ]);
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
