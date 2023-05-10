<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutreDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autre_documents', function (Blueprint $table) {
            $table->id();
            $table->integer('userId')->unsigned();
            $table->integer('egliseId')->unsined();
            $table->integer('repertoireId')->unsigned();
            $table->string('uuid');
            $table->string('titre');
            $table->string('imageDoc');
            $table->text('description');
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
        Schema::dropIfExists('autre_documents');
    }
}
