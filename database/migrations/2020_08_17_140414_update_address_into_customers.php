<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAddressIntoCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers',function (Blueprint $table) {
            $table->string('address')->nullable()->change();
            $table->string('url',50)->nullable()->default('http://')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers',function (Blueprint $table) {
            $table->string('address')->nullable()->change();
            $table->string('url',50)->nullable()->default('http://')->change();
        });
    }
}
