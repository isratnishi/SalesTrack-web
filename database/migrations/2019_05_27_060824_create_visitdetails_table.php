<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitdetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('site_name');
            $table->string('salesperson_name');
            $table->string('location');
            $table->string('target');
            $table->string('target_meet');
            $table->string('product_name');
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
        Schema::dropIfExists('visitdetails');
    }
}
