<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersAddProdprice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crm_orders', function (Blueprint $table) {
            $table->decimal('prod_price')->default(0)->comment('产品价格标准价快照');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crm_orders', function (Blueprint $table){
           $table->dropColumn('prod_price');
        });
    }
}
