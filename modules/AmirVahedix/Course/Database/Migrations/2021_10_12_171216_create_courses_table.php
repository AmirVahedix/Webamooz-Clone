<?php

use AmirVahedix\Course\Models\Course;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
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
            $table->string('slug')->unique();
            $table->float('priority')->nullable();
            $table->string('price');
            $table->string('percent');
            $table->enum('type', Course::types)->default(Course::TYPE_FREE);
            $table->enum('status', Course::statuses)->default(Course::STATUS_PENDING);
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
        Schema::dropIfExists('courses');
    }
}
