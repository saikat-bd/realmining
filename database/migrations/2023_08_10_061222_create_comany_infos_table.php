<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComanyInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comany_infos', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_descrption')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->text('address')->nullable();
            $table->longText('home_content')->nullable();
            $table->longText('about_us')->nullable();
            $table->string('about_title')->nullable();
            $table->string('terms_title')->nullable();
            $table->longText('terms_descrption')->nullable();
            $table->double('com_invest', 10,2)->default(0);
            $table->double('out_invest', 10,2)->default(0);
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
        Schema::dropIfExists('comany_infos');
    }
}
