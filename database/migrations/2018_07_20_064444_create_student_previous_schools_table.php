<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentPreviousSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_previous_schools', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('users');
            $table->string('elementary_school')->nullable();
            $table->string('elementary_year_graduated')->nullable();
            $table->string('high_school')->nullable();
            $table->string('high_school_year_graduated')->nullable();
            $table->string('college_school')->nullable();
            $table->string('college_year_graduated')->nullable();
            $table->string('school_last_attended')->nullable();
            $table->string('school_address')->nullable();
            $table->string('year_graduated')->nullable();
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
        Schema::dropIfExists('student_previous_schools');
    }
}
