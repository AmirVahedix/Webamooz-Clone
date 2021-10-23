<?php


namespace AmirVahedix\Payment\Http\Controllers;


use App\Http\Controllers\Controller;

class PurchaseController extends Controller
{
    public function index()
    {
        $payments = auth()->user()->payments()->paginate(25);
        return view('Payment::purchases', compact('payments'));
    }
}
