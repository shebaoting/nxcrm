<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalRemarkSalesexpensesIntoContracts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contracts',function (Blueprint $table) {
            $table->integer('total')->after('title')->nullable();
            $table->integer('salesexpenses')->after('total')->nullable();
            $table->string('remark')->after('salesexpenses')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn('total');
            $table->dropColumn('salesexpenses');
            $table->dropColumn('remark');
        });
    }
}
