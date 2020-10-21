<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductsDesc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products',function (Blueprint $table) {
            $table->string('desc')->nullable()->change();
        });
    }

    // 回滚迁移时会被调用
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {

        });
    }
}
