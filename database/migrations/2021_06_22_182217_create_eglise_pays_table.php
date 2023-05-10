<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEglisePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eglise_pays', function (Blueprint $table) {
            $table->id();
            $table->integer('eglise_id')->unigned();
            $table->integer('pays_id')->unsigned();
            $table->integer('iduser')->nullable();
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
        Schema::dropIfExists('eglise_pays');
    }
}
