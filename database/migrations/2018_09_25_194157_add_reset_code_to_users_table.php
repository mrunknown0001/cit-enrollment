<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResetCodeToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('reset_code', 20)
                ->after('remember_token')
                ->nullable()
                ->default(null)
                ->comment('Reset Code of the user');
            $table->string('code_expiration', 15)
                ->nullable()
                ->default(null)
                ->comment('Expiratio of the code issued');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('reset_code');
            $table->dropColumn('code_expiration');
        });
    }
}