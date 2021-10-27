<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountPaymentTable extends Migration
{
    public function up()
    {
        Schema::create('discount_payment', function (Blueprint $table) {
            $table->foreignId('discount_id');
            $table->foreignId('payment_id');

            $table->primary(['discount_id', 'payment_id']);

            $table->foreign('discount_id')->references('id')->on('discounts')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('discount_payment');
    }
}
