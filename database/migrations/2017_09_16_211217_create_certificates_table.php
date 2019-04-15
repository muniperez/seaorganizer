<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('user_id');
            
            $table->integer('ship_id')->nullable();
            $table->integer('company_id')->nullable();

            $table->string('label')->nullable();
            $table->string('issuer')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamp('issued')->nullable();
            $table->timestamp('expiration')->nullable();
            $table->text('file')->nullable();

            $table->integer('alert_level')->nullable();
            $table->integer('notifications_snoozed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificates');
    }
}
