<?php

use AmirVahedix\Course\Models\Lesson;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('season_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('media_id');
            $table->string('title');
            $table->string('slug');
            $table->integer('duration')->unsigned()->nullable();
            $table->integer('priority')->unsigned()->nullable();
            $table->boolean('free')->default(false);
            $table->text('description')->nullable();
            $table->enum('confirmation_status', Lesson::confirmation_statuses)
                ->default(Lesson::CONFIRMATION_WAITING);
            $table->enum('status', Lesson::statuses)
                ->default(Lesson::STATUS_LOCK);
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('season_id')->references('id')->on('seasons')
                ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('media_id')->references('id')->on('media')
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
        Schema::dropIfExists('lessons');
    }
}
