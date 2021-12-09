<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerpoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_customerpools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('')->comment('分类名称');
            $table->string('roles')->default('0')->comment('使用角色');
            $table->integer('leader')->default('0')->comment('负责人');
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
        Schema::dropIfExists('crm_customerpools');
    }
}
