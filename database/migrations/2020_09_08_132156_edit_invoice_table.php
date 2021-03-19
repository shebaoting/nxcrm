<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crm_invoices', function (Blueprint $table) {
            $table->string('tin')->default('')->nullable()->change();
            $table->string('bank_name')->default('')->nullable()->change();
            $table->string('bank_account')->default('')->nullable()->change();
            $table->string('address')->default('')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
