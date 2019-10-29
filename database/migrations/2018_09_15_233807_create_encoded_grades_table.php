<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncodedGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encoded_grades', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('course_id')->unsigned();
            // $table->foreign('course_id')->references('id')->on('courses');
            $table->integer('curriculum_id')->unsigned();
            // $table->integer('year_level_id')->unsigned();
            // $table->integer('semester_id')->unsigned();
            $table->integer('academic_year_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->tinyInteger('encoded')->default(0);
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
        Schema::dropIfExists('encoded_grades');
    }
}
