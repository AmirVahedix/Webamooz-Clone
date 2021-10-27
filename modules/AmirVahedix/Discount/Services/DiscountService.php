<?php


namespace AmirVahedix\Discount\Services;


use AmirVahedix\Discount\Repositories\DiscountRepo;

class DiscountService
{
    public static function check($code, $course)
    {
        return resolve(DiscountRepo::class)->codeIsValid($code, $course);
    }

    public static function getDiscountAmount($amount, $discount)
    {
        return $amount * ($discount->percent/100);
    }

    public static function getAmountAfterDiscount($amount, $discount)
    {
        return $amount - self::getDiscountAmount($amount, $discount);
    }
}
