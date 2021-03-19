<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('');
            $table->integer('crm_customer_id');
            $table->json('fields')->nullable();
            $table->date('signdate');
            $table->date('expiretime');
            $table->integer('status');
            $table->string('order')->nullable();
            $table->integer('total')->nullable();
            $table->integer('salesexpenses')->nullable();
            $table->string('remark')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crm_contracts');
    }
}
