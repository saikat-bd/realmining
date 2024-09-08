<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenerationPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generation_plans', function (Blueprint $table) {
            $table->id('id');
            $table->integer('lavel_1')->default(0);
            $table->integer('lavel_2')->default(0);
            $table->integer('lavel_3')->default(0);
            $table->integer('lavel_4')->default(0);
            $table->integer('lavel_5')->default(0);
            $table->integer('lavel_6')->default(0);
            $table->integer('lavel_7')->default(0);
            $table->integer('lavel_8')->default(0);
            $table->integer('lavel_9')->default(0);
            $table->integer('lavel_10')->default(0);
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
        Schema::dropIfExists('generation_plans');
    }
}
