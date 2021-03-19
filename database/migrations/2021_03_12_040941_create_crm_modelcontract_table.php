<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmModelcontractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_modelcontract', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('')->comment('合同标题');
            $table->string('description')->default('')->comment('描述');
            $table->string('content')->comment('合同内容');
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
        Schema::dropIfExists('crm_modelcontract');
    }
}
