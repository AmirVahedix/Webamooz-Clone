<?php

namespace AmirVahedix\Discount\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateDiscountAfterPayment
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $event->payment->discount->update([
            'uses' => $event->payment->discount->uses + 1,
        ]);

        if ($event->payment->discount->limit) {
            $event->payment->discount->update([
                'limit' => $event->payment->discount->limit - 1
            ]);
        }
    }
}
