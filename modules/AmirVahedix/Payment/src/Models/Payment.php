<?php

namespace AmirVahedix\Payment\Models;

use AmirVahedix\Discount\Models\Discount;
use AmirVahedix\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // region constants
    const STATUS_WAITING = "waiting";
    const STATUS_CANCELED = "canceled";
    const STATUS_SUCCESS = "success";
    const STATUS_FAILED = "failed";

    const statuses = [self::STATUS_WAITING, self::STATUS_CANCELED, self::STATUS_SUCCESS, self::STATUS_FAILED];
    // endregion constants

    // region model config
    protected $table = 'payments';

    protected $fillable = [
        'buyer_id',
        'paymentable_id',
        'paymentable_type',
        'amount',
        'discount_id',
        'invoice_id',
        'gateway',
        'status',
        'seller_percent',
        'seller_share',
        'site_share',
    ];
    // endregion model config

    // region relations
    public function paymentable()
    {
        return $this->morphTo();
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function discounts()
    {
        return $this->belongsTo(Discount::class);
    }
    // endregion relations
}
