<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlement_sellers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('linked_case')->references('id')->on('listed_cases');
            $table->foreignId('linked_seller')->references('id')->on('sellers');
            $table->foreignId('linked_settlement')->references('id')->on('settlements');
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
        Schema::dropIfExists('settlement_sellers');
    }
}
