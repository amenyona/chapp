<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEglisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eglises', function (Blueprint $table) {
            $table->id();
            $table->integer('idpays')->unsigned();
            $table->integer('iduser')->nullablle();
            $table->string('nom');
            $table->string('diocese')->nullablle();
            $table->string('quartier');
            $table->string('ville');
            $table->string('adresse');
            $table->string('email');
            $table->string('statut');
            $table->string('comptebancaire')->nullablle();
            $table->string('montantmesse')->nullablle();
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
        Schema::dropIfExists('eglises');
    }
}
