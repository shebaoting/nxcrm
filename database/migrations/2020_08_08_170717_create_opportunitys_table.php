<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpportunitysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunitys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject')->default('');
            $table->integer('expectincome')->default('0');
            $table->date('expectendtime');
            $table->integer('dealchance')->default('0');
            $table->integer('tempo')->default('1');
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('opportunitys');
    }
}
