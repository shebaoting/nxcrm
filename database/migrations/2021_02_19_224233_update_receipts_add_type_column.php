<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateReceiptsAddTypeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crm_receipts', function (Blueprint $table){
            $table->unsignedTinyInteger('type')
                  ->default(1)
                  ->after('remark')
                  ->comment('款项类型：1收款，2支出');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crm_receipts', function (Blueprint $table){
            $table->dropColumn('type');
        });
    }
}
