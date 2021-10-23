<?php

use AmirVahedix\Payment\Models\Settlement;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementsTable extends Migration
{
    public function up()
    {
        Schema::create('settlements', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->json('from')->nullable();
            $table->json('to')->nullable();
            $table->string('amount');
            $table->enum('status', Settlement::statuses)->default(Settlement::STATUS_WAITING);
            $table->timestamp('settled_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('settlements');
    }
}
