<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('receive',9,2)->nullable(false);
            $table->integer('paymethod');
            $table->integer('billtype');
            $table->integer('crm_contract_id');
            $table->string('remark')->default('');

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
        Schema::dropIfExists('crm_receipts');
    }
}
