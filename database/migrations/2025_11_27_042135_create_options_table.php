<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::create('options', function (Blueprint $table) {
        $table->id();
        $table->foreignId('survey_id')->constrained()->onDelete('cascade'); // Conexión
        $table->string('text');        // Texto de la opción (ej: Rojo)
        $table->integer('votes')->default(0); // Contador de votos
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
        Schema::dropIfExists('options');
    }
}
