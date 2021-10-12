<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->float('priority')->nullable();
            $table->string('price');
            $table->string('percent');
            $table->enum('type', ['free', 'paid']);
            $table->enum('status', ['completed', 'pending', 'locked']);
            $table->text('description');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('set null')->onUpdate('cascade');

            $table->foreign('teacher_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
