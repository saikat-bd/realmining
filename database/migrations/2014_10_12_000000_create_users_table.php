<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('package_id')->nullable();
            $table->bigInteger('ref_id')->nullable();
            $table->bigInteger('root_id')->nullable();
            $table->bigInteger('left_id')->nullable();
            $table->bigInteger('right_id')->nullable();
            $table->bigInteger('left_point')->nullable();
            $table->bigInteger('right_point')->nullable();
            $table->double('debit_balance')->default(0);
            $table->double('credit_balance')->default(0);
            $table->double('transfer_balance')->default(0);
            $table->double('earn_balance')->default(0);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->integer('country_id')->nullable();
            $table->string('phone_number', 55)->nullable();
            $table->string('gender', 55)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('wallet_address');
            $table->string('transactionpin')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Inactive');
            $table->enum('user_type', ['member', 'admin'])->default('member');
            $table->enum('payment_lock', ['Active', 'Inactive'])->default('Active');
            $table->string('photo', 255)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
