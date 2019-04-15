<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            $table->integer('phone_country')->nullable();
            $table->string('phone')->nullable();

            $table->boolean('email_verified')->default(false);
            $table->string('email_token')->nullable();

            $table->boolean('phone_verified')->default(false);
            $table->string('phone_token')->nullable();

            $table->boolean('verified')->default(false);

            $table->integer('registration_step')->default(0);
            
            $table->string('invite_code')->nullable();

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
