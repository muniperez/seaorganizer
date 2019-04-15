<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flags', function (Blueprint $table) {
            
            $table->increments('id');

            $table->integer('user_id')->nullable();
            $table->integer('certificate_id')->nullable();
            $table->integer('country_id')->nullable();

            // $table->string('name')->nullable();
            // $table->string('code')->nullable();
            // $table->string('icon')->nullable();
            
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
        Schema::dropIfExists('flags');
    }
}
