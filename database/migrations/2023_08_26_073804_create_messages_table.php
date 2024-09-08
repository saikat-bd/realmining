<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('parent_id')->nullable();
            $table->foreignId('user_id');
            $table->text('messages')->nullable();
            $table->text('attachment')->nullable();
            $table->enum('status',['1', '0'])->default(0);
            $table->timestamps();
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
