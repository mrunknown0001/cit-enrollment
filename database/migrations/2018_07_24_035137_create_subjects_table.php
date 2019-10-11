<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 20);
            $table->string('description', 190)->nullable();
            $table->integer('units');
            $table->integer('lab_units')->nullable();
            // $table->integer('prerequisite')->nullable(); // subject id of prerequisite subject
            // $table->integer('course_id')->unsigned();
            // $table->foreign('course_id')->references('id')->on('courses');
            // $table->integer('major_id')->unsigned()->nullable();
            // $table->integer('curriculum_id')->unsigned();
            $table->integer('strand_id')->unsigned();
            $table->foreign('strand_id')->references('id')->on('strands');
            $table->integer('year_level_id')->unsigned();
            $table->integer('semester_id')->unsigned();
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
