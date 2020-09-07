<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('receipt_id');
            $table->decimal('money');
            $table->integer('type');
            $table->integer('title_type');
            $table->string('title')->default('');
            $table->string('tin')->default('');
            $table->string('bank_name')->default('');
            $table->string('bank_account')->default('');
            $table->string('address')->default('');
            $table->char('phone');
            $table->string('contact_name')->default('');
            $table->char('contact_phone');
            $table->string('contact_address')->default('');
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
        Schema::dropIfExists('invoices');
    }
}
