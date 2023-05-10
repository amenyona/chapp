<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messes', function (Blueprint $table) {
            $table->id();
            $table->integer('idpays')->unsigned();
            $table->integer('idheure')->unsigned();
            $table->string('messedateenvoi')->nullable();
            $table->string('messeintension')->nullable();
            $table->string('messefrequence')->nullable();
            $table->string('messedate')->nullable();
            $table->string('messedebut')->nullable();
            $table->string('messefin')->nullable();
            $table->string('messeargent')->nullable();
            $table->string('messestatut')->nullable();
            $table->string('email')->nullable();
            $table->string('prix')->nullable();
            $table->string('quartier')->nullable();
            $table->string('ville')->nullable();
            $table->string('telephone')->nullable();
            $table->string('adresse')->nullable();
            $table->string('nom')->nullable();
            $table->string('image')->nullable();
            $table->string('nombremesse')->nullable();
            $table->string('datetraitement')->nullable();
            $table->string('sexe')->nullable();
            $table->string('etat')->nullable();
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
        Schema::dropIfExists('messes');
    }
}
