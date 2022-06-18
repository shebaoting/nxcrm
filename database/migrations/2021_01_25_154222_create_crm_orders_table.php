<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\CrmContract as Model;

class CreateCrmOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('crm_orders')) {
            Schema::create('crm_orders', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('crm_contract_id');
                $table->integer('crm_product_id');
                $table->decimal('executionprice')->default('0');
                $table->tinyInteger('quantity')->default('0');
            });
            $data = [];
            foreach (Model::query()->cursor() as $item) {
                $item->order = json_decode($item->order, true);
                $item->order ? $item_order = $item->order : $item_order = [];

                foreach ($item_order as $key => $value){
                    $item_order[$key]['crm_contract_id'] = $item->id;
                    $item_order[$key]['crm_product_id'] = $item_order[$key]['prodname'];
                    unset($item_order[$key]['prodprice']);
                    unset($item_order[$key]['signdate']);
                    unset($item_order[$key]['prodname']);
                }
                $item->order = $item_order;
                $data = array_merge($data , $item->order);
            }
            DB::table('crm_orders')->insert($data);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crm_orders');
    }
}
