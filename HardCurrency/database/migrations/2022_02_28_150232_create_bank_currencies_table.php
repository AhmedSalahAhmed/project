<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_currencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_id')->nullable()
            ->constrained()->onDelete('cascade');
            $table->foreignId('currency_id')->nullable()
            ->constrained('currencies')->onDelete('cascade');
            $table->foreignId('currency_price_id')->nullable()
            ->constrained('currency_prices')->onDelete('cascade');
            $table->double('sale_price')->default(0);
            $table->double('buy_price')->default(0);
            $table->double('balance')->default(0);
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
        Schema::dropIfExists('bank_currencies');
    }
}
