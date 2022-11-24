<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLfSentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lf_sent', function (Blueprint $table) {
            $table->id();
            $table->foreignId('linked_case')->references('id')->on('listed_cases');
            $table->foreignId('settlement_id')->references('id')->on('settlements');
            $table->date('date');
            $table->text('description');
            $table->decimal('amount_sent', 65, 2);
            $table->string('file_upload');
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
        Schema::dropIfExists('lf_sent');
    }
}
