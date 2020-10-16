<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomfieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customfields', function (Blueprint $table) {
            $table->increments('id');
            $table->char('model')->default('');
            $table->char('name')->default('');
            $table->char('field')->unique()->default('');
            $table->char('type')->default('');
            $table->boolean('required');
            $table->boolean('iflist');
            $table->char('default')->nullable();
            $table->string('help')->nullable();
            $table->json('options')->nullable();
            $table->boolean('unique')->nullable();
            $table->boolean('show')->nullable();
            $table->integer('sort')->default(1);
            $table->char('icon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customfields');
    }
}
