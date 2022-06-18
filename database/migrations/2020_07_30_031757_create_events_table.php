<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_events', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->char('crm_customer_id');
            $table->char('crm_contact_id')->nullable();
            $table->string('crm_contract_id')->nullable();
            $table->integer('crm_opportunity_id')->nullable();
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
        Schema::dropIfExists('crm_events');
    }
}
