<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_main')->default(true);
            $table->enum('city',['general','service','filial'])->default('general');
            $table->enum('type',['phone','footer_phone','fax','graph','social','address','email','map','footer_social'])->default('phone');
            $table->string('icon')->nullable();
            $table->text('value');
            $table->string('link')->nullable();
            $table->boolean('active')->default(0);
            $table->integer('sort_id')->default(0);
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
        Schema::dropIfExists('contacts');
    }
}
