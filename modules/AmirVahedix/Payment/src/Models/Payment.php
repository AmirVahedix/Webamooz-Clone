<?php

namespace AmirVahedix\Payment\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // region constants
    const STATUS_PENDING = "pending";
    const STATUS_CANCELED = "canceled";
    const STATUS_SUCCESS = "success";
    const STATUS_FAILED = "failed";

    const statuses = [self::STATUS_PENDING, self::STATUS_CANCELED, self::STATUS_SUCCESS, self::STATUS_FAILED];
    // endregion constants

    // region model config
    protected $table = 'payments';

    protected $fillable = [
        'buyer_id',
        'paymentable_id',
        'paymentable_type',
        'amount',
        'invoice_id',
        'gateway',
        'status',
        'seller_percent',
        'seller_share',
        'site_share',
    ];
    // endregion model config

    public function paymentable()
    {
        return $this->morphTo();
    }
}
