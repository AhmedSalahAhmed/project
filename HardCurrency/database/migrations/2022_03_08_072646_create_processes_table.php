<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->string('client_name')->nullable();
            $table->string('client_phone')->nullable();
            $table->string('id_number')->nullable();
            $table->bigInteger('amount')->default(0);
            $table->bigInteger('sdgamount');
            $table->foreignId('bank_id')->nullable()->constrained('banks')->onDelete('cascade');
            $table->foreignId('employee_id')->nullable()->constrained('employees')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('bank_currency_id')->nullable()->constrained('bank_currencies')
            ->onDelete('cascade');
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
        Schema::dropIfExists('processes');
    }
}
