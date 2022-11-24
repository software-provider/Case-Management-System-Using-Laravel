<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListedCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listed_cases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client')->references('id')->on('users');
            $table->foreignId('law_firm')->references('id')->on('users');
            $table->foreignId('allowed_user')->references('id')->on('users')->nullable();
            $table->enum('status', ['Active', 'Inactive']);
            $table->decimal('lf_fee', 65, 2);
            $table->decimal('axs_fee', 65, 2);
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
        Schema::dropIfExists('listed_cases');
    }
}
