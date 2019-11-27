<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     // El metodo up contiene el codigo para hacer efectiva la migracion
     // los cambios se generan dentro de este metodo
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            //Columnas nuevas por defecto no aceptan nulos
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // Hace la opracion contraria a up ya que hay casos en las que debemos resetear
    // las migraciones
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
