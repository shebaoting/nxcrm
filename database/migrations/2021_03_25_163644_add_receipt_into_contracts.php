<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\CrmContract as Model;
use App\Models\CrmReceipt;


class AddReceiptIntoContracts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crm_contracts',function (Blueprint $table) {
            $table->integer('receipt');
        });
        foreach (Model::query()->cursor() as $item) {
            $data = 0;
            $CrmReceipt = CrmReceipt::where('crm_contract_id', $item->id)->sum('receive');
            // foreach ($CrmReceipt as $CrmReceipt_item) {
            //     $data = $data + $CrmReceipt_item->receive;
            // }
            $item->receipt = $CrmReceipt;
            $item->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crm_contracts', function (Blueprint $table) {
            $table->dropColumn('receipt');
        });
    }
}
