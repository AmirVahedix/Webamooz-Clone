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
            $table->foreignId('user_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->json('from')->nullable();
            $table->json('to')->nullable();
            $table->string('amount');
            $table->enum('status', Settlement::statuses)->default(Settlement::STATUS_WAITING);
            $table->timestamp('settled_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('settlements');
    }
}
