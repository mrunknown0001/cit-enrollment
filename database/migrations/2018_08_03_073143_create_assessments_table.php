<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('users');
            $table->integer('academic_year_id')->unsigned();
            // $table->integer('semester_id')->unsigned();
            // $table->integer('year_level_id')->unsigned()->nullable();
            // $table->integer('course_id')->unsigned();
            $table->integer('curriculum_id')->unsigned();
            $table->integer('section_id')->unsinged();
            $table->string('subject_ids', 80)->nullable();
            $table->float('amount', 8, 2)->default(0);
            $table->boolean('paid')->default(0);
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('assessments');
    }
}
