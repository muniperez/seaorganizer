<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('countries', function (Blueprint $table) {
            
            $table->increments('id');
            $table->timestamps();

            $table->string('name');
            $table->string('capital');

            $table->integer('calling_code');
            
            $table->string('cca2');
            $table->string('cca3');
            
            $table->string('flag_icon');
            $table->string('flag_icon_squared');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
