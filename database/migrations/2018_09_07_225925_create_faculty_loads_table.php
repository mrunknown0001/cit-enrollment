<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyLoadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_loads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('faculty_id')->unsigned();
            $table->foreign('faculty_id')->references('id')->on('faculties');
            $table->integer('subject_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->tinyInteger('active')->default(1);
            $table->integer('course_id')->unsigned()->nullable();
            $table->integer('curriculum_id')->unsigned()->nullable();
            $table->integer('academic_year_id')->unsigned()->nullable();
            $table->integer('semester_id')->unsigned()->nullable();
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
        Schema::dropIfExists('faculty_loads');
    }
}
