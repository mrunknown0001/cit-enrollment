<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('users');
            // $table->integer('year_level_id')->unsigned()->nullable();
            $table->boolean('esc_scholar')->default(0);
            $table->integer('curriculum_id')->nullable(); // grade level
            $table->string('sex', 8)->nullable();
            $table->string('mobile_number', 13)->nullable();
            $table->string('contact_number', 13)->nullable();
            $table->string('email', 120)->nullable();
            $table->string('home_address')->nullable();
            $table->string('nationality', 20)->nullable();
            $table->string('civil_status', 10)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->integer('age')->nullable();
            $table->string('religion', 50)->nullable();
            $table->string('fathers_name', 120)->nullable();
            $table->string('mothers_name', 120)->nullable();
            $table->string('parents_address')->nullable();
            $table->string('guardians_name', 120)->nullable();
            $table->string('guardians_address')->nullable();
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
        Schema::dropIfExists('student_infos');
    }
}
