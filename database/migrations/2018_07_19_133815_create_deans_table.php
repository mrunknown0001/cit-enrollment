<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 32);
            $table->string('password', 150)->nullable();
            $table->string('firstname', 60);
            $table->string('middle_name', 60)->nullable();
            $table->string('lastname', 60);
            $table->string('suffix_name', 60)->nullable();
            $table->string('id_number', 14)->nullable();
            $table->tinyInteger('active')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('deans');
    }
}
