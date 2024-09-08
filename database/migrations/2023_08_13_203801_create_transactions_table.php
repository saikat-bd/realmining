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
            $table->integer('user_id');
            $table->double('credit_amount', 10,2)->nullable();
            $table->double('debit_amount', 10,2)->nullable();
            $table->string('transaction', 55)->nullable();
            $table->string('note', 222)->nullable();
            $table->string('payment_type', 55);
            $table->string('inoutstatus', 55);
            $table->enum('amount_status', ['Paid', 'Pending']);
            $table->enum('withdraw_status', ['Pending', 'Success']);
            $table->date('tran_date');
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
