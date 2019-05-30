<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavevisitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savevisit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('site_id')->nullable(false);
            $table->unsignedInteger('salesperson_id')->nullable(false);
            $table->unsignedInteger('product_id')->nullable(false);
            $table->string('location');
            $table->string('target');
            $table->string('targetmeet');
            $table->timestamps();

            $table->foreign('site_id')->references('id')->on('site');
            $table->foreign('salesperson_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('savevisit');
    }
}
