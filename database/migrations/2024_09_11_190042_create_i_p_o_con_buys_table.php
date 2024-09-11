<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIPOConBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_p_o_con_buys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->double('coin_rate', 10,2)->default(0);
            $table->integer('quantity')->default(1);
            $table->double('total_amount', 10,2)->default(0);
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
        Schema::dropIfExists('i_p_o_con_buys');
    }
}
