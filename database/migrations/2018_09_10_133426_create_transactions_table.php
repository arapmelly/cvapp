<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('transaction_reference')->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('transaction_country')->nullable();
            $table->string('transaction_method')->nullable();
            $table->date('transaction_date')->nullable();
            $table->string('transaction_currency')->nullable();
            $table->float('transaction_amount', 8,2)->nullable();
            $table->string('transaction_name')->nullable();
            $table->string('transaction_mobile')->nullable();
            $table->string('transaction_email')->nullable();
            $table->string('transaction_code')->nullable();
            $table->string('transaction_status')->nullable();
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
