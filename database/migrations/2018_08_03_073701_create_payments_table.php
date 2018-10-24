<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('users');
            $table->integer('academic_year_id')->unsigned();
            $table->integer('semester_id')->unsigned();
            $table->integer('mode_of_payment_id')->unsigned();
            $table->float('amount', 8,2);
            $table->float('total_payable', 8,2)->unsigned()->nullable();
            $table->float('total_paid', 8,2)->unsigned()->nullable();
            $table->float('current_balance', 8,2)->unsigned()->nullable();
            $table->integer('payment_number')->nullable(); // up to 4 installment payment
            $table->string('description', 150)->nullable();
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
        Schema::dropIfExists('payments');
    }
}
