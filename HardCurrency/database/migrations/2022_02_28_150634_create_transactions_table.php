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
        Schema::dropIfExists('transactions');

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('client_name')->nullable();
            $table->string('client_phone')->nullable();
            $table->string('id_number')->nullable();
            $table->bigInteger('qte')->default(0);
            $table->foreignId('fk_bank')->nullable()->constrained('banks')->onDelete('cascade');
            $table->enum('type',['deposit','withdraw','transfer'])->nullable();
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
