<?php


namespace AmirVahedix\Payment\Http\Controllers;


use AmirVahedix\Payment\Gateways\Gateway;
use AmirVahedix\Payment\Models\Payment;
use AmirVahedix\Payment\Repositories\PaymentRepo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function callback(Request $request, PaymentRepo $paymentRepo)
    {
        $gateway = resolve(Gateway::class);
        $payment = $paymentRepo->findByInvoice($request->get('Authority'));

        $result = $gateway->verify($payment);

//        dd($request->get('Authority'));

        if (!$payment || is_array($result)) {
            $paymentRepo->updateStatus($payment, Payment::STATUS_FAILED);
            alert("تراکنش ناموفق", $result['message'] , "error")->showConfirmButton('حله', '#46B2F0');
            return redirect($payment->paymentable->path());
        }

        $paymentRepo->updateStatus($payment, Payment::STATUS_SUCCESS);
        alert("تراکنش موفق", "پرداخت موفقیت آمیز بود.", "success")->showConfirmButton('حله', '#46B2F0');
        return redirect($payment->paymentable->path());
    }
}
