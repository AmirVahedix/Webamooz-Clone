<?php

namespace AmirVahedix\Payment\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddSellerShareToAccount
{
    public function __construct()
    {

    }

    public function handle($event)
    {
        $teacher = $event->payment->paymentable->teacher;
        $teacher->update([
            'balance' => $teacher->balance += $event->payment->seller_share
        ]);
    }
}
