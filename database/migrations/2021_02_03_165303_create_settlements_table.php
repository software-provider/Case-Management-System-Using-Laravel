<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('linked_case')->references('id')->on('listed_cases');
            $table->decimal('offered_amount', 65, 2);
            $table->foreignId('marketplace')->references('id')->on('marketplaces');
            $table->foreignId('representatives')->references('id')->on('representatives');
            $table->enum('status', ['Agreed', 'Agreement Signed', 'Contacted', 'Dismissed', 'Money Received', 'Negotiation in Progress']);
            $table->decimal('target', 65, 2);
            $table->string('settlement_agreement_file');
            $table->decimal('money_received', 65, 2);
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
        Schema::dropIfExists('settlements');
    }
}
