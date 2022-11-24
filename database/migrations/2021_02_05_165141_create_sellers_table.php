<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->integer("doe");
            $table->string("name");
            $table->decimal("total_amount_frozen", 65, 2);
            $table->integer('units_sold')->nullable();
            $table->decimal('product_gmv', 65, 2)->nullable();
            $table->decimal('amount_frozen_usd', 65, 2)->nullable();
            $table->decimal('amount_frozen_cny', 65, 2)->nullable();
            $table->foreignId('marketplace')->references('id')->on('marketplaces');
            $table->foreignId('linked_case')->references('id')->on('listed_cases');
            $table->text('product_url');
            $table->text('store_url');
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
        Schema::dropIfExists('sellers');
    }
}
