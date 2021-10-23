<?php

namespace AmirVahedix\Payment\Http\Controllers;

use AmirVahedix\Payment\Http\Requests\StoreSettlementRequest;
use AmirVahedix\Payment\Repositories\SettlementRepo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettlementController extends Controller
{
    private $settlementRepo;

    public function __construct(SettlementRepo $settlementRepo)
    {
        $this->settlementRepo = $settlementRepo;
    }

    public function index()
    {
        $settlements = $this->settlementRepo->paginate(auth()->id());
        return view("Payment::settlements.index", compact('settlements'));
    }

    public function create()
    {
        return view("Payment::settlements.create");
    }

    public function store(StoreSettlementRequest $request)
    {
        $this->settlementRepo->store($request);

        toast('موفقیت آمیز', 'درخواست تسویه باموفقیت ثبت شد.');
        return redirect()->route('dashboard.settlements.index');
    }
}
