<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_calendars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255)->nullable();
            $table->date('date')->nullable();
            $table->text('description')->nullable();
            $table->boolean('active')->default();
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
        Schema::dropIfExists('school_calendars');
    }
}
