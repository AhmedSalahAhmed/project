<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_phone');
            $table->string('id_type');
            $table->string('id_number');
            $table->integer('amount');
            $table->string('transaction_type');
            $table->string('currency');

            // $table->foreignId('bank_id');
            // $table->foreign('bank_id')
            //         ->references('id')
            //         ->on('banks');

            // $table->foreignId('employer_id');
            // $table->foreign('employer_id')
            //         ->references('id')
            //         ->on('employers');

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
        Schema::dropIfExists('transactions');
    }
}
