<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname', 60);
            $table->string('middle_name', 60)->nullable();
            $table->string('lastname', 60);
            $table->string('suffix_name', 60)->nullable();
            $table->string('student_number', 14)->unique();
            $table->string('password',150)->nullable();
            $table->tinyInteger('registered')->default(0);
            $table->tinyInteger('active')->default(0);
            $table->rememberToken();

            $table->string('stripe_id', 100)->nullable();
            $table->string('card_brand', 50)->nullable();
            $table->string('card_last_four', 4)->nullable();
            $table->timestamp('trial_ends_at')->nullable();

            $table->timestamps();
        });

        Schema::create('subscriptions', function ($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name', 120);
            $table->string('stripe_id', 100);
            $table->string('stripe_plan', 50);
            $table->integer('quantity');
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('ends_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
