<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name')->nullable()->unique();
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->foreignId('branch_id')->constrained('branches')->nullable()
            ->onDelete('cascade')->onUpdate('cascade');
            $table->string('logo')->nullable();
            $table->text('state')->nullable();
            $table->text('city')->nullable();
            $table->text('district')->nullable();
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
        Schema::dropIfExists('banks');
    }
}
