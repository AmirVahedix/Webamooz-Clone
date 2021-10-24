<?php

namespace AmirVahedix\Payment\Http\Controllers;

use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Payment\Http\Requests\StoreSettlementRequest;
use AmirVahedix\Payment\Models\Settlement;
use AmirVahedix\Payment\Repositories\SettlementRepo;
use AmirVahedix\User\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettlementController extends Controller
{
    private $settlementRepo;

    public function __construct(SettlementRepo $settlementRepo)
    {
        $this->settlementRepo = $settlementRepo;
    }

    public function index(Request $request)
    {
        $this->authorize('index', Settlement::class);

        $settlements = $this->settlementRepo
            ->paginate(auth()->id(), $request->get('status') ?? '');

        if (auth()->user()->canAny([
            Permission::PERMISSION_MANAGE_PAYMENTS,
            Permission::PERMISSION_SUPER_ADMIN
        ])) {
            $settlements = $this->settlementRepo
                ->paginate(null, $request->get('status') ?? '');
        }

        return view("Payment::settlements.index", compact('settlements'));
    }

    public function create()
    {
        $this->authorize('create', Settlement::class);

        return view("Payment::settlements.create");
    }

    public function store(StoreSettlementRequest $request): RedirectResponse
    {
        $this->authorize('create', Settlement::class);

        if (auth()->user()->checkHasWaitingSettlement()) {
            toast('درخواست قبلی شما در انتظار بررسی میباشد.', 'error');
            return back();
        }

        $this->settlementRepo->store($request);

        toast('درخواست تسویه باموفقیت ثبت شد.', 'success');
        return redirect()->route('dashboard.settlements.index');
    }

    public function cancel(Settlement $settlement): RedirectResponse
    {
        $this->authorize('cancel', [Settlement::class, $settlement]);

        $this->settlementRepo->updateStatus($settlement, Settlement::STATUS_CANCELED);

        toast('درخواست تسویه باموفقیت لغو شد.', 'success');
        return redirect()->route('dashboard.settlements.index');
    }

    public function accept(Settlement $settlement): RedirectResponse
    {
        $this->authorize('accept', [Settlement::class, $settlement]);

        $this->settlementRepo->updateStatus($settlement, Settlement::STATUS_SETTLED);

        $settlement->user->update([
            'balance' => $settlement->user->balance - $settlement->amount,
        ]);

        $settlement->update([ 'settled_at' => now() ]);

        toast('درخواست تسویه باموفقیت تایید شد.', 'success');
        return redirect()->route('dashboard.settlements.index');
    }

    public function reject(Settlement $settlement): RedirectResponse
    {
        $this->authorize('reject', [Settlement::class, $settlement]);

        $this->settlementRepo->updateStatus($settlement, Settlement::STATUS_REJECTED);

        $settlement->update([ 'settled_at' => null ]);

        toast('درخواست تسویه باموفقیت رد شد.', 'success');
        return redirect()->route('dashboard.settlements.index');
    }
}
